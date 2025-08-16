<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use \App\Models\Category;
use App\Models\ProductVariation;
use App\Models\ProductStyleCategory;
use App\Models\ProductCollection;
use App\Models\MetalType;
use App\Models\DiamondShape;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function jewelryData(Request $request, $slug = null)
    {
        $filters = [
            'category' => $request->input('category'),
            'subcategory' => $request->input('subcategory'),
            'menucollection' => $request->input('menucollection'),
            'price' => $request->input('price'),
            'style' => $request->input('style'),
            'collection' => $request->input('collection'),
            'ready_to_ship' => $request->input('ready_to_ship'),
            'sort' => $request->input('sort'),
            'metal_color_id' => $request->input('metal_color_id'),
        ];

        // Always set is_build_product to 0
        $filters['is_build_product'] = 0;

        if (!empty($filters['price'])) {
            $filters['price'] = str_replace(['\u2013', ' '], ['-', ''], $filters['price']);
        }

        $perPage = (int) $request->input('perPage', 20);
        $page = (int) $request->input('page', 1);

        // Set Banner Image Based on Category / Subcategory / Collection
        $bannerImage = null;
        $bannerVideo = null;
        if (!empty($filters['subcategory'])) {
            $subcategory = Category::select('category_header_banner')->find($filters['subcategory']);
            $bannerImage = $subcategory?->category_header_banner ?? null;
        } elseif (!empty($filters['category'])) {
            $category = Category::select('category_header_banner')->find($filters['category']);
            $bannerImage = $category?->category_header_banner ?? null;
        } elseif (!empty($filters['menucollection'])) {
            $collection = ProductCollection::select('banner_image', 'banner_video')->find($filters['menucollection']);
            if (!empty($collection->banner_video)) {
                $bannerVideo = $collection->banner_video;
            } else {
                $bannerImage = $collection->banner_image ?? null;
            }
        }

        // Fetch Style Data
        $styleData = !empty($filters['subcategory']) || !empty($filters['category'])
            ? ProductStyleCategory::where('psc_category_id', $filters['subcategory'] ?? $filters['category'])->get()
            : ProductStyleCategory::join(DB::raw('(
                SELECT MIN(psc_id) as psc_id FROM products_style_category
                WHERE parent_category_id IS NULL GROUP BY psc_category_id
            ) as grouped_styles'), 'products_style_category.psc_id', '=', 'grouped_styles.psc_id')
                ->select('products_style_category.*')->get();

        // Fetch Collection Data
        if (!empty($filters['subcategory']) && !empty($filters['category'])) {
            $collectionData = ProductCollection::where('product_category_id', $filters['subcategory'])->get();
        } elseif (!empty($filters['category'])) {
            $collectionData = ProductCollection::where('parent_category_id', $filters['category'])->get();
        } else {
            $collectionData = ProductCollection::join(DB::raw('(
                    SELECT MIN(id) as id
                    FROM product_collections
                    WHERE parent_category_id IS NOT NULL AND product_category_id IS NULL
                    GROUP BY parent_category_id
                ) as grouped_collection'), 'product_collections.id', '=', 'grouped_collection.id')
                ->select('product_collections.*')
                ->get();
        }

        // Sort Metal Types
        $metalTypes = MetalType::all()->sort(function ($a, $b) {
            $aVal = is_numeric(substr($a->dmt_tooltip, 0, 2)) ? (int) filter_var($a->dmt_tooltip, FILTER_SANITIZE_NUMBER_INT) : 999;
            $bVal = is_numeric(substr($b->dmt_tooltip, 0, 2)) ? (int) filter_var($b->dmt_tooltip, FILTER_SANITIZE_NUMBER_INT) : 999;
            return $aVal <=> $bVal;
        })->values();

        // START FROM VARIATION TABLE
        $variationQuery = ProductVariation::query();

        // Filter by price
        if (!empty($filters['price']) && preg_match('/^(\d+)-(\d+)$/', $filters['price'])) {
            [$min, $max] = explode('-', $filters['price']);
            $variationQuery->whereBetween('price', [(int) $min, (int) $max]);
        }

        // Filter by metal color
        if (!empty($filters['metal_color_id'])) {
            $variationQuery->where('metal_color_id', $filters['metal_color_id']);
        }

        // Join product table for category-based filtering
        $variationQuery->whereHas('product', function ($query) use ($filters) {
            if (!empty($filters['subcategory'])) {
                $query->where('categories_id', $filters['subcategory']);
            } elseif (!empty($filters['category'])) {
                $query->where('categories_id', $filters['category']);
            }

            if (!empty($filters['menucollection'])) {
                $query->where('product_collection_id', $filters['menucollection']);
            }
            if (!empty($filters['style']))
                $query->where('psc_id', $filters['style']);
            if (!empty($filters['collection']))
                $query->where('product_collection_id', $filters['collection']);
            if (!empty($filters['ready_to_ship']) && $filters['ready_to_ship'] === 'true')
                $query->where('ready_to_ship', 1);

            // Always enforce is_build_product = 0
            $query->where('is_build_product', 0);
        });

        // Get product IDs from filtered variations
        $filteredProductIds = $variationQuery->pluck('product_id')->unique();

        if ($filteredProductIds->isEmpty()) {
            return response()->json([
                'banner_video' => $bannerVideo,
                'banner_image' => $bannerImage,
                'style_data' => $styleData,
                'collection_data' => $collectionData,
                'metal_types' => $metalTypes,
                'data' => [],
                'totalProducts' => 0,
                'currentPage' => $page,
                'perPage' => $perPage,
                'totalPages' => 0,
            ]);
        }

        // Sorting setup
        $sort = $filters['sort'];
        $isDateSort = in_array($sort, ['date_asc', 'date_desc']);
        $sortDirection = in_array($sort, ['price_desc', 'date_desc']) ? 'desc' : 'asc';
        $priceAggFunc = $sort === 'price_desc' ? 'MAX' : 'MIN';

        if ($isDateSort) {
            $sortedProductIds = Product::whereIn('products_id', $filteredProductIds)
                ->orderBy('created_at', $sortDirection)
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->pluck('products_id');
        } else {
            $subQuery = ProductVariation::select('product_id', DB::raw("$priceAggFunc(price) as target_price"))
                ->whereIn('product_id', $filteredProductIds)
                ->groupBy('product_id');

            $sortedProductIds = ProductVariation::joinSub($subQuery, 'sorted_prices', function ($join) {
                $join->on('product_variations.product_id', '=', 'sorted_prices.product_id')
                    ->on('product_variations.price', '=', 'sorted_prices.target_price');
            })
                ->select('product_variations.product_id', 'sorted_prices.target_price')
                ->orderBy('sorted_prices.target_price', $sortDirection)
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->pluck('product_id');
        }

        // Fetch Products with filtered variations only
        $products = Product::with([
            'productcategory' => function ($q) {
                $q->select('category_id', 'category_name', 'parent_id')->with('parent:category_id,category_name');
            },
            'variations.metalColor'
        ])
            ->whereIn('products_id', $sortedProductIds)
            ->orderByRaw('FIELD(products_id, ' . implode(',', $sortedProductIds->toArray()) . ')')
            ->get();

        $validProducts = [];

        foreach ($products as $product) {
            $variations = $product->variations;

            if (!empty($filters['metal_color_id'])) {
                $hasMatchingMetal = $variations->contains('metal_color_id', $filters['metal_color_id']);
                if (!$hasMatchingMetal)
                    continue;
            }

            if (!empty($filters['price']) && preg_match('/^(\d+)-(\d+)$/', $filters['price'])) {
                [$min, $max] = explode('-', $filters['price']);
                $variations = $variations->filter(fn($v) => $v->price >= $min && $v->price <= $max);
            }

            if ($variations->isEmpty())
                continue;

            $category = $product->productcategory;
            $parent = $category?->parent;

            // Only default format now
            $groupedByMetal = $variations->groupBy('metal_color_id')->map(function ($group) use ($category, $parent) {
                return $group->map(function ($variation) use ($category, $parent) {
                    return [
                        'id' => $variation->id,
                        'product_id' => $variation->product_id,
                        'carat' => $variation->carat,
                        'price' => $variation->price,
                        'original_price' => $variation->regular_price,
                        'sku' => $variation->sku,
                        'shape_id' => $variation->shape_id,
                        'metal_color_id' => $variation->metal_color_id,
                        'metal_color' => $variation->metalColor ? [
                            'id' => $variation->metalColor->dmt_id,
                            'name' => $variation->metalColor->dmt_name,
                            'quality' => $variation->metalColor->dmt_tooltip,
                            'hex' => $variation->metalColor->color_code ?? null,
                        ] : null,
                        'weight' => $variation->weight,
                        'images' => $variation->images,
                        'category' => $category ? [
                            'id' => $category->category_id,
                            'name' => $category->category_name,
                            'parent' => $parent ? [
                                'id' => $parent->category_id,
                                'name' => $parent->category_name
                            ] : null
                        ] : null,
                    ];
                });
            })->filter(fn($group) => $group->isNotEmpty());

            $groupedByMetal = collect($groupedByMetal)->sortBy(function ($group) {
                $quality = $group->first()['metal_color']['quality'] ?? null;
                return is_numeric($quality) ? (int) $quality : PHP_INT_MAX . '_' . $quality;
            });

            $validProducts[] = [
                'id' => $product->products_id,
                'product' => [
                    'id' => $product->products_id,
                    'name' => $product->products_name,
                    'master_sku' => $product->master_sku,
                    'description' => $product->products_description,
                    'ready_to_ship' => $product->ready_to_ship,
                    'categories_id' => $product->categories_id,
                    'parent_category_id' => $product->parent_category_id,
                    'psc_id' => $product->psc_id,
                    'is_build' => $product->is_build_product,
                    'product_collection_id' => $product->product_collection_id,
                ],
                'category' => $category ? [
                    'id' => $category->category_id,
                    'name' => $category->category_name,
                    'parent' => $parent ? [
                        'id' => $parent->category_id,
                        'name' => $parent->category_name
                    ] : null
                ] : null,
                'metal_variations' => $groupedByMetal,
            ];
        }

        return response()->json([
            'banner_video' => $bannerVideo,
            'banner_image' => $bannerImage,
            'style_data' => $styleData,
            'collection_data' => $collectionData,
            'metal_types' => $metalTypes,
            'data' => $validProducts,
            'totalProducts' => $filteredProductIds->count(),
            'currentPage' => $page,
            'perPage' => $perPage,
            'totalPages' => ceil($filteredProductIds->count() / $perPage),
        ]);
    }

    public function engagementData(Request $request, $slug = null)
    {
        $filters = [
            'price' => $request->input('price'),
            'style' => $request->input('style'),
            'shape' => $request->input('shape'),
            'ready_to_ship' => $request->input('ready_to_ship'),
            'sort' => $request->input('sort'),
            'metal_color_id' => $request->input('metal_color_id'),
        ];

        // Force build products
        $filters['is_build_product'] = 1;

        if (!empty($filters['price'])) {
            $filters['price'] = str_replace(['\u2013', ' '], ['-', ''], $filters['price']);
        }

        $perPage = (int) $request->input('perPage', 20);
        $page = (int) $request->input('page', 1);

        // -------- Banner assets ----------
        $bannerImage = null;
        $bannerVideo = null;

        // -------- Metal types ----------
        $metalTypes = MetalType::all()->sort(function ($a, $b) {
            $aVal = is_numeric(substr($a->dmt_tooltip, 0, 2)) ? (int) filter_var($a->dmt_tooltip, FILTER_SANITIZE_NUMBER_INT) : 999;
            $bVal = is_numeric(substr($b->dmt_tooltip, 0, 2)) ? (int) filter_var($b->dmt_tooltip, FILTER_SANITIZE_NUMBER_INT) : 999;
            return $aVal <=> $bVal;
        })->values();

        // -------- Base query from variations ----------
        $variationQuery = ProductVariation::query();

        // Price filter
        if (!empty($filters['price']) && preg_match('/^(\d+)-(\d+)$/', $filters['price'])) {
            [$min, $max] = explode('-', $filters['price']);
            $variationQuery->whereBetween('price', [(int) $min, (int) $max]);
        }

        // Metal color filter
        if (!empty($filters['metal_color_id'])) {
            $variationQuery->where('metal_color_id', $filters['metal_color_id']);
        }

        // Shape filter
        if (!empty($filters['shape'])) {
            $variationQuery->where('shape_id', $filters['shape']);
        }

        // Product relation filters
        $variationQuery->whereHas('product', function ($query) use ($filters) {
            if (!empty($filters['style']))
                $query->where('psc_id', $filters['style']);
            if (!empty($filters['ready_to_ship']) && $filters['ready_to_ship'] === 'true') {
                $query->where('ready_to_ship', 1);
            }
            // Only build products
            $query->where('is_build_product', 1);
        });

        $filteredProductIds = $variationQuery->pluck('product_id')->unique();


        if ($filteredProductIds->isEmpty()) {
            return response()->json([
                'banner_video' => $bannerVideo,
                'banner_image' => $bannerImage,
                'metal_types' => $metalTypes,
                'data' => [],
                'totalProducts' => 0,
                'currentPage' => $page,
                'perPage' => $perPage,
                'totalPages' => 0,
            ]);
        }

        // -------- Sorting ----------
        $sort = $filters['sort'];
        $isDateSort = in_array($sort, ['date_asc', 'date_desc']);
        $sortDirection = in_array($sort, ['price_desc', 'date_desc']) ? 'desc' : 'asc';
        $priceAggFunc = $sort === 'price_desc' ? 'MAX' : 'MIN';

        if ($isDateSort) {
            $sortedProductIds = Product::whereIn('products_id', $filteredProductIds)
                ->orderBy('created_at', $sortDirection)
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->pluck('products_id');
        } else {
            $subQuery = ProductVariation::select('product_id', DB::raw("$priceAggFunc(price) as target_price"))
                ->whereIn('product_id', $filteredProductIds)
                ->groupBy('product_id');

            $sortedProductIds = ProductVariation::joinSub($subQuery, 'sorted_prices', function ($join) {
                $join->on('product_variations.product_id', '=', 'sorted_prices.product_id')
                    ->on('product_variations.price', '=', 'sorted_prices.target_price');
            })
                ->select('product_variations.product_id', 'sorted_prices.target_price')
                ->orderBy('sorted_prices.target_price', $sortDirection)
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->pluck('product_id');
        }

        // -------- Fetch products ----------
        $products = Product::with([
            'productcategory' => function ($q) {
                $q->select('category_id', 'category_name', 'parent_id')->with('parent:category_id,category_name');
            },
            'variations.metalColor'
        ])
            ->whereIn('products_id', $sortedProductIds)
            ->orderByRaw('FIELD(products_id, ' . implode(',', $sortedProductIds->toArray()) . ')')
            ->get();

        $validProducts = [];

        foreach ($products as $product) {
            $variations = $product->variations;

            if (!empty($filters['metal_color_id'])) {
                $hasMatchingMetal = $variations->contains('metal_color_id', $filters['metal_color_id']);
                if (!$hasMatchingMetal)
                    continue;
            }

            if (!empty($filters['shape'])) {
                $variations = $variations->where('shape_id', $filters['shape']);
            }

            if (!empty($filters['price']) && preg_match('/^(\d+)-(\d+)$/', $filters['price'])) {
                [$min, $max] = explode('-', $filters['price']);
                $variations = $variations->filter(fn($v) => $v->price >= $min && $v->price <= $max);
            }

            if ($variations->isEmpty())
                continue;

            $category = $product->productcategory;
            $parent = $category?->parent;

            // Build-type format: metal_color_id → shape_id → [variations...]
            $groupedByMetal = collect();

            foreach ($variations as $variation) {
                $metalId = $variation->metal_color_id;
                $shapeId = $variation->shape_id;

                $entry = [
                    'id' => $variation->id,
                    'product_id' => $variation->product_id,
                    'carat' => $variation->carat,
                    'price' => $variation->price,
                    'original_price' => $variation->regular_price,
                    'sku' => $variation->sku,
                    'shape_id' => $shapeId,
                    'metal_color_id' => $metalId,
                    'metal_color' => $variation->metalColor ? [
                        'id' => $variation->metalColor->dmt_id,
                        'name' => $variation->metalColor->dmt_name,
                        'quality' => $variation->metalColor->dmt_tooltip,
                        'hex' => $variation->metalColor->color_code ?? null,
                    ] : null,
                    'weight' => $variation->weight,
                    'images' => $variation->images,
                    'category' => $category ? [
                        'id' => $category->category_id,
                        'name' => $category->category_name,
                        'parent' => $parent ? [
                            'id' => $parent->category_id,
                            'name' => $parent->category_name
                        ] : null
                    ] : null,
                ];

                $groupedByMetal = $groupedByMetal->put(
                    $metalId,
                    $groupedByMetal->get($metalId, collect())->put(
                        $shapeId,
                        $groupedByMetal->get($metalId, collect())->get($shapeId, collect())->push($entry)
                    )
                );
            }

            if ($groupedByMetal->isEmpty())
                continue;

            $groupedByMetal = collect($groupedByMetal)->sortBy(function ($group) {
                // group = collection of shapes, so take first shape's first entry
                $first = $group->first()?->first();
                $quality = $first['metal_color']['quality'] ?? null;
                return is_numeric($quality) ? (int) $quality : PHP_INT_MAX . '_' . $quality;
            });

            $validProducts[] = [
                'id' => $product->products_id,
                'product' => [
                    'id' => $product->products_id,
                    'name' => $product->products_name,
                    'master_sku' => $product->master_sku,
                    'description' => $product->products_description,
                    'ready_to_ship' => $product->ready_to_ship,
                    'categories_id' => $product->categories_id,
                    'parent_category_id' => $product->parent_category_id,
                    'psc_id' => $product->psc_id,
                    'is_build' => $product->is_build_product,
                    'product_collection_id' => $product->product_collection_id,
                ],
                'category' => $category ? [
                    'id' => $category->category_id,
                    'name' => $category->category_name,
                    'parent' => $parent ? [
                        'id' => $parent->category_id,
                        'name' => $parent->category_name
                    ] : null
                ] : null,
                'metal_variations' => $groupedByMetal,
            ];
        }

        return response()->json([
            'banner_video' => $bannerVideo,
            'banner_image' => $bannerImage,
            'metal_types' => $metalTypes,
            'data' => $validProducts,
            'totalProducts' => $filteredProductIds->count(),
            'currentPage' => $page,
            'perPage' => $perPage,
            'totalPages' => ceil($filteredProductIds->count() / $perPage),
        ]);
    }

    // public function showById($id)
    // {
    //     $product = Product::with([
    //         'productcategory' => function ($query) {
    //             $query->select('category_id', 'category_name', 'parent_id')
    //                 ->with('parent:category_id,category_name');
    //         },
    //         'variations.metalColor' => function ($query) {
    //             $query->select('dmt_id', 'dmt_name', 'dmt_tooltip', 'color_code');
    //         },
    //         'variations.shape' => function ($query) {
    //             $query->select('id', 'name', 'image');
    //         },
    //     ])->where('products_id', $id)->first();

    //     if (!$product) {
    //         return response()->json(['message' => 'Product not found'], 404);
    //     }

    //     $category = $product->productcategory;
    //     $parent = $category?->parent;
    //     $variations = $product->variations;
    //     $isBuild = (int) ($product->is_build_product ?? $product->is_build ?? 0);

    //     // prepare quality lookup once for sorting
    //     $qualityByMetal = [];
    //     foreach ($variations as $v) {
    //         $mid = (string) $v->metal_color_id;
    //         if (!isset($qualityByMetal[$mid])) {
    //             $qualityByMetal[$mid] = optional($v->metalColor)->dmt_tooltip;
    //         }
    //     }

    //     // formatter kept inline (still a single controller method)
    //     $format = function ($variation) use ($category, $parent) {
    //         return [
    //             'id' => $variation->id,
    //             'product_id' => $variation->product_id,
    //             'carat' => $variation->carat,
    //             'price' => $variation->price,
    //             'sku' => $variation->sku,
    //             'shape_id' => $variation->shape_id,
    //             'metal_color_id' => $variation->metal_color_id,
    //             'metal_color' => $variation->metalColor ? [
    //                 'id' => $variation->metalColor->dmt_id,
    //                 'name' => $variation->metalColor->dmt_name,
    //                 'quality' => $variation->metalColor->dmt_tooltip,
    //                 'hex' => $variation->metalColor->color_code ?? null,
    //             ] : null,
    //             'shape' => $variation->shape ? [
    //                 'id' => $variation->shape->id,
    //                 'name' => $variation->shape->name,
    //                 'image' => $variation->shape->image ? asset('storage/shapes/' . $variation->shape->image) : null,
    //             ] : null,
    //             'weight' => $variation->weight,
    //             'images' => $variation->images,
    //             'category' => $category ? [
    //                 'id' => $category->category_id,
    //                 'name' => $category->category_name,
    //                 'parent' => $parent ? [
    //                     'id' => $parent->category_id,
    //                     'name' => $parent->category_name
    //                 ] : null
    //             ] : null,
    //         ];
    //     };

    //     if ($isBuild === 1) {
    //         // Build type: metal_color_id -> shape_id -> [variations...]
    //         $groupedByMetal = [];

    //         foreach ($variations as $variation) {
    //             $metalId = (string) $variation->metal_color_id;
    //             $shapeId = (string) ($variation->shape_id ?? 0);

    //             $groupedByMetal[$metalId][$shapeId] = $groupedByMetal[$metalId][$shapeId] ?? [];
    //             $groupedByMetal[$metalId][$shapeId][] = $format($variation);
    //         }

    //         // sort shapes numerically inside each metal (optional)
    //         foreach ($groupedByMetal as $metalId => $shapes) {
    //             $sortedShapeIds = array_keys($shapes);
    //             sort($sortedShapeIds, SORT_NUMERIC);
    //             $sortedShapes = [];
    //             foreach ($sortedShapeIds as $sid) {
    //                 $sortedShapes[$sid] = $shapes[$sid];
    //             }
    //             $groupedByMetal[$metalId] = $sortedShapes;
    //         }

    //         // sort metals by quality (numbers first)
    //         $metalIds = array_keys($groupedByMetal);
    //         usort($metalIds, function ($a, $b) use ($qualityByMetal) {
    //             $q1 = $qualityByMetal[$a] ?? null;
    //             $q2 = $qualityByMetal[$b] ?? null;

    //             $n1 = is_numeric($q1);
    //             $n2 = is_numeric($q2);

    //             if ($n1 && $n2)
    //                 return ((int) $q1) <=> ((int) $q2);
    //             if ($n1 && !$n2)
    //                 return -1;
    //             if (!$n1 && $n2)
    //                 return 1;
    //             return (string) $q1 <=> (string) $q2;
    //         });

    //         $sorted = [];
    //         foreach ($metalIds as $idKey) {
    //             $sorted[$idKey] = $groupedByMetal[$idKey];
    //         }
    //         $groupedByMetal = $sorted;

    //     } else {
    //         // Default: metal_color_id -> [variations...]
    //         $groupedByMetal = $variations
    //             ->groupBy('metal_color_id')
    //             ->map(function ($group) use ($format) {
    //                 return $group->map($format)->values();
    //             })
    //             ->filter(fn($group) => $group->isNotEmpty())
    //             ->toArray();

    //         // sort metals by quality (numbers first)
    //         $metalIds = array_keys($groupedByMetal);
    //         usort($metalIds, function ($a, $b) use ($qualityByMetal) {
    //             $q1 = $qualityByMetal[$a] ?? null;
    //             $q2 = $qualityByMetal[$b] ?? null;

    //             $n1 = is_numeric($q1);
    //             $n2 = is_numeric($q2);

    //             if ($n1 && $n2)
    //                 return ((int) $q1) <=> ((int) $q2);
    //             if ($n1 && !$n2)
    //                 return -1;
    //             if (!$n1 && $n2)
    //                 return 1;
    //             return (string) $q1 <=> (string) $q2;
    //         });

    //         $sorted = [];
    //         foreach ($metalIds as $idKey) {
    //             $sorted[$idKey] = $groupedByMetal[$idKey];
    //         }
    //         $groupedByMetal = $sorted;
    //     }

    //     return response()->json([
    //         'id' => $product->products_id,
    //         'product' => [
    //             'id' => $product->products_id,
    //             'name' => $product->products_name,
    //             'master_sku' => $product->master_sku,
    //             'description' => $product->products_description,
    //             'ready_to_ship' => $product->ready_to_ship,
    //             'is_build' => $isBuild,
    //         ],
    //         'category' => $category ? [
    //             'id' => $category->category_id,
    //             'name' => $category->category_name,
    //             'parent' => $parent ? [
    //                 'id' => $parent->category_id,
    //                 'name' => $parent->category_name,
    //             ] : null
    //         ] : null,
    //         'metal_variations' => $groupedByMetal,
    //     ]);
    // }

    public function showBuildProductById($id)
    {
        $product = Product::with([
            'productcategory' => function ($query) {
                $query->select('category_id', 'category_name', 'parent_id')
                    ->with('parent:category_id,category_name');
            },
            'variations.metalColor' => function ($query) {
                $query->select('dmt_id', 'dmt_name', 'dmt_tooltip', 'color_code');
            },
            'variations.shape' => function ($query) {
                $query->select('id', 'name', 'image');
            },
        ])->where('products_id', $id)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $isBuild = (int) ($product->is_build_product ?? $product->is_build ?? 0);
        if ($isBuild !== 1) {
            return response()->json(['message' => 'Product is not a build type'], 400);
        }

        $category = $product->productcategory;
        $parent = $category?->parent;
        $variations = $product->variations;

        $qualityByMetal = [];
        foreach ($variations as $v) {
            $mid = (string) $v->metal_color_id;
            if (!isset($qualityByMetal[$mid])) {
                $qualityByMetal[$mid] = optional($v->metalColor)->dmt_tooltip;
            }
        }

        $format = function ($variation) use ($category, $parent) {
            return [
                'id' => $variation->id,
                'product_id' => $variation->product_id,
                'carat' => $variation->carat,
                'price' => $variation->price,
                'sku' => $variation->sku,
                'shape_id' => $variation->shape_id,
                'metal_color_id' => $variation->metal_color_id,
                'metal_color' => $variation->metalColor ? [
                    'id' => $variation->metalColor->dmt_id,
                    'name' => $variation->metalColor->dmt_name,
                    'quality' => $variation->metalColor->dmt_tooltip,
                    'hex' => $variation->metalColor->color_code ?? null,
                ] : null,
                'shape' => $variation->shape ? [
                    'id' => $variation->shape->id,
                    'name' => $variation->shape->name,
                    'image' => $variation->shape->image ? asset('storage/shapes/' . $variation->shape->image) : null,
                ] : null,
                'weight' => $variation->weight,
                'images' => $variation->images,
                'category' => $category ? [
                    'id' => $category->category_id,
                    'name' => $category->category_name,
                    'parent' => $parent ? [
                        'id' => $parent->category_id,
                        'name' => $parent->category_name
                    ] : null
                ] : null,
            ];
        };

        $groupedByMetal = [];
        foreach ($variations as $variation) {
            $metalId = (string) $variation->metal_color_id;
            $shapeId = (string) ($variation->shape_id ?? 0);
            $groupedByMetal[$metalId][$shapeId][] = $format($variation);
        }

        foreach ($groupedByMetal as $metalId => $shapes) {
            ksort($groupedByMetal[$metalId], SORT_NUMERIC);
        }

        $metalIds = array_keys($groupedByMetal);
        usort($metalIds, function ($a, $b) use ($qualityByMetal) {
            $qa = trim($qualityByMetal[$a] ?? '');
            $qb = trim($qualityByMetal[$b] ?? '');

            // Extract leading numbers from strings like "14k", "18k"
            preg_match('/\d+/', $qa, $matchesA);
            preg_match('/\d+/', $qb, $matchesB);

            $numA = $matchesA[0] ?? null;
            $numB = $matchesB[0] ?? null;

            $hasNumA = $numA !== null;
            $hasNumB = $numB !== null;

            if ($hasNumA && $hasNumB) {
                return (int) $numA <=> (int) $numB;
            }

            if ($hasNumA)
                return -1; // numeric first
            if ($hasNumB)
                return 1;

            // both non-numeric, compare as strings
            return strcasecmp($qa, $qb);
        });


        $sorted = [];
        foreach ($metalIds as $idKey) {
            $sorted[$idKey] = $groupedByMetal[$idKey];
        }

        return response()->json([
            'id' => $product->products_id,
            'product' => [
                'id' => $product->products_id,
                'name' => $product->products_name,
                'master_sku' => $product->master_sku,
                'description' => $product->products_description,
                'ready_to_ship' => $product->ready_to_ship,
                'is_build' => $isBuild,
            ],
            'category' => $category ? [
                'id' => $category->category_id,
                'name' => $category->category_name,
                'parent' => $parent ? [
                    'id' => $parent->category_id,
                    'name' => $parent->category_name,
                ] : null
            ] : null,
            'metal_variations' => $sorted,
        ]);
    }

    public function showRegularProductById($id)
    {
        $product = Product::with([
            'productcategory' => function ($query) {
                $query->select('category_id', 'category_name', 'parent_id')
                    ->with('parent:category_id,category_name');
            },
            'variations.metalColor' => function ($query) {
                $query->select('dmt_id', 'dmt_name', 'dmt_tooltip', 'color_code');
            },
            'variations.shape' => function ($query) {
                $query->select('id', 'name', 'image');
            },
        ])->where('products_id', $id)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $isBuild = (int) ($product->is_build_product ?? $product->is_build ?? 0);
        if ($isBuild !== 0) {
            return response()->json(['message' => 'Product is not a regular type'], 400);
        }

        $category = $product->productcategory;
        $parent = $category?->parent;
        $variations = $product->variations;

        $qualityByMetal = [];
        foreach ($variations as $v) {
            $mid = (string) $v->metal_color_id;
            if (!isset($qualityByMetal[$mid])) {
                $qualityByMetal[$mid] = optional($v->metalColor)->dmt_tooltip;
            }
        }

        $format = function ($variation) use ($category, $parent) {
            return [
                'id' => $variation->id,
                'product_id' => $variation->product_id,
                'carat' => $variation->carat,
                'price' => $variation->price,
                'sku' => $variation->sku,
                'shape_id' => $variation->shape_id,
                'metal_color_id' => $variation->metal_color_id,
                'metal_color' => $variation->metalColor ? [
                    'id' => $variation->metalColor->dmt_id,
                    'name' => $variation->metalColor->dmt_name,
                    'quality' => $variation->metalColor->dmt_tooltip,
                    'hex' => $variation->metalColor->color_code ?? null,
                ] : null,
                'shape' => $variation->shape ? [
                    'id' => $variation->shape->id,
                    'name' => $variation->shape->name,
                    'image' => $variation->shape->image ? asset('storage/shapes/' . $variation->shape->image) : null,
                ] : null,
                'weight' => $variation->weight,
                'images' => $variation->images,
                'category' => $category ? [
                    'id' => $category->category_id,
                    'name' => $category->category_name,
                    'parent' => $parent ? [
                        'id' => $parent->category_id,
                        'name' => $parent->category_name
                    ] : null
                ] : null,
            ];
        };

        $groupedByMetal = $variations
            ->groupBy('metal_color_id')
            ->map(function ($group) use ($format) {
                return $group->map($format)->values();
            })
            ->filter(fn($group) => $group->isNotEmpty())
            ->toArray();

        $metalIds = array_keys($groupedByMetal);
        usort($metalIds, function ($a, $b) use ($qualityByMetal) {
            $q1 = $qualityByMetal[$a] ?? null;
            $q2 = $qualityByMetal[$b] ?? null;
            $n1 = is_numeric($q1);
            $n2 = is_numeric($q2);
            if ($n1 && $n2)
                return ((int) $q1) <=> ((int) $q2);
            if ($n1)
                return -1;
            if ($n2)
                return 1;
            return strcmp((string) $q1, (string) $q2);
        });

        $sorted = [];
        foreach ($metalIds as $idKey) {
            $sorted[$idKey] = $groupedByMetal[$idKey];
        }

        return response()->json([
            'id' => $product->products_id,
            'product' => [
                'id' => $product->products_id,
                'name' => $product->products_name,
                'master_sku' => $product->master_sku,
                'description' => $product->products_description,
                'ready_to_ship' => $product->ready_to_ship,
                'is_build' => $isBuild,
            ],
            'category' => $category ? [
                'id' => $category->category_id,
                'name' => $category->category_name,
                'parent' => $parent ? [
                    'id' => $parent->category_id,
                    'name' => $parent->category_name,
                ] : null
            ] : null,
            'metal_variations' => $sorted,
        ]);
    }

}