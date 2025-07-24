<?php

// namespace App\Imports;

// use App\Models\Product;
// use App\Models\ProductImage;
// use App\Models\ProductVariation;
// use App\Models\Vendor;
// use App\Models\Category;
// use App\Models\DiamondVendor;
// use App\Models\MetalType;
// use App\Models\MetalColor;
// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\ToCollection;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Illuminate\Support\Facades\DB;
// use Carbon\Carbon;
// use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

// class CombinedProductImport implements ToCollection, WithHeadingRow
// {
//     protected $productsCache = [];
//     protected $vendorMap = [];
//     protected $categoryMap = [];
//     protected $metalTypeMap = [];
//     protected $metalColorMap = [];
    
//     public function collection(Collection $rows)
//     {
//         $this->preloadMappings();
//         DB::transaction(function () use ($rows) {
//             foreach ($rows as $index => $row) {
//                 try {
//                     $productId = $this->resolveProductId($row);
                    
//                     if (!$productId) {
//                         throw new \Exception("Row ".($index+1).": Product ID/SKU not found");
//                     }
                    
//                     // 1. प्रोडक्ट डेटा प्रोसेस करें (पहली पंक्ति में ही)
//                     if (!empty($row['products_name']) || !empty($row['products_sku'])) {
//                         $this->handleProduct($row, $productId);
//                     }
                    
//                     // 2. प्रोडक्ट इमेज प्रोसेस करें (पहली पंक्ति में ही)
//                     if (!empty($row['image_path']) && !empty($row['products_name'])) {
//                         $this->handleProductImage($row, $productId);
//                     }
                    
//                     // 3. प्रोडक्ट वेरिएशन प्रोसेस करें (हर पंक्ति में)
//                     if (!empty($row['variation_sku'])) {
//                         $this->handleProductVariation($row, $productId);
//                     }
                    
//                 } catch (\Exception $e) {
//                     \Log::error($e->getMessage());
//                     continue;
//                 }
//             }
//         });
//     }

//     // सभी मैपिंग डेटा पहले से लोड करें
//     private function preloadMappings()
//     {
//         // वेंडर मैपिंग
//         $vendors = DiamondVendor::all();
//         foreach ($vendors as $vendor) {
//             $this->vendorMap[$vendor->name] = $vendor->id;
//         }
        
//         // कैटेगरी मैपिंग
//         $categories = Category::all();
//         foreach ($categories as $category) {
//             $this->categoryMap[$category->categories_name] = $category->categories_id;
//         }
        
//         // धातु प्रकार मैपिंग
//         $metalTypes = MetalType::all();
//         foreach ($metalTypes as $type) {
//             $this->metalTypeMap[$type->name] = $type->id;
//         }
        
//         // धातु रंग मैपिंग
//         $metalColors = MetalType::all();
//         foreach ($metalColors as $color) {
//             $this->metalColorMap[$color->name] = $color->id;
//         }
//     }

//      // नाम से आईडी प्राप्त करने के हेल्पर फंक्शन
//     private function mapNameToId($type, $name)
//     {
//         if (empty($name)) return null;
        
//         switch ($type) {
//             case 'vendor':
//                 return $this->vendorMap[$name] ?? null;
                
//             case 'category':
//                 return $this->categoryMap[$name] ?? null;
                
//             case 'metal_type':
//                 return $this->metalTypeMap[$name] ?? null;
                
//             case 'metal_color':
//                 return $this->metalColorMap[$name] ?? null;
                
//             default:
//                 return null;
//         }
//     }

//     private function resolveProductId($row)
//     {
//         $productId = $row['products_id'] ?? null;
//         $productSku = $row['products_sku'] ?? null;
        
//         // 1. अगर products_id डायरेक्ट दिया गया है
//         if ($productId) return $productId;
        
//         // 2. अगर products_sku दिया गया है
//         if ($productSku) {
//             if (!isset($this->productsCache[$productSku])) {
//                 $product = Product::where('products_sku', $productSku)->first();
//                 if ($product) {
//                     $this->productsCache[$productSku] = $product->products_id;
//                 } else {
//                     throw new \Exception("Product not found for SKU: $productSku");
//                 }
//             }
//             return $this->productsCache[$productSku];
//         }
        
