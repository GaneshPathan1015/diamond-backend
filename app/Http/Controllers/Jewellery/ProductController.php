<?php

namespace App\Http\Controllers\Jewellery;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Category;  
use App\Models\ProductImage;
use App\Models\DiamondMaster;
use App\Models\Country;
use App\Models\DiamondVendor;
use App\Models\ProductsToMetalType;
use App\Models\ProductToCategory;
use App\Models\ProductToOption;
use App\Models\ProductToShape;
use App\Models\ProductToStoneType;
use App\Models\ProductToStyleCategory;
use App\Models\ProductToStyleGroup;
use App\Models\ProductMetalColor;
use App\Models\ShopZonesToGeoZone;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\DiamondShape;
use App\Models\DiamondWeightGroup;
use Illuminate\Support\Str;
use App\Models\ProductCollection;
use App\Models\ProductStyleCategory;
use App\Models\ProductStyleGroup;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::leftJoin('categories', 'products.categories_id', '=', 'categories.category_id')
                ->select('products.*', 'categories.category_name')
                ->orderBy('products.products_id', 'DESC')
                ->get();

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('products_name', function ($product) {
                    return $product->products_name ?: '-';
                }) 
                ->addColumn('category_name', function($product) {
                    return $product->category_name ?? 'N/A';
                })
                ->editColumn('products_status', function ($product) {
                    return $product->products_status
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->editColumn('date_added', function ($product) {
                    return $product->date_added 
                        ? date('d M Y', strtotime($product->date_added))
                        : '';
                })
                ->rawColumns(['products_name', 'category_name', 'products_status'])
                ->make(true);
        }

        return view('admin.Jewellery.Product.index');
    }

    public function create()
    {
        $product = new Product();
        $vendors = DiamondVendor::select('vendorid', 'vendor_name')->get();
        $stock_numbers = DiamondMaster::select('diamondid','vendor_stock_number')->limit(100)->get();
        $vendor_prices = DiamondMaster::select('vendor_price')
            ->distinct()
            ->orderBy('vendor_price', 'asc')
            ->limit(100)
            ->get();
        $countries = Country::select('country_id', 'country_name')->get();
        
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();

        $selectedCategoryValue = old('categories_id', '');
        $initialPscId = old('psc_id', '');
        $initialCollectionId = old('product_collection_id', '');
        $initialStyleGroupId = old('product_style_group_id', '');

        $diamond_qualities = \App\Models\DiamondQualityGroup::pluck('dqg_name', 'dqg_id');
        $diamond_clarities = \App\Models\ProductClarityMaster::pluck('name', 'id');
        $diamond_colors = \App\Models\ProductsColorMaster::pluck('name', 'id');
        $diamond_cuts = \App\Models\ProductsCutMaster::pluck('name', 'id');
        $stone_types = \App\Models\ProductStoneType::pluck('pst_name', 'pst_id');
        $metal_types = \App\Models\MetalType::pluck('dmt_name', 'dmt_id');
        $metal_colors = \App\Models\MetalType::pluck('color_code', 'dmt_id');
        $shapes = \App\Models\DiamondShape::select('id', 'name')->get();
        $shopZones = \App\Models\ShopZone::pluck('zone_name', 'zone_id');
        $options = \App\Models\ProductToOption::pluck('products_to_option_id');
        $style_categories = \App\Models\ProductToStyleCategory::pluck('sptsc_id');
        $style_groups = \App\Models\ProductToStyleGroup::pluck('sptsg_id');
        $geo_zones = \App\Models\ShopZonesToGeoZone::pluck('association_id');
        $metal_to_types = \App\Models\ProductsToMetalType::pluck('sptmt_id');
        $product_to_categories = \App\Models\ProductToCategory::pluck('id');
        $shape_types = \App\Models\ProductToShape::pluck('pts_id');
        $stone_to_types = \App\Models\ProductToStoneType::pluck('sptst_id');
        $metalColor = \App\Models\ProductMetalColor::pluck('dmc_name', 'dmc_id');
        $diamondLabs = \App\Models\DiamondLab::all();
        $weightGroups = \App\Models\DiamondWeightGroup::pluck('dwg_name', 'dwg_id');
        $metal_types_colors = \App\Models\MetalType::pluck('dmt_name', 'dmt_id');
        $parentCategories = Category::whereNull('parent_id')->get();
        $styleCategories = \App\Models\ProductStyleCategory::where('engagement_menu', 1)
                    ->pluck('psc_name', 'psc_id');
        $collections = \App\Models\ProductCollection::pluck('name', 'id');
        $styleGroups = ProductStyleGroup::all()
        ->map(function($group) {
            $names = json_decode($group->psg_names, true);
            $group->formatted_names = is_array($names) ? implode(', ', $names) : $group->psg_names;
            return $group;
        })
        ->pluck('formatted_names', 'psg_id');


        return view('admin.Jewellery.Product.create', 
            compact(
                'product', 
                'vendors', 
                'stock_numbers',
                'vendor_prices',
                'countries', 
                'categories',
                'diamond_qualities',
                'diamond_clarities',
                'diamond_colors',
                'diamond_cuts',
                'stone_types',
                'metal_types',
                'metal_colors',
                'shapes',
                'shopZones',
                'metal_to_types',
                'stone_to_types',
                'options',
                'style_categories',
                'style_groups',
                'geo_zones',
                'product_to_categories',
                'shape_types',
                'metalColor',
                'diamondLabs',
                'weightGroups',
                'metal_types_colors',
                'parentCategories',
                'styleCategories',
                'collections',
                'styleGroups',
                'selectedCategoryValue',
                'initialPscId',
                'initialCollectionId',
                'initialStyleGroupId'
            )
        );
    }

    public function store(Request $request)
    {
        $selectedCategory = $request->categories_id;
        $isParent = false;
    
        if (strpos($selectedCategory, 'parent_') === 0) {
            $categoryId = str_replace('parent_', '', $selectedCategory);
            $request->merge(['categories_id' => $categoryId]);
            $isParent = true;
        }
        $rules = $this->getValidationRules();
        $messages = $this->getValidationMessages();

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['added_by'] = Auth::id();
        $data['date_added'] = now();
        $data['date_updated'] = now();

        $product = Product::create($data);

        // Handle variations
        if ($request->has('variations')) {
            $skusInRequest = [];

            // Create variation_images directory if not exists
            if (!Storage::disk('public')->exists('variation_images')) {
                Storage::disk('public')->makeDirectory('variation_images');
            }
            
            // Create variation_videos directory if not exists
            if (!Storage::disk('public')->exists('variation_videos')) {
                Storage::disk('public')->makeDirectory('variation_videos');
            }

            foreach ($request->variations as $index => $variation) {
                $imagePaths = [];
                $videoName = null;

                // Process variation images
                if ($request->hasFile("variations.$index.images")) {
                    foreach ($request->file("variations.$index.images") as $image) {
                        if ($image->isValid()) {
                            $filename = 'variation_' . time() . '_' . Str::random(10) . '.' . $image->extension();
                            $image->storeAs('variation_images', $filename, 'public');
                            $imagePaths[] = $filename;
                        }
                    }
                }
                
                // Process variation video
                if ($request->hasFile("variations.$index.video")) {
                    $video = $request->file("variations.$index.video");
                    if ($video->isValid()) {
                        $videoName = 'variation_video_' . time() . '_' . Str::random(10) . '.' . $video->extension();
                        $video->storeAs('variation_videos', $videoName, 'public');
                    }
                }

                $weight = $variation['weight'] ?? 0;
                $weightStr = str_replace('.', '', number_format($weight, 2, '.', ''));

                $shapeId = $variation['shape_id'] ?? null;
                $shape = $shapeId ? DiamondShape::find($shapeId) : null;
                $shapeCode = $shape ? strtoupper(substr($shape->name, 0, 2)) : 'XX';

                $baseSku = 'PRD-' . $product->products_id . '-' . $shapeCode . '-' . $weightStr;
                $sku = $baseSku;

                if (in_array($sku, $skusInRequest)) {
                    $suffix = 1;
                    do {
                        $sku = $baseSku . '-' . $suffix;
                        $suffix++;
                    } while (in_array($sku, $skusInRequest));
                }
                $skusInRequest[] = $sku;

                $product->variations()->create([
                    'weight' => $weight,
                    'price' => $variation['price'],
                    'regular_price' => $variation['regular_price'],
                    'sku' => $sku,
                    'stock' => $variation['stock'] ?? 0,
                    'metal_color_id' => $variation['metal_color_id'] ?? null,
                    'shape_id' => $variation['shape_id'] ?? null,
                    'images' => $imagePaths,
                    'video' => $videoName
                ]);
            }
        }

        // Associations
        if ($request->filled('metal_type_id')) {
            ProductsToMetalType::create([
                'sptmt_products_id' => $product->products_id,
                'sptmt_metal_type_id' => $request->metal_type_id
            ]);
        }

        if ($request->filled('categories_id')) {
            ProductToCategory::create([
                'products_id' => $product->products_id,
                'categories_id' => $request->categories_id
            ]);
        }

        if ($request->filled('options_id')) {
            ProductToOption::create([
                'products_id' => $product->products_id,
                'options_id' => $request->options_id,
            ]);
        }

        ProductToShape::create([
            'products_id' => $product->products_id,
            'shape_id' => $request->shape_id
        ]);

        ProductToStoneType::create([
            'sptst_products_id' => $product->products_id,
            'sptst_stone_type_id' => $request->stone_type_id
        ]);

        if ($request->filled('style_category_id')) {
            ProductToStyleCategory::create([
                'sptsc_products_id' => $product->products_id,
                'sptsc_style_category_id' => $request->style_category_id
            ]);
        }

        if ($request->filled('style_group_id')) {
            ProductToStyleGroup::create([
                'sptsg_products_id' => $product->products_id,
                'sptsg_style_category_id' => $request->style_group_id
            ]);
        }

        if ($request->filled('shop_zone_id') && $request->filled('geo_zone_id')) {
            ShopZonesToGeoZone::create([
                'zone_id' => $request->shop_zone_id,
                'geo_zone_id' => $request->geo_zone_id,
                'products_id' => $product->products_id
            ]);
        }

        return response()->json([
            'redirect' => route('product.index'),
            'message' => 'Product created successfully!',
            'type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $product = Product::with([
            'variations',
            'images'
        ])->findOrFail($id);

        $isParentCategory = Category::where('category_id', $product->categories_id)
        ->whereNull('parent_id')
        ->exists();

        $selectedCategoryValue = $isParentCategory 
            ? 'parent_'.$product->categories_id 
            : $product->categories_id;

        $initialPscId = $product->psc_id ?? '';
        $initialCollectionId = $product->product_collection_id ?? '';
        $initialStyleGroupId = $product->product_style_group_id ?? '';

        $vendors = DiamondVendor::select('vendorid', 'vendor_name')->get();
        $stock_numbers = DiamondMaster::select('diamondid','vendor_stock_number')->limit(100)->get();
        $vendor_prices = DiamondMaster::select('vendor_price')
            ->distinct()
            ->orderBy('vendor_price', 'asc')
            ->limit(100)
            ->get();
        $countries = Country::select('country_id', 'country_name')->get();
        
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();

        $diamond_qualities = \App\Models\DiamondQualityGroup::pluck('dqg_name', 'dqg_id');
        $diamond_clarities = \App\Models\ProductClarityMaster::pluck('name', 'id');
        $diamond_colors = \App\Models\ProductsColorMaster::pluck('name', 'id');
        $diamond_cuts = \App\Models\ProductsCutMaster::pluck('name', 'id');
        $stone_types = \App\Models\ProductStoneType::pluck('pst_name', 'pst_id');
        $metal_types = \App\Models\MetalType::pluck('dmt_name', 'dmt_id');
        $metal_colors = \App\Models\MetalType::pluck('color_code', 'dmt_id');
        $shapes = \App\Models\DiamondShape::select('id', 'name')->get();
        $shopZones = \App\Models\ShopZone::pluck('zone_name', 'zone_id');
        $options = \App\Models\ProductToOption::pluck('products_to_option_id');
        $style_categories = \App\Models\ProductToStyleCategory::pluck('sptsc_id');
        $style_groups = \App\Models\ProductToStyleGroup::pluck('sptsg_id');
        $geo_zones = \App\Models\ShopZonesToGeoZone::pluck('association_id');
        $metal_to_types = \App\Models\ProductsToMetalType::pluck('sptmt_id');
        $product_to_categories = \App\Models\ProductToCategory::pluck('id');
        $shape_types = \App\Models\ProductToShape::pluck('pts_id');
        $stone_to_types = \App\Models\ProductToStoneType::pluck('sptst_id');
        $metalColor = \App\Models\ProductMetalColor::pluck('dmc_name', 'dmc_id');
        $diamondLabs = \App\Models\DiamondLab::all();
        $weightGroups = \App\Models\DiamondWeightGroup::pluck('dwg_name', 'dwg_id') ;
        $metal_types_colors = \App\Models\MetalType::pluck('dmt_name', 'dmt_id');
        $parentCategories = Category::whereNull('parent_id')->get();
        $childCategories = Category::where('parent_id', $product->parent_category_id)->get();
                $styleCategories = \App\Models\ProductStyleCategory::where('engagement_menu', 1)
                    ->pluck('psc_name', 'psc_id');
        $collections = \App\Models\ProductCollection::pluck('name', 'id');
        $styleGroups = ProductStyleGroup::all()
        ->map(function($group) {
            $names = json_decode($group->psg_names, true);
            $group->formatted_names = is_array($names) ? implode(', ', $names) : $group->psg_names;
            return $group;
        })
        ->pluck('formatted_names', 'psg_id');


        return view('admin.Jewellery.Product.edit', compact(
            'product',
            'isParentCategory',
            'vendors',
            'stock_numbers',
            'vendor_prices',
            'countries',
            'categories',
            'diamond_qualities',
            'diamond_clarities',
            'diamond_colors',
            'diamond_cuts',
            'stone_types',
            'metal_types',
            'metal_colors',
            'shapes',
            'shopZones',
            'metal_to_types',
            'stone_to_types',
            'options',
            'style_categories',
            'style_groups',
            'geo_zones',
            'product_to_categories',
            'shape_types',
            'metalColor',
            'diamondLabs',
            'weightGroups',
            'metal_types_colors',
            'parentCategories',
            'childCategories',
            'styleCategories',
            'collections',
            'styleGroups',
            'selectedCategoryValue',
            'initialPscId',
            'initialCollectionId',
            'initialStyleGroupId'
        ));
    }

    public function update(Request $request, $id)
    {
        $selectedCategory = $request->categories_id;
        $isParent = false;
        
        if (strpos($selectedCategory, 'parent_') === 0) {
            $categoryId = str_replace('parent_', '', $selectedCategory);
            $request->merge(['categories_id' => $categoryId]);
            $isParent = true;
        }

        $rules = $this->getValidationRules();
        $messages = $this->getValidationMessages();

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = Product::findOrFail($id);
        $data = $request->except([
            'variations', 
            'removed_variation_images'
        ]);
        $data['updated_by'] = Auth::id();
        $data['date_updated'] = now();
        $product->update($data);

        // Update or create variations
        $usedVariationIds = [];

        // Create variation_images directory if not exists
        if (!Storage::disk('public')->exists('variation_images')) {
            Storage::disk('public')->makeDirectory('variation_images');
        }
        
        // Create variation_videos directory if not exists
        if (!Storage::disk('public')->exists('variation_videos')) {
            Storage::disk('public')->makeDirectory('variation_videos');
        }

        if ($request->has('variations')) {
            foreach ($request->variations as $index => $variation) {
                $imagePaths = [];
                $videoName = null;
                
                // Process existing images
                if (isset($variation['existing_images'])) {
                    $imagePaths = is_array($variation['existing_images']) 
                        ? $variation['existing_images'] 
                        : [$variation['existing_images']];
                }

                // Handle removed images
                if (!empty($variation['removed_images'])) {
                    $removedImages = explode(',', $variation['removed_images']);
                    foreach ($removedImages as $img) {
                        if (!empty($img)) {
                            Storage::disk('public')->delete("variation_images/$img");
                            $key = array_search($img, $imagePaths);
                            if ($key !== false) {
                                unset($imagePaths[$key]);
                            }
                        }
                    }
                    $imagePaths = array_values($imagePaths);
                }

                // Process new images
                if ($request->hasFile("variations.$index.images")) {
                    foreach ($request->file("variations.$index.images") as $file) {
                        if ($file->isValid()) {
                            $filename = 'variation_' . time() . '_' . Str::random(10) . '.' . $file->extension();
                            $file->storeAs('variation_images', $filename, 'public');
                            $imagePaths[] = $filename;
                        }
                    }
                }
                
                // Process video
                $videoName = null;

                if ($request->hasFile("variations.$index.video")) {
                    $video = $request->file("variations.$index.video");
                    if ($video->isValid()) {
                        // Delete old video if exists
                        if (!empty($variation['existing_video'])) {
                            Storage::disk('public')->delete("variation_videos/{$variation['existing_video']}");
                        }
                        
                        $videoName = 'variation_video_' . time() . '_' . Str::random(10) . '.' . $video->extension();
                        $video->storeAs('variation_videos', $videoName, 'public');
                    }
                } elseif (isset($variation['existing_video']) && !isset($variation['remove_video'])) {
                    $videoName = $variation['existing_video'];
                }

                // Handle video removal
                if (isset($variation['remove_video']) && $variation['remove_video'] == '1') {
                    if (!empty($variation['existing_video'])) {
                        Storage::disk('public')->delete("variation_videos/{$variation['existing_video']}");
                    }
                    $videoName = null;
                }
                // Update existing variation
                if (isset($variation['id']) && $variation['id'] !== 'new') {
                    $existingVariation = $product->variations()->find($variation['id']);
                    if ($existingVariation) {
                        $variationData = [
                            'weight' => $variation['weight'],
                            'price' => $variation['price'],
                            'regular_price' => $variation['regular_price'],
                            'stock' => $variation['stock'] ?? 0,
                            'metal_color_id' => $variation['metal_color_id'] ?? null,
                            'shape_id' => $variation['shape_id'] ?? null,
                            'images' => $imagePaths,
                            'video' => $videoName // Always include video field
                        ];

                        $existingVariation->update($variationData);

                        $usedVariationIds[] = $existingVariation->id;
                        continue;
                    }
                }

                // Create new variation
                $weight = $variation['weight'];
                $weightStr = str_replace('.', '', number_format($weight, 2, '.', ''));
                
                $shapeId = $variation['shape_id'] ?? null;
                $shape = \App\Models\DiamondShape::find($shapeId);
                $shapeCode = $shape ? strtoupper(substr($shape->name, 0, 2)) : 'XX';

                $baseSku = 'PRD-' . $product->products_id . '-' . $shapeCode . '-' . $weightStr;
                $sku = $baseSku;
                $suffix = 1;

                while ($product->variations()->where('sku', $sku)->exists()) {
                    $sku = $baseSku . '-' . $suffix++;
                }

                $variationData = [
                    'weight' => $weight,
                    'price' => $variation['price'],
                    'regular_price' => $variation['regular_price'],
                    'sku' => $sku,
                    'stock' => $variation['stock'] ?? 0,
                    'metal_color_id' => $variation['metal_color_id'] ?? null,
                    'shape_id' => $variation['shape_id'] ?? null,
                    'images' => $imagePaths
                ];
                
                if ($videoName !== null) {
                    $variationData['video'] = $videoName;
                }

                $newVariation = $product->variations()->create($variationData);
                $usedVariationIds[] = $newVariation->id;
            }
        }

        // Delete removed variations
        $variationsToDelete = $product->variations()->whereNotIn('id', $usedVariationIds)->get();

        foreach ($variationsToDelete as $variation) {
            if (!empty($variation->images)) {
                foreach ($variation->images as $imagePath) {
                    if (!empty($imagePath)) {
                        Storage::disk('public')->delete("variation_images/$imagePath");
                    }
                }
            }
            
            if (!empty($variation->video)) {
                Storage::disk('public')->delete("variation_videos/{$variation->video}");
            }
            
            $variation->delete();
        }

        // ✅ Associations update
        \App\Models\ProductsToMetalType::updateOrCreate(
            ['sptmt_products_id' => $id],
            ['sptmt_metal_type_id' => $request->metal_type_id]
        );

        if ($request->is_build_product == 0) {
            ProductToCategory::updateOrCreate(
                ['products_id' => $id],
                ['categories_id' => $request->categories_id]
            );
        } else {
            ProductToCategory::where('products_id', $id)->delete();
        }

        \App\Models\ProductToOption::updateOrCreate(
            ['products_id' => $id],
            ['options_id' => $request->options_id]
        );

        \App\Models\ProductToShape::updateOrCreate(
            ['products_id' => $id],
            ['shape_id' => $request->shape_id]
        );

        \App\Models\ProductToStoneType::updateOrCreate(
            ['sptst_products_id' => $id],
            ['sptst_stone_type_id' => $request->stone_type_id]
        );

        \App\Models\ProductToStyleCategory::updateOrCreate(
            ['sptsc_products_id' => $id],
            ['sptsc_style_category_id' => $request->style_category_id]
        );

        \App\Models\ProductToStyleGroup::updateOrCreate(
            ['sptsg_products_id' => $id],
            ['sptsg_style_category_id' => $request->style_group_id]
        );

        \App\Models\ShopZonesToGeoZone::updateOrCreate(
            [
                'zone_id' => $request->shop_zone_id,
                'products_id' => $product->products_id
            ],
            [
                'geo_zone_id' => $request->geo_zone_id
            ]
        );

        return response()->json([
            'redirect' => route('product.index'),
            'message' => 'Product updated successfully!',
            'type' => 'success'
        ]);
    }

    public function getCategoryPscAndCollections(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'is_parent' => 'nullable|boolean'
        ]);

        $categoryId = $request->input('category_id');
        $isParent = $request->input('is_parent', false);

        // Get style categories for this category
        $styleCategories = \App\Models\ProductStyleCategory::query();
        if ($isParent) {
            $styleCategories->where('parent_category_id', $categoryId);
        } else {
            $styleCategories->where('psc_category_id', $categoryId);
        }
        $styleCategories = $styleCategories->get(['psc_id', 'psc_name']);

        // Get collections for this category
        $collections = \App\Models\ProductCollection::where('parent_category_id', $categoryId)
            ->orWhere('product_category_id', $categoryId)
            ->get(['id', 'name']);

        return response()->json([
            'styleCategories' => $styleCategories,
            'collections' => $collections
        ]);
    }

    public function getStyleGroupsByCollection(Request $request)
    {
        $collectionId = $request->input('collection_id');
        
        $styleGroups = \App\Models\ProductStyleGroup::where('collection_id', $collectionId)
            ->get()
            ->map(function($group) {
                $names = json_decode($group->psg_names, true);
                return [
                    'psg_id' => $group->psg_id,
                    'psg_names' => is_array($names) ? implode(', ', $names) : $group->psg_names
                ];
            });

        return response()->json($styleGroups);
    }

     public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        foreach ($product->variations as $variation) {
            // Delete variation images
            if (!empty($variation->images)) {
                foreach ($variation->images as $imagePath) {
                    if (!empty($imagePath)) {
                        Storage::disk('public')->delete("variation_images/$imagePath");
                    }
                }
            }
            
            // Delete variation video
            if (!empty($variation->video)) {
                $videoPath = "variation_videos/" . $variation->video;
                if (Storage::disk('public')->exists($videoPath)) {
                    Storage::disk('public')->delete($videoPath);
                }
            }
            
            $variation->delete();
        }
        
        $product->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully!',
            'type' => 'success'
        ]);
    }

    private function getValidationRules()
    {
        $rules = [
            'products_name'               => 'required|string|max:255',
            'products_status'             => 'required|in:0,1',
            'products_slug'               => 'required|string|max:150',
            'vendor_id'                   => 'required|integer',
            'featured_image'              => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'gallery_images.*'            => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'variations.*.metal_color_id' => 'required|exists:metal_type,dmt_id',
            'variations.*.weight'         => 'required|numeric|min:0.01',
            'variations.*.price'          => 'required|numeric|min:0',
            'is_build_product'            => 'required|in:0,1',
            'variations.*.regular_price'  => 'required|numeric|min:0',
            'variations.*.price'          => 'required|numeric|min:0|lte:variations.*.regular_price',
            'variations.*.shape_id'       => 'required|exists:diamond_shape_master,id',
            'variations.*.video'          => 'sometimes|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:51200',
        ];

        if (request('is_build_product') == '1') {
                        $rules['psc_id'] = 'required|exists:products_style_category,psc_id'; 

        } else {
            $rules['categories_id'] = 'required';
        }

        return $rules;
    }

    private function getValidationMessages()
    {
        return [
            'products_name.required'             => 'Product Name is required.',
            'products_name.string'               => 'Product Name must be a valid string.',
            'products_name.max'                  => 'Product Name may not exceed 255 characters.',
            'products_description.required'      => 'Description must be a valid string.',
            'products_short_description.string'  => 'Short Description must be a valid string.',
            'products_short_description.max'     => 'Short Description may not exceed 255 characters.',
            'available.string'                   => 'Availability must be a valid string.',
            'available.max'                      => 'Availability may not exceed 255 characters.',
            'products_quantity.integer'          => 'Quantity must be an integer.',
            'products_model.string'              => 'Model must be a valid string.',
            'products_model.max'                 => 'Model may not exceed 150 characters.',
            'master_sku.string'                  => 'Master SKU must be a valid string.',
            'master_sku.max'                     => 'Master SKU may not exceed 255 characters.',
            'shape_id.required'                  => 'Shape is required.',
            'shop_zone_id.integer'               => 'Shop Zone must be an integer.',
            'ready_to_ship.boolean'              => 'Ready to Ship must be true or false.',
            'products_price.numeric'             => 'Price must be a valid number.',
            'products_price1.numeric'            => 'Price 1 must be a valid number.',
            'products_price2.numeric'            => 'Price 2 must be a valid number.',
            'products_price3.numeric'            => 'Price 3 must be a valid number.',
            'products_price4.numeric'            => 'Price 4 must be a valid number.',
            'products_status.in'                 => 'Status must be either 0 (Inactive) or 1 (Active).',
            'engraving_status.in'                => 'Engraving Status must be either 0 (No) or 1 (Yes).',
            'products_slug.string'               => 'Slug must be a valid string.',
            'products_slug.max'                  => 'Slug may not exceed 150 characters.',
            'catelog_no.string'                  => 'Catalog Number must be a valid string.',
            'catelog_no.max'                     => 'Catalog Number may not exceed 255 characters.',
            'vendor_id.integer'                  => 'Vendor ID must be an integer.',
            'vendor_stock_no.string'             => 'Vendor Stock Number must be a valid string.',
            'vendor_stock_no.max'                => 'Vendor Stock Number may not exceed 255 characters.',
            'vendor_price.numeric'               => 'Vendor Price must be a valid number.',
            'country_of_origin.integer'          => 'Country of Origin must be an integer.',
            'products_tax_class_id.integer'      => 'Tax Class ID must be an integer.',
            'products_tax.numeric'               => 'Tax must be a valid number.',
            'is_bestseller.in'                   => 'Bestseller must be either 0 (No) or 1 (Yes).',
            'is_featured.in'                     => 'Featured must be either 0 (No) or 1 (Yes).',
            'ready_to_ship.boolean'              => 'Ready to Ship must be a boolean.',
            'is_collection.in'                   => 'Collection must be either 0 (No) or 1 (Yes).',
            'is_new.in'                          => 'New must be either 0 (No) or 1 (Yes).',
            'is_superdeals.in'                   => 'SuperDeals must be either 0 (No) or 1 (Yes).',
            'diamond_weight_group_id.integer'    => 'Diamond Weight Group ID must be an integer.',
            'diamond_quality_id.integer'         => 'Diamond Quality ID must be an integer.',
            'diamond_clarity_id.integer'         => 'Diamond Clarity ID must be an integer.',
            'diamond_color_id.integer'           => 'Diamond Color ID must be an integer.',
            'diamond_cut_id.integer'             => 'Diamond Cut ID must be an integer.',
            'diamond_pics.integer'               => 'Diamond Pics must be an integer.',
            'side_diamond_quality_id.integer'    => 'Side Diamond Quality ID must be an integer.',
            'side_diamond_breakdown.string'      => 'Side Diamond Breakdown must be a valid string.',
            'semi_mount_ct_wt.numeric'           => 'Semi Mount CT Weight must be a valid number.',
            'total_carat_weight.numeric'         => 'Total Carat Weight must be a valid number.',
            'semi_mount_price.numeric'           => 'Semi Mount Price must be a valid number.',
            'center_stone_price.numeric'         => 'Center Stone Price must be a valid number.',
            'center_stone_weight.numeric'        => 'Center Stone Weight must be a valid number.',
            'center_stone_type_id.integer'       => 'Center Stone Type ID must be an integer.',
            'stone_type_id.integer'              => 'Stone Type ID must be an integer.',
            'metal_type_id.integer'              => 'Metal Type ID must be an integer.',
            'metal_weight.numeric'               => 'Metal Weight must be a valid number.',
            'build_product_type.string'          => 'Build Product Type must be a valid string.',
            'build_product_type.max'             => 'Build Product Type may not exceed 250 characters.',
            'is_matching_set.in'                 => 'Matching Set must be either 0 (No) or 1 (Yes).',
            'product_keywords.string'            => 'Product Keywords must be a valid string.',
            'product_promotion.string'           => 'Product Promotion must be a valid string.',
            'certified_lab.string'               => 'Certified Lab must be a valid string.',
            'certificate_number.string'          => 'Certificate Number must be a valid string.',
            'products_related_items.string'      => 'Related Items must be a valid string.',
            'products_related_items.max'         => 'Related Items may not exceed 255 characters.',
            'products_meta_title.string'         => 'Meta Title must be a valid string.',
            'products_meta_description.string'   => 'Meta Description must be a valid string.',
            'products_meta_keyword.string'       => 'Meta Keyword must be a valid string.',
            'delivery_days.integer'              => 'Delivery Days must be an integer.',
            'default_size.string'                => 'Default Size must be a valid string.',
            'default_size.max'                   => 'Default Size may not exceed 10 characters.',
            'deleted.in'                         => 'Deleted must be either 0 (No) or 1 (Yes).',
            'sort_order.integer'                 => 'Sort Order must be an integer.',
            'variations.*.weight.required'       => 'Weight is required for all variations.',
            'variations.*.weight.numeric'        => 'Weight must be a numeric value.',
            'variations.*.weight.min'            => 'Weight must be at least 0.01.',
            'variations.*.price.required'        => 'Price is required for all variations.',
            'variations.*.price.required'        => 'Price is required for all variations.',
            'variations.*.regular_price.required' => 'Regular Price is required for all variations.',
            'variations.*.regular_price.numeric' => 'Regular Price must be a numeric value.',
            'variations.*.price.lte' => 'Price must be less than or equal to Regular Price.',
            'variations.*.shape_id.required' => 'Shape is required for all variations.',
            'variations.*.metal_color_id.required' => 'Metal color is required for all variations.',
            'variations.*.video.max' => 'The video size cannot exceed 50MB. Please upload a smaller video.',
            'variations.*.video.mimetypes' => 'The video file is in an invalid format. Only AVI, MPEG, QuickTime, or MP4 files are allowed.',
            'psc_id.required'         => 'Style Category is required when Build Product is selected.',
            'categories_id.required'  => 'Product Category is required when Build Product is not selected.',
        ];
    }
}