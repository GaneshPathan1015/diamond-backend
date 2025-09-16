@extends('admin.layouts.master')
@section('main_section')
    <style>
        :root {
            --primary: #007bff;
            --secondary: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --light: #f8f9fa;
            --dark: #343a40;
        }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        box-sizing: border-box;
        list-style: none;
        margin: 0;
        padding: 0 5px;
        width: 505px !important; 
    }
        
        .container-xxl {
            background-color: #f1f1f1;
            padding: 20px;
        }
        
        .card {
            border: none;
            border-radius: 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            background: #fff;
        }
        
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
            padding: 15px 20px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .form-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            color: #555;
        }
        
        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 5px;
            color: #333;
        }
        
        .form-control, .form-select {
            border-radius: 3px;
            padding: 8px 12px;
            font-size: 0.9rem;
            border: 1px solid #ddd;
            height: auto;
        }
        
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
            border-color: #007bff;
        }
        
        .nav-tabs {
            border-bottom: 2px solid #dee2e6;
            margin-bottom: 20px;
        }
        
        .nav-tabs .nav-link {
            border: none;
            padding: 10px 20px;
            font-weight: 500;
            color: #6c757d;
            border-radius: 0;
        }
        
        .nav-tabs .nav-link.active {
            color: #007bff;
            background: transparent;
            border-bottom: 3px solid #007bff;
        }
        
        .sticky-variations {
            position: sticky;
            top: 20px;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .submit-section {
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            border: 1px solid #eaeef2;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }
        
        .image-preview-item {
            position: relative;
            width: 100px;
            height: 100px;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .image-preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .image-preview-item .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(0,0,0,0.7);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        
        .error-message {
            color: red;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .is-invalid {
            border-color: red !important;
        }
        
        .woocommerce-layout {
            display: contents;
            grid-template-columns: 1fr 300px;
            gap: 20px;
        }
        
        .woocommerce-main {
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
        }
        
        .woocommerce-sidebar {
            background: #fff;
        }
        
        .woocommerce-section {
            margin-bottom: 30px;
        }
        
        .woocommerce-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        /* New variations table styles */
        .variations-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        .variations-table th {
            background-color: #f8f9fa;
            padding: 12px 15px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
        }
        
        .variations-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }
        
        .variations-table tr:hover {
            background-color: #f8fafc;
        }
        
        .variation-image-cell {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }
        
        .variation-image-preview {
            width: 60px;
            height: 60px;
            background: #f8f9fa;
            border: 1px dashed #cbd5e1;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            cursor: pointer;
        }
        
        .variation-image-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }
        
        .action-cell {
            white-space: nowrap;
        }
        
        .btn-icon {
            padding: 5px 8px;
            border-radius: 4px;
            margin-right: 5px;
        }
        
        @media (max-width: 992px) {
            .woocommerce-layout {
                grid-template-columns: 1fr;
            }
            
            .sticky-variations {
                position: static;
            }
        }
        .container-xxl {
            background-color: #f1f1f1;
            padding: 20px;
        }
        
        .card {
            border: none;
            border-radius: 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

    </style>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-cube me-2"></i>Add New Product</h4>
            </div>
        
            <div class="card-body">
                <form id="productForm" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                
                    <div class="woocommerce-layout">
                        <!-- Main Content Area -->
                        <div class="woocommerce-main">
                            <ul class="nav nav-tabs" id="productTabs">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general">General</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" id="variations-tab" data-bs-toggle="tab" data-bs-target="#variations">Variations</button>
                                </li>

                                <li class="nav-item">
                                    <button type="button" class="nav-link" id="pricing-tab" data-bs-toggle="tab" data-bs-target="#pricing">Pricing</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping">Shipping</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" id="advanced-tab" data-bs-toggle="tab" data-bs-target="#advanced">Advanced</button>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <!-- General Tab -->
                                <div class="tab-pane fade show active" id="general">
                                    <div class="woocommerce-section">
                                        <div class="woocommerce-section-title">Product Details</div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Product Name *</label>
                                                <input type="text" id="products_name" name="products_name" class="form-control"
                                                    value="{{ old('products_name', $product->products_name ?? '') }}" required>
                                                <div class="error-message" id="error-products_name"></div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Slug *</label>
                                                <input type="text" id="products_slug" name="products_slug" class="form-control"
                                                    value="{{ old('products_slug', $product->products_slug ?? '') }}" readonly>
                                                <div class="error-message" id="error-products_slug"></div>
                                            </div>

                                            <!-- Build Product -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Build Product *</label>
                                                <div>
                                                    <select name="is_build_product" class="form-select" required>
                                                        <option selected disabled value="">Select Build Product</option>
                                                        <option value="1" {{ old('is_build_product', $product->is_build_product ?? '') == '1' ? 'selected' : '' }}>Yes</option>
                                                        <option value="0" {{ old('is_build_product', $product->is_build_product ?? '') == '0' ? 'selected' : '' }}>No</option>
                                                    </select>
                                                    <div class="error-message" id="error-is_build_product"></div>
                                                </div>
                                            </div>

                                            <!-- Style Category (shown for build product = Yes) -->
                                            <div class="col-md-6 mb-3 build-field">
                                                <label class="form-label">Style Category *</label>
                                                <select id="psc_id" name="psc_id" class="form-select">
                                                    <option value="">Select Style Category</option>
                                                    @foreach($styleCategories as $id => $name)
                                                        <option value="{{ $id }}" {{ old('psc_id', $product->psc_id ?? '') == $id ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message" id="error-psc_id"></div>
                                            </div>

                                            <!-- Product Category (shown for build product = No) -->
                                            <div class="col-md-6 mb-3 non-build-field">
                                                <label class="form-label">Product Category *</label>
                                                <select id="categories_id" name="categories_id" class="form-select">
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $parent)
                                                        <optgroup label="{{ $parent->category_name }}" data-parent-id="{{ $parent->category_id }}">
                                                            <option value="parent_{{ $parent->category_id }}">
                                                                {{ $parent->category_name }} (Parent)
                                                            </option>
                                                            @foreach($parent->children as $child)
                                                                <option value="{{ $child->category_id }}" {{ old('categories_id', $product->categories_id ?? '') == $child->category_id ? 'selected' : '' }}>
                                                                    {{ $child->category_name }}
                                                                </option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Product Collection (shown for build product = No) -->
                                            <div class="col-md-6 mb-3 non-build-field">
                                                <label class="form-label">Product Collection</label>
                                                <select name="product_collection_id" id="collection_select" class="form-select">
                                                    <option value="">Select Collection</option>
                                                    @foreach($collections as $id => $name)
                                                        <option value="{{ $id }}" {{ old('product_collection_id', $product->product_collection_id ?? '') == $id ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Style Group (shown for build product = No) -->
                                            <div class="col-md-6 mb-3 non-build-field">
                                                <label class="form-label">Style Group</label>
                                                <select name="product_style_group_id" id="product_style_group_id" class="form-select">
                                                    <option value="">Select Style Group</option>
                                                    @foreach($styleGroups as $id => $name)
                                                        <option value="{{ $id }}" {{ old('product_style_group_id', $product->product_style_group_id ?? '') == $id ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Vendor *</label>
                                                <select name="vendor_id" class="form-select" required>
                                                    <option value="">Select Vendor</option>
                                                    @foreach($vendors as $vendor)
                                                        <option value="{{ $vendor->vendorid }}" {{ old('vendor_id') == $vendor->vendorid ? 'selected' : '' }}>
                                                            {{ $vendor->vendor_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message" id="error-vendor_id"></div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Quality</label>
                                                <select name="diamond_quality_id" class="form-select">
                                                    <option value="">Select Diamond Quality</option>
                                                    @foreach($diamond_qualities as $id => $name)
                                                        <option value="{{ $id }}" {{ old('diamond_quality_id') == $id ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message" id="error-diamond_quality_id"></div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Clarity</label>
                                                <select name="diamond_clarity_id" class="form-select">
                                                    <option value="">Select Clarity</option>
                                                    @foreach($diamond_clarities as $id => $name)
                                                        <option value="{{ $id }}" {{ old('diamond_clarity_id') == $id ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message" id="error-diamond_clarity_id"></div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Color</label>
                                                <select name="diamond_color_id" class="form-select">
                                                    <option value="">Select Color</option>
                                                    @foreach($diamond_colors as $id => $name)
                                                        <option value="{{ $id }}" {{ old('diamond_color_id') == $id ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message" id="error-diamond_color_id"></div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Cut</label>
                                                <select name="diamond_cut_id" class="form-select">
                                                    <option value="">Select Cut</option>
                                                    @foreach($diamond_cuts as $id => $name)
                                                        <option value="{{ $id }}" {{ old('diamond_cut_id') == $id ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message" id="error-diamond_cut_id"></div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Diamond Weight Group</label>
                                                <select name="diamond_weight_group_id" class="form-select">
                                                    <option value="">Select Group</option>
                                                    @foreach($weightGroups as $id => $name)
                                                        <option value="{{ $id }}" {{ old('diamond_weight_group_id') == $id ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message" id="error-diamond_weight_group_id"></div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Country of Origin</label>
                                                <select name="country_of_origin" class="form-select">
                                                    <option value="">Select Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->country_id }}" {{ old('country_of_origin') == $country->country_id ? 'selected' : '' }}>
                                                            {{ $country->country_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message" id="error-country_of_origin"></div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Shipping Zone</label>
                                                <select name="shop_zone_id" class="form-select">
                                                    <option value="">Select Zone</option>
                                                    @foreach($shopZones as $id => $name)
                                                        <option value="{{ $id }}" {{ old('shop_zone_id') == $id ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message" id="error-shop_zone_id"></div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Stone Type</label>
                                                <select name="stone_type_id" class="form-select">
                                                    <option value="">Select Stone Type</option>
                                                    @foreach($stone_types as $id => $name)
                                                        <option value="{{ $id }}" {{ old('stone_type_id') == $id ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message" id="error-stone_type_id"></div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Status</label>
                                                <div>
                                                    <select name="products_status" class="form-select" required>
                                                        <option value="1" selected>Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                    <div class="error-message" id="error-products_status"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- <div class="woocommerce-section">
                                        <div class="woocommerce-section-title">Product Images</div>
                                        <div class="row">
                                        <!-- Featured Image Section -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Product Image *</label>
                                                <input type="file" name="featured_image" class="d-none" id="featuredImageInput" accept="image/*">
                                                
                                                <div class="image-preview-container">
                                                    <div class="image-preview-item" id="featuredImagePreview" style="cursor:pointer;">
                                                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#f8f9fa;">
                                                            <i class="fas fa-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="error-message" id="error-featured_image"></div>
                                            </div>
                                            
                                            <!-- Gallery Images -->
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Gallery Images</label>
                                                <input type="file" name="gallery_images[]" multiple class="d-none" id="galleryImagesInput">
                                                <button type="button" class="btn btn-secondary" id="addGalleryImage">
                                                    <i class="fas fa-plus me-2"></i>Add Images
                                                </button>
                                                <div class="image-preview-container" id="galleryImagesPreview"></div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>

                                <!-- Variations Tab -->
                                <div class="tab-pane fade" id="variations">
                                    <div class="woocommerce-section">
                                        <div class="woocommerce-section-title">
                                            <i class="fas fa-layer-group me-2"></i>Product Variations
                                        </div>
                                            
                                        <div class="table-responsive">
                                            <table class="variations-table">
                                                <thead>
                                                    <tr>
                                                        <th>Metal Type *</th>
                                                        <th>Shape *</th>
                                                        <th>Carat Weight *</th>
                                                        <th>Price (₹) *</th>
                                                        <th>Regular Price (₹) *</th>
                                                        <th>Stock</th>
                                                        <th>Images</th>
                                                        <th>Video</th>                                                        
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="variationsTableBody">
                                                    
                                                    <tr>
                                                        <td>
                                                            <select name="variations[0][metal_color_id]" class="form-select" style="width: 155px;" required>
                                                                @foreach($metal_types_colors as $id => $name)
                                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="error-message" id="error-variations-0-metal_color_id"></div>
                                                        </td>
                                                        <td>
                                                            <select name="variations[0][shape_id]" class="form-select" style="width: 115px;" required>
                                                                @foreach($shapes as $shape)
                                                                    <option value="{{ $shape->id }}"
                                                                        {{ old('variations.0.shape_id') == $shape->id ? 'selected' : '' }}>
                                                                        {{ $shape->name }}
                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                            <div class="error-message" id="error-variations-0-shape_id"></div>
                                                        </td>
                                                        <td>
                                                            <input type="number" step="0.01" 
                                                                name="variations[0][weight]" 
                                                                class="form-control" 
                                                                placeholder="0.00"
                                                                value="{{ isset($variation) ? $variation->weight : old('variations.0.weight') }}"
                                                                required>
                                                            <div class="error-message" id="error-variations-0-weight"></div>
                                                        </td>
                                                        <td>
                                                            <input type="number" step="0.01" name="variations[0][price]" class="form-control" required placeholder="0.00">
                                                            <div class="error-message" id="error-variations-0-price"></div>
                                                        </td>
                                                        <td>
                                                            <input type="number" step="0.01" name="variations[0][regular_price]" 
                                                                class="form-control" required placeholder="0.00">
                                                                <div class="error-message" id="error-variations-0-regular_price"></div>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="variations[0][stock]" class="form-control" value="0" placeholder="0">
                                                            <div class="error-message" id="error-variations-0-stock"></div>
                                                        </td>
                                                        <td class="variation-image-cell">
                                                            <!-- Preview container for new images -->
                                                            <div class="d-flex flex-wrap gap-2 mb-2" id="variation-images-0"></div>
                                                            <button type="button" class="btn btn-sm btn-outline-secondary add-variation-image" data-index="0">
                                                                <i class="fas fa-plus me-1"></i> Add Images
                                                            </button>
                                                            <input type="file" name="variations[0][images][]" multiple class="d-none variation-image-input" data-index="0">
                                                            <div class="error-message" id="error-variations-0-images"></div>
                                                        </td>
                                                        <td>
                                                            <input type="file" name="variations[0][video]" 
                                                                   class="form-control variation-video-input" 
                                                                   accept="video/*">
                                                                   <span style="color:red; font-weight:bold; font-size:14px;">
                                                                    File size exceeds the maximum allowed limit of 50 MB.
                                                                </span>
                                                            <div class="video-preview mt-2" style="display: none;">
                                                                <video width="120" height="80" controls>
                                                                    <source src="" type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                                <button type="button" class="btn btn-sm btn-danger remove-video mt-1">Remove</button>
                                                                
                                                                
                                                            </div>
                                                        </td>
                                                        <td class="action-cell">
                                                            <button type="button" class="btn btn-sm btn-danger remove-variation-row">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody> 
                                            </table>
                                        </div>
                                            
                                        <div class="text-end mt-3">
                                            <button type="button" class="btn btn-primary" id="addVariationRow">
                                                <i class="fas fa-plus me-2"></i>Add Variation
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Pricing Tab -->
                                <div class="tab-pane fade" id="pricing">
                                    <div class="woocommerce-section">
                                        <div class="woocommerce-section-title">Pricing</div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Model</label>
                                                    <input type="text" name="products_model" class="form-control" value="{{ old('products_model') }}">
                                                    <div class="error-message" id="error-products_model"></div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Build Product Type</label>
                                                    <select name="build_product_type" id="build_product_type" class="form-select">
                                                        <option value="yes" {{ old('build_product_type') == 'yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="no" {{ old('build_product_type') == 'no' ? 'selected' : '' }}>No</option>
                                                    </select>
                                                    <div class="error-message" id="error-build_product_type"></div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Products Related Items</label>
                                                    <input type="text" name="products_related_items" class="form-control" value="{{ old('products_related_items') }}">
                                                    <div class="error-message" id="error-products_related_items"></div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Related Master SKU</label>
                                                    <input type="text" name="related_master_sku" class="form-control" value="{{ old('related_master_sku') }}">
                                                    <div class="error-message" id="error-related_master_sku"></div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Default Size</label>
                                                    <input type="text" name="default_size" class="form-control" value="{{ old('default_size') }}">
                                                    <div class="error-message" id="error-default_size"></div>
                                                </div>


                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Certificate Number</label>
                                                    <input type="text" name="certificate_number" class="form-control" value="{{ old('certificate_number') }}">
                                                    <div class="error-message" id="error-certificate_number"></div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Sort Order</label>
                                                    <input type="text" name="sort_order" class="form-control" value="{{ old('sort_order') }}">
                                                    <div class="error-message" id="error-sort_order"></div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Catalog No.</label>
                                                    <input type="text" name="catelog_no" class="form-control" value="{{ old('catelog_no') }}">
                                                    <div class="error-message" id="error-catelog_no"></div>
                                                </div>


                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Short Description</label>
                                                    <textarea name="products_short_description" class="form-control" rows="2">{{ old('products_short_description') }}</textarea>
                                                    <div class="error-message" id="error-products_short_description"></div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Full Description</label>
                                                    <textarea name="products_description" class="form-control" rows="4">{{ old('products_description') }}</textarea>
                                                    <div class="error-message" id="error-products_description"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="woocommerce-section">
                                            <div class="woocommerce-section-title">Inventory</div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Stock Quantity</label>
                                                    <input type="number" name="products_quantity" class="form-control" value="{{ old('products_quantity', 0) }}">
                                                    <div class="error-message" id="error-products_quantity"></div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Stock Status</label>
                                                    <select name="available" class="form-select">
                                                        <option value="yes" selected>In stock</option>
                                                        <option value="no">Out of stock</option>
                                                    </select>
                                                    <div class="error-message" id="error-available"></div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Weight (g) *</label>
                                                    <input type="number" step="0.01" name="products_weight" class="form-control" value="{{ old('products_weight') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <!-- Shipping Tab -->
                                    <div class="tab-pane fade" id="shipping">
                                        <div class="woocommerce-section">
                                            <div class="woocommerce-section-title">Shipping Details</div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Delivery Days</label>
                                                    <input type="text" name="delivery_days" class="form-control" value="{{ old('delivery_days') }}">
                                                    <div class="error-message" id="error-delivery_days"></div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Ready to Ship</label>
                                                    <select name="ready_to_ship" class="form-select">
                                                        <option value="">Select Option</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                    <div class="error-message" id="error-ready_to_ship"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <!-- Advanced Tab -->
                                    <div class="tab-pane fade" id="advanced">
                                        <div class="woocommerce-section">
                                            <div class="woocommerce-section-title">Advanced Settings</div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Product Status</label>
                                                    <select name="products_status" class="form-select">
                                                        <option value="1" selected>Published</option>
                                                        <option value="0">Draft</option>
                                                    </select>
                                                    <div class="error-message" id="error-products_status"></div>
                                                </div>
                            
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Is Featured?</label>
                                                    <select name="is_featured" class="form-select">
                                                        <option value="1">Yes</option>
                                                        <option value="0" selected>No</option>
                                                    </select>
                                                    <div class="error-message" id="error-is_featured"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="woocommerce-section">
                                            <div class="woocommerce-section-title">SEO Settings</div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">SEO Title</label>
                                                    <input type="text" name="products_meta_title" class="form-control" value="{{ old('products_meta_title') }}">
                                                    <div class="error-message" id="error-products_meta_title"></div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">SEO Keywords</label>
                                                    <input type="text" name="products_meta_keyword" class="form-control" value="{{ old('products_meta_keyword') }}">
                                                    <div class="error-message" id="error-products_meta_keyword"></div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Product Keywords</label>
                                                    <input type="text" name="product_keywords" class="form-control" value="{{ old('product_keywords') }}">
                                                    <div class="error-message" id="error-product_keywords"></div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Product Promotion</label>
                                                    <input type="text" name="product_promotion" class="form-control" value="{{ old('product_promotion') }}">
                                                    <div class="error-message" id="error-product_promotion"></div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">SEO Description</label>
                                                    <textarea name="products_meta_description" class="form-control" rows="3">{{ old('products_meta_description') }}</textarea>
                                                    <div class="error-message" id="error-products_meta_description"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <!-- Form submit button -->
                    <div class="submit-section text-end mt-4">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('product.index') }}'">
                            <i class="fas fa-times me-2"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        function generateSlug(str) {
            return str.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') 
            .trim() 
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');  
        }

        document.getElementById('products_name').addEventListener('input', function () {
            const name = this.value;
            const slug = generateSlug(name);
            document.getElementById('products_slug').value = slug;
        });
        $(document).ready(function () {
            let variationCount = 1;
            let isSubmitting = false;

            // Add Variation Row
            $('#addVariationRow').click(function (e) {
                e.preventDefault();
                const newRow = `
                    <tr>
                        <td>
                            <select name="variations[${variationCount}][metal_color_id]" class="form-select" style="width: 155px;" required>
                                @foreach($metal_types_colors as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            <div class="error-message" id="error-variations-${variationCount}-metal_color_id"></div>
                        </td>
                        <td>
                            <select name="variations[${variationCount}][shape_id]" class="form-select" style="width: 115px;" required>
                                @foreach($shapes as $shape)
                                    <option value="{{ $shape->id }}">{{ $shape->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" step="0.01" 
                                name="variations[${variationCount}][weight]" 
                                class="form-control" 
                                placeholder="0.00" required>
                            <div class="error-message" id="error-variations-${variationCount}-weight"></div>
                        </td>
                        <td>
                            <input type="number" step="0.01" name="variations[${variationCount}][price]" class="form-control" required placeholder="0.00">
                            <div class="error-message" id="error-variations-${variationCount}-price"></div>
                        </td>

                         <td>
                            <input type="number" step="0.01" 
                                name="variations[${variationCount}][regular_price]" 
                                class="form-control" required placeholder="0.00">
                        </td>

                        <td>
                            <input type="number" name="variations[${variationCount}][stock]" class="form-control" value="0" placeholder="0">
                            <div class="error-message" id="error-variations-${variationCount}-stock"></div>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-2 mb-2" id="variation-images-${variationCount}"></div>
                            <button type="button" class="btn btn-sm btn-outline-secondary add-variation-image" data-index="${variationCount}">
                                <i class="fas fa-plus me-1"></i> Add Images
                            </button>
                            <input type="file" name="variations[${variationCount}][images][]" multiple class="d-none variation-image-input" data-index="${variationCount}">
                            <div class="error-message" id="error-variations-${variationCount}-images"></div>
                        </td>
                        <td>
                            <input type="file" name="variations[${variationCount}][video]" 
                                class="form-control variation-video-input" 
                                accept="video/*">
                                <span style="color:red; font-weight:bold; font-size:14px;">
                                                                    File size exceeds the maximum allowed limit of 50 MB. Please upload a smaller file.
                                                                </span>
                            <div class="video-preview mt-2" style="display: none;">
                                <video width="120" height="80" controls>
                                    <source src="" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <button type="button" class="btn btn-sm btn-danger remove-video mt-1">Remove</button>
                            </div>
                        </td>
                        <td class="action-cell">
                            <button type="button" class="btn btn-sm btn-danger remove-variation-row">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#variationsTableBody').append(newRow);
                variationCount++;
            });

            // Remove Variation Row
            $(document).on('click', '.remove-variation-row', function () {
                if ($('#variationsTableBody tr').length > 1) {
                    $(this).closest('tr').remove();
                } else {
                    alert('At least one variation is required');
                }
            });

            // Add new image button click
            $(document).on('click', '.add-variation-image', function() {
                const index = $(this).data('index');
                $(`.variation-image-input[data-index="${index}"]`).click();
            });

            // Variation image input change
            $(document).on('change', '.variation-image-input', function() {
                const index = $(this).data('index');
                const preview = $(`#variation-images-${index}`);
                preview.empty();
                
                Array.from(this.files).forEach((file, i) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgDiv = $(`
                            <div class="position-relative d-inline-block" style="width: 60px; height: 60px; margin: 2px;">
                                <img src="${e.target.result}" class="img-thumbnail w-100 h-100" style="object-fit: cover;">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 p-0 remove-uploaded-image" 
                                        data-index="${index}" data-img-index="${i}" 
                                        style="width: 20px; height: 20px; font-size: 12px; line-height: 1;">
                                    &times;
                                </button>
                            </div>
                        `);
                        preview.append(imgDiv);
                    };
                    reader.readAsDataURL(file);
                });
            });

            // Remove uploaded image
            $(document).on('click', '.remove-uploaded-image', function(e) {
                e.preventDefault();
                const index = $(this).data('index');
                const imgIndex = $(this).data('img-index');
                const input = $(`.variation-image-input[data-index="${index}"]`)[0];
                
                // Remove from UI
                $(this).closest('.position-relative').remove();
                
                // Remove from files array
                const dt = new DataTransfer();
                const files = Array.from(input.files);
                files.splice(imgIndex, 1);
                
                files.forEach(file => dt.items.add(file));
                input.files = dt.files;
            });

            // Featured Image - Click to Upload
            $('#featuredImagePreview').click(function () {
                $('#featuredImageInput').click();
            });

            // Featured Image - Show Preview
            $('#featuredImageInput').change(function () {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#featuredImagePreview').html(`
                            <img src="${e.target.result}" alt="Featured Image" style="max-height: 150px;">
                            <div class="remove-image">×</div>
                        `);
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Remove Featured Image
            $(document).on('click', '#featuredImagePreview .remove-image', function (e) {
                e.preventDefault();
                $('#featuredImagePreview').html(`
                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#f8f9fa;">
                        <i class="fas fa-plus"></i>
                    </div>
                `);
                $('#featuredImageInput').val('');
            });

            // Gallery Images - Add
            $('#addGalleryImage').click(function () {
                $('#galleryImagesInput').click();
            });

            // Gallery Images - Preview
            $('#galleryImagesInput').change(function () {
                const preview = $('#galleryImagesPreview');
                Array.from(this.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.append(`
                            <div class="image-preview-item">
                                <img src="${e.target.result}" alt="Gallery Image">
                                <div class="remove-image">×</div>
                            </div>
                        `);
                    };
                    reader.readAsDataURL(file);
                });
            });

            // Remove Gallery Image
            $(document).on('click', '.image-preview-item .remove-image', function (e) {
                e.preventDefault();
                $(this).closest('.image-preview-item').remove();
            });

            // Submit Form with AJAX
            $('#productForm').on('submit', function (e) {
                e.preventDefault();
                
                if (isSubmitting) return;
                isSubmitting = true;
                
                // Disable submit button
                const submitBtn = $('button[type="submit"]');
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i> Saving...');
                
                // Clear previous errors
                $('.error-message').text('');
                $('.form-control, .form-select').removeClass('is-invalid');
                let isValid = true;
                let firstErrorElement = null;

                // Validate required fields
                $('#productForm :input[required]:visible').each(function() {
                    if (!$(this).val()) {
                        const fieldName = $(this).attr('name');
                        $(this).addClass('is-invalid');
                        $(`#error-${fieldName}`).text('This field is required');
                        isValid = false;
                        
                        // Track first error for scrolling
                        if (!firstErrorElement) {
                            firstErrorElement = this;
                        }
                    }
                });
                
                if (!isValid) {
                    isSubmitting = false;
                    submitBtn.prop('disabled', false).html('Save Product');
                    
                    // Scroll to first error
                    if (firstErrorElement) {
                        $('html, body').animate({
                            scrollTop: $(firstErrorElement).offset().top - 100
                        }, 500);
                    }
                    return;
                }
                
                // Create FormData and add all form inputs
                const formData = new FormData(this);
                
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        // Show success notification
                        toastr.success(response.message || 'Operation completed successfully!');
                        
                        // Redirect after a short delay
                        setTimeout(() => {
                            window.location.href = response.redirect || "{{ route('product.index') }}";
                        }, 1500);
                    },
                    error: function (xhr) {
                        isSubmitting = false;
                        submitBtn.prop('disabled', false).html('Save Product');
                        
                        if (xhr.status === 422) {
                            // Handle validation errors
                            const errors = xhr.responseJSON.errors;
                            
                            for (const field in errors) {
                                let fieldName = field;
                                if (field.includes('.')) {
                                    fieldName = field.replace(/\./g, '-');
                                }
                                
                                const errorElement = $(`#error-${fieldName}`);
                                const inputElement = $(`[name="${field}"]`);
                                
                                if (errorElement.length) {
                                    errorElement.text(errors[field][0]);
                                }
                                
                                if (inputElement.length) {
                                    inputElement.addClass('is-invalid');
                                }
                            }
                            
                            // Scroll to first error if any
                            const firstError = $('.is-invalid').first();
                            if (firstError.length) {
                                $('html, body').animate({
                                    scrollTop: firstError.offset().top - 100
                                }, 500);
                            }
                        } else {
                            // Show error notification
                            const errorMsg = xhr.responseJSON?.message || 
                                            xhr.responseJSON?.error || 
                                            'Something went wrong. Please try again.';
                            
                            toastr.error(errorMsg);
                            
                            // Log full error for debugging
                            console.error('AJAX Error:', xhr.responseText);
                        }
                    }
                });
            });
        });
         $(document).ready(function() {
        // Set the selected category if exists
        const selectedCategory = "{{ old('categories_id', isset($selectedCategoryValue) ? $selectedCategoryValue : '') }}";
        if (selectedCategory) {
            $('#categories_id').val(selectedCategory);
        }

        // Define initial values for edit mode
        const initialPscId = "{{ $initialPscId ?? '' }}";
        const initialCollectionId = "{{ $initialCollectionId ?? '' }}";
        const initialStyleGroupId = "{{ $initialStyleGroupId ?? '' }}";

        // When category changes
        $('#categories_id').change(function() {
            const selectedValue = $(this).val();
            if (!selectedValue) {
                // Clear the dependent dropdowns
                $('#psc_id').html('<option value="">Select Style Category</option>');
                $('#collection_select').html('<option value="">Select Collection</option>');
                $('#product_style_group_id').html('<option value="">Select Style Group</option>');
                return;
            }

            const isParent = selectedValue.startsWith('parent_');
            const categoryId = isParent ? selectedValue.replace('parent_', '') : selectedValue;

            $.ajax({
                url: '{{ route("get.category.psc.and.collections") }}',
                type: 'GET',
                data: { 
                    category_id: categoryId,
                    is_parent: isParent ? 1 : 0
                },
                success: function(response) {
                    // Populate style categories
                    let styleCatOptions = '<option value="">Select Style Category</option>';
                    response.styleCategories.forEach(function(style) {
                        styleCatOptions += `<option value="${style.psc_id}">${style.psc_name}</option>`;
                    });
                    $('#psc_id').html(styleCatOptions);

                    // Populate collections
                    let collectionOptions = '<option value="">Select Collection</option>';
                    response.collections.forEach(function(collection) {
                        collectionOptions += `<option value="${collection.id}">${collection.name}</option>`;
                    });
                    $('#collection_select').html(collectionOptions);

                    // If we are in edit mode and there are initial values, set them
                    if (initialPscId) {
                        $('#psc_id').val(initialPscId);
                    }
                    if (initialCollectionId) {
                        $('#collection_select').val(initialCollectionId);
                        // Trigger the change event to load style groups for this collection
                        $('#collection_select').trigger('change');
                    }
                },
                error: function() {
                    console.error('Failed to load style categories and collections.');
                }
            });
        });

        // When collection changes
        $('#collection_select').change(function() {
            const collectionId = $(this).val();
            if (!collectionId) {
                $('#product_style_group_id').html('<option value="">Select Style Group</option>');
                return;
            }

            $.ajax({
                url: '{{ route("get.style.groups.by.collection") }}',
                type: 'GET',
                data: { collection_id: collectionId },
                success: function(response) {
                    let options = '<option value="">Select Style Group</option>';
                    response.forEach(function(group) {
                        options += `<option value="${group.psg_id}">${group.psg_names}</option>`;
                    });
                    $('#product_style_group_id').html(options);

                    // If we are in edit mode and there is an initial style group, set it
                    if (initialStyleGroupId) {
                        $('#product_style_group_id').val(initialStyleGroupId);
                    }
                },
                error: function() {
                    console.error('Failed to load style groups.');
                }
            });
        });

        // If there is a selected category, trigger the change to load style categories and collections
        if (selectedCategory) {
            $('#categories_id').trigger('change');
        }
    });
    function toggleBuildFields() {
        const isBuild = $('select[name="is_build_product"]').val() === '1';

        if (isBuild) {
            $('.non-build-field').hide();
            $('.build-field').show();
        } else if ($('select[name="is_build_product"]').val() === '0') {
            $('.non-build-field').show();
            $('.build-field').show();
        } else {
            $('.non-build-field').hide();
            $('.build-field').hide();
        }
    }

    $(document).ready(function () {
        toggleBuildFields();
        $('select[name="is_build_product"]').change(toggleBuildFields);
    });
    

    // Video preview functionality
    $(document).on('change', '.variation-video-input', function() {
        const file = this.files[0];
        const preview = $(this).siblings('.video-preview');
        const removeBtn = $(this).siblings('.remove-video-btn');
        
        if (file) {
            // Check file size (max 50MB)
            if (file.size > 50 * 1024 * 1024) {
                alert('File size exceeds the maximum allowed limit of 50 MB. Please upload a smaller file.');
                $(this).val('');
                return;
            }
            
            const videoURL = URL.createObjectURL(file);
            preview.find('source').attr('src', videoURL);
            preview.find('video')[0].load();
            preview.show();
            removeBtn.show();
        }
    });

    // Remove video
    $(document).on('click', '.remove-video-btn', function() {
        const input = $(this).siblings('.variation-video-input');
        const preview = $(this).siblings('.video-preview');
        const hiddenRemoveInput = $(this).siblings('input[type="hidden"][name*="remove_video"]');
        
        input.val('');
        preview.hide();
        $(this).hide();
        
        // Set flag to remove existing video on server
        if (hiddenRemoveInput.length) {
            hiddenRemoveInput.val('1');
        }
    });

    // For existing videos in edit mode
    $(document).on('click', '.remove-existing-video', function() {
        const variationId = $(this).data('variation-id');
        $(this).closest('.existing-video').remove();
        $(`input[name="variations[${variationId}][remove_video]"]`).val('1');
    });
    </script>
@endsection