//         return null;
//     }
//     private function handleProduct($row, $productId = null)
//     {
//         // $productId = $row['products_id'] ?? null;
//         $productData = [
//             'products_name' => $row['products_name'] ?? null,
//             'products_description' => $row['products_description'] ?? null,
//             'products_short_description' => $row['products_short_description'] ?? null,
//             'available' => $row['available'] ?? 'no',
//             'products_quantity' => $row['products_quantity'] ?? 0,
//             'products_model' => $row['products_model'] ?? null,
//             'products_sku' => $row['products_sku'] ?? null,
//             'master_sku' => $row['master_sku'] ?? null,
//             'products_price' => $row['products_price'] ?? 0.0,
//             'products_price1' => $row['products_price1'] ?? 0.0,
//             'products_price2' => $row['products_price2'] ?? 0.0,
//             'products_price3' => $row['products_price3'] ?? 0.0,
//             'products_price4' => $row['products_price4'] ?? 0.0,
//             'products_weight' => $row['products_weight'] ?? 0.0,
//             'products_status' => $row['products_status'] ?? 0,
//             'engraving_status' => $row['engraving_status'] ?? 0,
//             'products_slug' => $row['products_slug'] ?? null,
//             'catelog_no' => $row['catelog_no'] ?? null,
//             // 'vendor_id' => $row['vendor_id'] ?? null,
//             'vendor_stock_no' => $row['vendor_stock_no'] ?? null,
//             'vendor_price' => $row['vendor_price'] ?? 0.0,
//             // 'categories_id' => $row['categories_id'] ?? null,
//             'parent_category_id' => $row['parent_category_id'] ?? null,
//             'psc_id' => $row['psc_id'] ?? null,
//             'country_of_origin' => $row['country_of_origin'] ?? null,
//             'products_tax_class_id' => $row['products_tax_class_id'] ?? null,
//             'products_tax' => $row['products_tax'] ?? 0.0,
//             'is_bestseller' => $row['is_bestseller'] ?? 0,
//             'is_featured' => $row['is_featured'] ?? 0,
//             'ready_to_ship' => $row['ready_to_ship'] ?? 0,
//             'is_collection' => $row['is_collection'] ?? 0,
//             'is_new' => $row['is_new'] ?? 0,
//             'is_superdeals' => $row['is_superdeals'] ?? 0,
//             'diamond_weight_group_id' => $row['diamond_weight_group_id'] ?? null,
//             'diamond_quality_id' => $row['diamond_quality_id'] ?? null,
//             'diamond_clarity_id' => $row['diamond_clarity_id'] ?? null,
//             'diamond_color_id' => $row['diamond_color_id'] ?? null,
//             'diamond_cut_id' => $row['diamond_cut_id'] ?? null,
//             'diamond_pics' => $row['diamond_pics'] ?? 0,
//             'side_diamond_quality_id' => $row['side_diamond_quality_id'] ?? null,
//             'side_diamond_breakdown' => $row['side_diamond_breakdown'] ?? null,
//             'semi_mount_ct_wt' => $row['semi_mount_ct_wt'] ?? 0.0,
//             'total_carat_weight' => $row['total_carat_weight'] ?? 0.0,
//             'semi_mount_price' => $row['semi_mount_price'] ?? 0.0,
//             'center_stone_price' => $row['center_stone_price'] ?? 0.0,
//             'center_stone_weight' => $row['center_stone_weight'] ?? 0.0,
//             'center_stone_type_id' => $row['center_stone_type_id'] ?? null,
//             'stone_type_id' => $row['stone_type_id'] ?? null,
//             // 'metal_type_id' => $row['metal_type_id'] ?? null,
//             // 'metal_color_id' => $row['metal_color_id'] ?? null,

//             'vendor_id' => $this->mapNameToId('vendor', $row['vendor_id']),
//             'categories_id' => $this->mapNameToId('category', $row['categories_id']),
//             'metal_type_id' => $this->mapNameToId('metal_type', $row['metal_type_id']),
//             'metal_color_id' => $this->mapNameToId('metal_color', $row['metal_color_id']),


