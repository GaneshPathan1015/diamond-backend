<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DiamondMasterSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('diamond_master')->insert([
                'diamond_type' => rand(1, 2),
                'quantity' => rand(1, 5),
                'vendor_id' => rand(1, 2),
                'vendor_stock_number' => 'VENDOR' . $i,
                'stock_number' => 'STOCK' . $i,
                'same_diamond_stock_number' => 'SAME' . $i,

                'shape' => rand(1, 10),
                'color' => rand(1, 10),
                'clarity' => rand(1, 10),
                'cut' => rand(1, 5),
                'carat_weight' => rand(50, 200) / 100,

                'price_per_carat' => rand(3000, 8000),
                'price' => rand(3000, 8000),
                'certificate_company' => 1,
                'certificate_number' => 'CERT' . $i,
                'certificate_name' => 'GIA',
                'certificate_date' => now()->subDays(rand(1, 365)),

                'fancy_color_intensity' => rand(1, 9),
                'fancy_color_overtone' => rand(1, 10),
                'polish' => rand(1, 6),
                'symmetry' => rand(1, 6),
                'fluorescence' => rand(1, 5),
                'culet' => rand(1, 5),

                'date_added' => now(),
                'added_by' => 1,
                'date_updated' => now(),
                'updated_by' => 1,
            ]);
        }
    }
}
