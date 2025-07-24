<?php

namespace App\Console\Commands;

use App\Models\DiamondCut;
use App\Models\DiamondLab;
use App\Models\DiamondColor;
use App\Models\DiamondShape;
use App\Models\DiamondMaster;
use App\Models\DiamondPolish;
use App\Models\DiamondVendor;
use App\Models\DiamondSymmetry;
use Illuminate\Console\Command;
use App\Models\DiamondFlourescence;
use App\Models\DiamondClarityMaster;
use Illuminate\Support\Facades\Http;

class ImportDiamondData2 extends Command
{
    protected $signature = 'import:diamond-data';
    protected $description = 'Import paginated diamond data from OnePriceLab API into diamond_master table';
    protected $vendorCache = [];
    public function handle()
    {
        $page = 1;
        $lastPage = 1;

        do {
            $this->info("Fetching page {$page}...");
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
                ->post('https://www.onepricelab.com/api/search', [
                    'page' => $page,
                ]);

            if ($response->failed()) {
                $this->error("Page {$page} fetch failed: " . $response->status());
                $this->error("Response: " . $response->body());
                $page++;
                continue;
            }

            $json = $response->json();
            $lastPage = $json['last_page'] ?? 1;
            $items = $json['data'] ?? [];

            foreach ($items as $item) {
                $diamondType = rand(1, 2);
                $cut = empty($item['cut']) ? rand(1, 7) : ($this->getId('DiamondCut', $item['cut']) ?? rand(1, 7));
                $measurements = explode('x', $item['measurements'] ?? '');
                $lengthWidth = explode('-', $measurements[0] ?? '');
                $measurement_l = isset($lengthWidth[0]) ? (float) $lengthWidth[0] : null;
                $measurement_w = isset($lengthWidth[1]) ? (float) $lengthWidth[1] : null;
                $measurement_h = isset($measurements[1]) ? (float) $measurements[1] : null;
                $price = $this->sanitizeFloat($item['cash_price'] ?? 0);
                DiamondMaster::updateOrCreate(
                    ['certificate_number' => $item['certificate']],
                    [
                        'diamond_type' => $diamondType,
                        'quantity' => 1,  // Set to 1 as default
                        'vendor_id' => $this->getOrCreateVendorId($item['vendor_name'] ?? null),
                        'vendor_stock_number' => $item['stock_id'],
                        'stock_number' => $item['sku'],
                        'shape' => $this->getId('DiamondShape', $item['shape']),
                        'color' => $this->getId('DiamondColor', $item['color']),
                        'clarity' => $this->getId('DiamondClarityMaster', $item['clarity']),
                        'cut' => $cut,
                        'carat_weight' => $item['weight']['$numberDecimal'] ?? null,
                        'price_per_carat' => $item['price_per_cts'] ?? null,
                        'msrp_price' => $item['rap_price'] ?? null,
                        'vendor_rap_disc' => $this->sanitizeFloat($item['discount'] ?? null),
                        'price' => $price,
                        'diamond_price1' => $price,
                        'diamond_price2' => $price,
                        'diamond_price3' => $price,
                        'diamond_price4' => $price,
                        'certificate_company' => $this->getCertificateCompany($item['certificate_company'] ?? null),
                        'certificate_number' => $item['certificate'] ?? null,
                        'measurements' => $item['measurements'] ?? null,
                        'measurement_l' => $measurement_l,
                        'measurement_h' => $measurement_h,
                        'measurement_w' => $measurement_w,
                        'depth' => $this->sanitizeFloat($item['depth'] ?? null),
                        'table_diamond' => $this->sanitizeFloat($item['tables'] ?? null),
                        'image_link' => $item['image'] ?? null,
                        'cert_link' => $item['certificateurl'] ?? null,
                        'video_link' => $item['video'] ?? null,
                        'is_superdeal' => rand(0, 1),
                        'status' => 1,
                        'sort_order' => 1,
                        'polish' => $this->getId('DiamondPolish', $item['polish']),
                        'symmetry' => $this->getId('DiamondSymmetry', $item['symmetry']),
                        'fluorescence' => $this->getId('DiamondFlourescence', $item['flour']),
                        'date_added' => now(),
                    ]
                );
            }

            $this->info("Page {$page} imported (" . count($items) . " items).");
            $page++;
            sleep(1);
        } while ($page <= $lastPage);

        $this->info('All pages imported successfully.');
    }

    public function sanitizeFloat($value)
    {
        return ($value !== null && $value !== '') ? (float) $value : null;
    }

    private function getId(string $modelName, $name, string $pkColumn = 'id')
    {
        if (empty($name)) {
            return $modelName === 'DiamondShape' ? 11 : null;
        }

        $modelClass = "App\\Models\\{$modelName}";
        $name = ucfirst(strtolower(trim($name)));

        // Fetch the id from the database
        $id = $modelClass::where('name', $name)->value($pkColumn);

        //fpr shape not fount 11
        if (!$id && $modelName === 'DiamondShape') {
            return 11;
        }
        return $id ?: null;
    }
    private function getVendorId($vendorName)
    {
        $vendorId = DiamondVendor::where('vendor_name', $vendorName)->value('vendorid');
        if (!$vendorId) {
            $vendorId = [1, 2, 5][array_rand([1, 2, 5])];
        }

        return $vendorId;
    }

    private function getCertificateCompany($certificateCompanyName)
    {

        $certificateCompanyId = DiamondLab::where('dl_name', $certificateCompanyName)->value('dl_id');


        if (!$certificateCompanyId) {
            $certificateCompanyId = 1;
        }

        return $certificateCompanyId;
    }
    private function getOrCreateVendorId($vendorName)
    {
        if (!$vendorName || trim($vendorName) === '') {
            return 1;
        }
        if (isset($this->vendorCache[$vendorName])) {
            return $this->vendorCache[$vendorName];
        }
        $vendor = DiamondVendor::firstOrCreate(
            ['vendor_name' => $vendorName]
        );
        $this->vendorCache[$vendorName] = $vendor->vendorid;

        return $vendor->vendorid;
    }


}