//             'metal_weight' => $row['metal_weight'] ?? 0.0,
//             'is_build_product' => $row['is_build_product'] ?? null,
//             'build_product_type' => $row['build_product_type'] ?? null,
//             'is_matching_set' => $row['is_matching_set'] ?? 0,
//             'product_keywords' => $row['product_keywords'] ?? null,
//             'product_promotion' => $row['product_promotion'] ?? null,
//             'certified_lab' => $row['certified_lab'] ?? null,
//             'certificate_number' => $row['certificate_number'] ?? null,
//             'products_related_items' => $row['products_related_items'] ?? null,
//             'related_master_sku' => $row['related_master_sku'] ?? null,
//             'products_meta_title' => $row['products_meta_title'] ?? null,
//             'products_meta_description' => $row['products_meta_description'] ?? null,
//             'products_meta_keyword' => $row['products_meta_keyword'] ?? null,
//             'delivery_days' => $row['delivery_days'] ?? 0,
//             'default_size' => $row['default_size'] ?? null,
//             'deleted' => $row['deleted'] ?? 0,
//             'sort_order' => $row['sort_order'] ?? 0,
//             'date_added' => $this->parseDate($row['date_added'] ?? null),
//             'date_updated' => $this->parseDate($row['date_updated'] ?? null),
//             'added_by' => $row['added_by'] ?? 0,
//             'updated_by' => $row['updated_by'] ?? 0,
//             'shape_id' => $row['shape_id'] ?? null,
//             'shop_zone_id' => $row['shop_zone_id'] ?? null,
//             'created_at' => $this->parseDate($row['created_at'] ?? null),
//             'updated_at' => $this->parseDate($row['updated_at'] ?? null),
//         ];

//         return Product::updateOrCreate(
//             ['products_id' => $productId],
//             $productData
//         );
//     }

//     private function handleProductImage($row, $productId)
//     {
//         $imageData = [
//             'is_featured' => $row['image_is_featured'] ?? 0,
//             'sort_order' => $row['image_sort_order'] ?? 0
//         ];

//         ProductImage::updateOrCreate(
//             [
//                 'products_id' => $productId,
//                 'image_path' => $row['image_path']
//             ],
//             $imageData
//         );
//     }

//     private function handleProductVariation($row, $productId)
//     {

        
//             $variationData = [
//                 'product_id' => $productId,
//                 'carat' => $row['variation_carat'] ?? null,
//                 'price' => $row['variation_price'] ?? 0.00,
//                 'stock' => $row['variation_stock'] ?? 0,
//                 'weight' => $row['variation_weight'] ?? null,
//                 'shape_id' => $row['variation_shape_id'] ?? null,
//                 'category_id' => $row['variation_category_id'] ?? null,
//                 'parent_category_id' => $row['variation_parent_category_id'] ?? null,
//                 'metal_color_id' => $row['variation_metal_color_id'] ?? null,
//                 'images' => isset($row['variation_images']) ? json_encode(explode(',', $row['variation_images'])) : json_encode([]),
//                 'vendor_id' => $row['variation_vendor_id'] ?? null,
//                 'created_at' => $this->parseDate($row['variation_created_at'] ?? null),
//                 'updated_at' => $this->parseDate($row['variation_updated_at'] ?? null),
//             ];

//             ProductVariation::updateOrCreate(
//                 [
//                     'product_id' => $productId,
//                     'sku' => $row['variation_sku']
//                 ],
//                 $variationData
//             );
//         }
    

//      private function parseDate($value)
//     {
//         if (empty($value)) return Carbon::now();
//         if (is_numeric($value)) return Carbon::instance(ExcelDate::excelToDateTimeObject($value));
//         try { return Carbon::parse($value); } 
//         catch (\Exception $e) { return Carbon::now(); }
//     }
// }

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\DiamondVendor;
use App\Models\Category;
use App\Models\MetalType;
use App\Models\ProductMetalColor;
use App\Models\DiamondShape;
use App\Models\DiamondQualityGroup;
use App\Models\ProductClarityMaster;
use App\Models\ProductsColorMaster;
use App\Models\ProductsCutMaster;
use App\Models\Country;
use App\Models\ProductStyleCategory;
use App\Models\ProductCollection;
use App\Models\ShopTaxClass;
use App\Models\DiamondWeightGroup;
use App\Models\ShopZone;
use App\Models\ProductStoneType;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class CombinedProductImport implements ToCollection, WithHeadingRow
{
    protected $productsCache = [];
    protected $mappings = [];
    
    public function collection(Collection $rows)
    {
        $this->preloadMappings();
        
        DB::transaction(function () use ($rows) {
            foreach ($rows as $index => $row) {
                try {
                    $rowArray = $row->toArray();
                    $productId = $this->resolveProductId($rowArray);
                    
                    $isNewProduct = empty($productId) && 
                                  (!empty($rowArray['products_name']) || 
                                   !empty($rowArray['products_sku']));
                    
                    if ($isNewProduct || !empty($productId)) {
                        if (!empty($rowArray['products_name']) || !empty($rowArray['products_sku'])) {
                            $productId = $this->handleProduct($rowArray, $productId);
                        }
                        
                        if (!empty($rowArray['image_path'])) {
                            $this->handleProductImage($rowArray, $productId);
                        }
                        
                        if (!empty($rowArray['variation_sku'])) {
                            $this->handleProductVariation($rowArray, $productId);
                        }
                    } else {
                        throw new \Exception("Product ID/SKU not found");
                    }
                    
                } catch (\Exception $e) {
                    Log::error("Row ".($index+1).": ".$e->getMessage());
                    continue;
                }
            }
        });
    }

    private function preloadMappings()
    {
        $this->mappings = [
            // Vendor mapping
            'vendor' => DiamondVendor::pluck('vendorid', 'vendor_name')->toArray(),
            
            // Category mappings
            'category' => Category::pluck('category_id', 'category_name')->toArray(),
            
            // Product style category
            'psc_id' => ProductStyleCategory::pluck('psc_id', 'psc_name')->toArray(),
            
            // Product collection
            'product_collection' => ProductCollection::pluck('id', 'name')->toArray(),
            
            // Tax class
            'shop_tax_class' => ShopTaxClass::pluck('tax_class_id', 'tax_class_title')->toArray(),
            
            // Diamond weight group
            'diamond_weight_group' => DiamondWeightGroup::pluck('dwg_id', 'dwg_name')->toArray(),
            
            // Diamond quality group
            'diamond_quality_group' => DiamondQualityGroup::pluck('dqg_id', 'dqg_name')->toArray(),
            
            // Diamond clarity
            'diamond_clarity' => ProductClarityMaster::pluck('id', 'name')->toArray(),
            
            // Diamond color
            'diamond_color' => ProductsColorMaster::pluck('id', 'name')->toArray(),
            
            // Diamond cut
            'diamond_cut' => ProductsCutMaster::pluck('id', 'name')->toArray(),
            
            // Metal type
            'metal_type' => MetalType::pluck('dmt_id', 'dmt_name')->toArray(),
            
            // Metal color (using color_code)
            'metal_color' => MetalType::pluck('dmt_id', 'color_code')->toArray(),
            
            // Shape
            'shape' => DiamondShape::pluck('id', 'name')->toArray(),
            
            // Country
            'country_of_origin' => Country::pluck('country_id', 'country_name')->toArray(),
            
            // Shop zone
            'shop_zone' => ShopZone::pluck('zone_id', 'zone_name')->toArray(),
            
            // Stone type
            // 'stone_type' => StoneType::pluck('pst_id', 'pst_name')->toArray(),
        ];
    }

    private function resolveProductId($row)
    {
        $productId = $row['products_id'] ?? null;
        $productSku = $row['products_sku'] ?? null;
        
        if ($productId && is_numeric($productId)) {
            return $productId;
        }
        
        if ($productSku) {
            if (!isset($this->productsCache[$productSku])) {
                $product = Product::where('products_sku', $productSku)->first();
                $this->productsCache[$productSku] = $product ? $product->products_id : null;
            }
            return $this->productsCache[$productSku];
        }
        
        return null;
    }
    
    private function handleProduct($row, $productId)
    {
        $productData = [
            'products_name' => $row['products_name'] ?? null,
            'products_description' => $row['products_description'] ?? null,
            'products_short_description' => $row['products_short_description'] ?? null,
            'available' => $row['available'] ?? 'no',
            'products_quantity' => $row['products_quantity'] ?? 0,
            'products_model' => $row['products_model'] ?? null,
            'products_sku' => $row['products_sku'] ?? null,
            'master_sku' => $row['master_sku'] ?? null,
            'products_price' => $row['products_price'] ?? 0.0,
            'products_price1' => $row['products_price1'] ?? 0.0,
            'products_price2' => $row['products_price2'] ?? 0.0,
            'products_price3' => $row['products_price3'] ?? 0.0,
            'products_price4' => $row['products_price4'] ?? 0.0,
            'products_weight' => $row['products_weight'] ?? 0.0,
            'products_status' => $row['products_status'] ?? 0,
            'engraving_status' => $row['engraving_status'] ?? 0,
            'products_slug' => $row['products_slug'] ?? Str::slug($row['products_name'] ?? 'product-'.time()),
            'catelog_no' => $row['catelog_no'] ?? null,
            
            // Vendor mapping
            'vendor_id' => $this->mapNameToId('vendor', $row['vendor_id'] ?? null),
            
            'vendor_stock_no' => $row['vendor_stock_no'] ?? null,
            'vendor_price' => $row['vendor_price'] ?? 0.0,
            
            // Category mappings
            'categories_id' => $this->mapNameToId('category', $row['categories_id'] ?? null),
            'parent_category_id' => $this->mapNameToId('category', $row['parent_category_id'] ?? null),
            
            // Product style category
            'psc_id' => $this->mapNameToId('psc_id', $row['psc_id'] ?? null),
            
            // Country mapping
            'country_of_origin' => $this->mapNameToId('country_of_origin', $row['country_of_origin'] ?? null),
            
            // Tax class
            'products_tax_class_id' => $this->mapNameToId('shop_tax_class', $row['products_tax_class_id'] ?? null),
            'products_tax' => $row['products_tax'] ?? 0.0,
            
            // Flags
            'is_bestseller' => $row['is_bestseller'] ?? 0,
            'is_featured' => $row['is_featured'] ?? 0,
            'ready_to_ship' => $row['ready_to_ship'] ?? 0,
            'is_collection' => $row['is_collection'] ?? 0,
            'is_new' => $row['is_new'] ?? 0,
            'is_superdeals' => $row['is_superdeals'] ?? 0,
            
            // Diamond attributes
            'diamond_weight_group_id' => $this->mapNameToId('diamond_weight_group', $row['diamond_weight_group_id'] ?? null),
            'diamond_quality_id' => $this->mapNameToId('diamond_quality_group', $row['diamond_quality_id'] ?? null),
            'diamond_clarity_id' => $this->mapNameToId('diamond_clarity', $row['diamond_clarity_id'] ?? null),
            'diamond_color_id' => $this->mapNameToId('diamond_color', $row['diamond_color_id'] ?? null),
            'diamond_cut_id' => $this->mapNameToId('diamond_cut', $row['diamond_cut_id'] ?? null),
            'diamond_pics' => $row['diamond_pics'] ?? 0,
            'side_diamond_quality_id' => $this->mapNameToId('diamond_quality_group', $row['side_diamond_quality_id'] ?? null),
            'side_diamond_breakdown' => $row['side_diamond_breakdown'] ?? null,
            
            // Stone attributes
            'semi_mount_ct_wt' => $row['semi_mount_ct_wt'] ?? 0.0,
            'total_carat_weight' => $row['total_carat_weight'] ?? 0.0,
            'semi_mount_price' => $row['semi_mount_price'] ?? 0.0,
            'center_stone_price' => $row['center_stone_price'] ?? 0.0,
            'center_stone_weight' => $row['center_stone_weight'] ?? 0.0,
            'center_stone_type_id' => $row['center_stone_type_id'] ?? null,
            'stone_type_id' => $this->mapNameToId('stone_type', $row['stone_type_id'] ?? null),
            
            // Metal attributes
            'metal_type_id' => $this->mapNameToId('metal_type', $row['metal_type_id'] ?? null),
            'metal_color_id' => $this->mapNameToId('metal_color', $row['metal_color_id'] ?? null),
            'metal_weight' => $row['metal_weight'] ?? 0.0,
            
            // Product attributes
            'is_build_product' => $row['is_build_product'] ?? null,
            'build_product_type' => $row['build_product_type'] ?? null,
            'is_matching_set' => $row['is_matching_set'] ?? 0,
            
            // SEO and metadata
            'product_keywords' => $row['product_keywords'] ?? null,
            'product_promotion' => $row['product_promotion'] ?? null,
            'certified_lab' => $row['certified_lab'] ?? null,
            'certificate_number' => $row['certificate_number'] ?? null,
            'products_related_items' => $row['products_related_items'] ?? null,
            'related_master_sku' => $row['related_master_sku'] ?? null,
            'products_meta_title' => $row['products_meta_title'] ?? null,
            'products_meta_description' => $row['products_meta_description'] ?? null,
            'products_meta_keyword' => $row['products_meta_keyword'] ?? null,
            
            // Shipping and inventory
            'delivery_days' => $row['delivery_days'] ?? 0,
            'default_size' => $row['default_size'] ?? null,
            
            // Status flags
            'deleted' => $row['deleted'] ?? 0,
            'sort_order' => $row['sort_order'] ?? 0,
            
            // Timestamps
            'date_added' => $this->parseDate($row['date_added'] ?? null),
            'date_updated' => $this->parseDate($row['date_updated'] ?? null),
            'added_by' => $row['added_by'] ?? 0,
            'updated_by' => $row['updated_by'] ?? 0,
            
            // Shape and zone
            'shape_id' => $this->mapNameToId('shape', $row['shape_id'] ?? null),
            'shop_zone_id' => $this->mapNameToId('shop_zone', $row['shop_zone_id'] ?? null),
            
            // System timestamps
            'created_at' => $this->parseDate($row['created_at'] ?? null),
            'updated_at' => $this->parseDate($row['updated_at'] ?? null),
            
            // Product collection
            'product_collection_id' => $this->mapNameToId('product_collection', $row['product_collection_id'] ?? null),
        ];

        return Product::updateOrCreate(
            ['products_id' => $productId ?? null],
            $productData
        )->products_id;
    }

    private function handleProductImage($row, $productId)
    {
        $imageData = [
            'is_featured' => $row['image_is_featured'] ?? 0,
            'sort_order' => $row['image_sort_order'] ?? 0
        ];

        ProductImage::updateOrCreate(
            [
                'products_id' => $productId,
                'image_path' => $row['image_path']
            ],
            $imageData
        );
    }

    private function handleProductVariation($row, $productId)
    {
        $variationData = [
            'product_id' => $productId,
            'carat' => $row['variation_carat'] ?? null,
            'price' => $row['variation_price'] ?? 0.00,
            'stock' => $row['variation_stock'] ?? 0,
            'weight' => $row['variation_weight'] ?? null,
            
            // Shape mapping
            'shape_id' => $this->mapNameToId('shape', $row['variation_shape_id'] ?? null),
            
            // Category mappings
            'category_id' => $this->mapNameToId('category', $row['variation_category_id'] ?? null),
            'parent_category_id' => $this->mapNameToId('category', $row['variation_parent_category_id'] ?? null),
            
            // Metal color mapping (using color_code)
            'metal_color_id' => $this->mapNameToId('metal_color', $row['variation_metal_color_id'] ?? null),
            
            // Images
            'images' => isset($row['variation_images']) ? json_encode(explode(',', $row['variation_images'])) : json_encode([]),
            
            // Vendor mapping
            'vendor_id' => $this->mapNameToId('vendor', $row['variation_vendor_id'] ?? null),
            
            // Timestamps
            'created_at' => $this->parseDate($row['variation_created_at'] ?? null),
            'updated_at' => $this->parseDate($row['variation_updated_at'] ?? null),
        ];

        ProductVariation::updateOrCreate(
            [
                'product_id' => $productId,
                'sku' => $row['variation_sku']
            ],
            $variationData
        );
    }

    private function parseDate($value)
    {
        if (empty($value)) return Carbon::now();
        if (is_numeric($value)) return Carbon::instance(ExcelDate::excelToDateTimeObject($value));
        try { 
            return Carbon::createFromFormat('d-m-Y H:i', $value); 
        } catch (\Exception $e) { 
            try {
                return Carbon::parse($value); 
            } catch (\Exception $e) {
                return Carbon::now();
            }
        }
    }

    private function mapNameToId($type, $value)
    {
        if (empty($value)) return null;
        
        if (!isset($this->mappings[$type])) {
            Log::warning("Mapping type not found: $type");
            return null;
        }
        
        // Handle numeric IDs directly
        if (is_numeric($value)) {
            $id = (int)$value;
            if (in_array($id, array_values($this->mappings[$type]))) {
                return $id;
            }
        }
        
        // Handle string names
        $name = trim($value);
        $lowerName = strtolower($name);
        
        // Exact match
        foreach ($this->mappings[$type] as $text => $id) {
            if (strtolower(trim($text)) === $lowerName) {
                return $id;
            }
        }
        
        // Partial match
        foreach ($this->mappings[$type] as $text => $id) {
            if (strpos(strtolower($text), $lowerName) !== false) {
                return $id;
            }
        }
        
        Log::warning("$type not found: $name");
        return null;
    }
}