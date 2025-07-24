<?php
namespace App\Http\Controllers\Jewellery;

use App\Http\Controllers\Controller;
use App\Models\ProductCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $collections = ProductCollection::query()
                ->with([
                    'productCategory:category_id,category_name',
                    'parentCategory:category_id,category_name',
                    'addedBy:id,name',
                    'updatedBy:id,name'
                ]);

            return DataTables::eloquent($collections)
            ->addColumn('category_name', function ($row) {
                return $row->productCategory->category_name ?? '-';
            })
                ->addColumn('status_toggle', function($row) {
                    return '<div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input status-toggle" 
                            data-id="'.$row->id.'" '.($row->status == 1 ? 'checked' : '').'>
                    </div>';
                })
                ->addColumn('display_toggle', function($row) {
                    return '<div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input display-toggle" 
                            data-id="'.$row->id.'" '.($row->display_in_menu == 1 ? 'checked' : '').'>
                    </div>';
                })
                ->rawColumns(['status_toggle', 'display_toggle'])
                ->toJson();
        }

        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();

        return view('admin.Jewellery.ProductCollection.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'category_id' => 'nullable',
            'collection_image' => 'required|mimes:jpeg,png,jpg,gif,webp,svg|max:102400',
            'banner_image' => 'nullable|mimes:jpeg,png,jpg,gif,webp,svg|max:102400',
            'banner_video' => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/avi|max:512000', // 500MB
            'alias' => 'nullable|max:255',
            'sort_order' => 'nullable|integer',
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $isParent = strpos($request->category_id, 'parent_') === 0;
        $categoryId = $isParent ? substr($request->category_id, 7) : $request->category_id;

        $imagePath = $request->file('collection_image')->store('collections', 'public');
        $bannerPath = $request->hasFile('banner_image') 
            ? $request->file('banner_image')->store('collections/banners', 'public')
            : null;
        
        $bannerVideoPath = $request->hasFile('banner_video') 
            ? $request->file('banner_video')->store('collections/videos', 'public')
            : null;

        $collection = new ProductCollection();
        $collection->name = $request->name;
        $collection->heading = $request->heading;
        $collection->description = $request->description;
        $collection->product_category_id = $isParent ? null : $categoryId;
        $collection->parent_category_id = $isParent ? $categoryId : null;
        $collection->collection_image = $imagePath;
        $collection->banner_image = $bannerPath;
        $collection->banner_video = $bannerVideoPath;
        $collection->status = 1;
        $collection->sort_order = $request->sort_order ?? 0;
        $collection->alias = $request->alias;
        $collection->display_in_menu = $request->category_id ? 0 : 1;
        $collection->date_added = now();
        $collection->date_modified = now();
        $collection->added_by = auth()->id();
        $collection->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Collection created successfully!'
        ]);
    }

    public function edit($id)
    {
        $collection = ProductCollection::find($id);
        
        if (!$collection) {
            return response()->json([
                'status' => 'error',
                'message' => 'Collection not found'
            ], 404);
        }
        
        // Set category_id value
        $collection->category_id = $collection->parent_category_id 
            ? 'parent_' . $collection->parent_category_id 
            : $collection->product_category_id;
        
        return response()->json($collection);
    }

    public function update(Request $request, $id)
    {
        $collection = ProductCollection::find($id);
        
        if (!$collection) {
            return response()->json([
                'status' => 'error',
                'message' => 'Collection not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'category_id' => 'nullable',
            'collection_image' => 'required|mimes:jpeg,png,jpg,gif,webp,svg|max:102400',
            'banner_image' => 'nullable|mimes:jpeg,png,jpg,gif,webp,svg|max:102400',
            'banner_video' => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/avi|max:2097152',
            'alias' => 'nullable|max:255',
            'sort_order' => 'nullable|integer',
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $isParent = strpos($request->category_id, 'parent_') === 0;
        $categoryId = $isParent ? substr($request->category_id, 7) : $request->category_id;

        // Handle image removal
        if ($request->remove_image == '1') {
            Storage::disk('public')->delete($collection->collection_image);
            $collection->collection_image = null;
        }
        
        if ($request->remove_banner == '1') {
            Storage::disk('public')->delete($collection->banner_image);
            $collection->banner_image = null;
        }
        
        if ($request->remove_banner_video == '1') {
            Storage::disk('public')->delete($collection->banner_video);
            $collection->banner_video = null;
        }

        // Handle new files
        if ($request->hasFile('collection_image')) {
            if (!empty($collection->collection_image) && Storage::disk('public')->exists($collection->collection_image)) {
                Storage::disk('public')->delete($collection->collection_image);
            }

            $collection->collection_image = $request->file('collection_image')->store('collections', 'public');
        }

        if ($request->hasFile('banner_image')) {
            if (!empty($collection->banner_image) && Storage::disk('public')->exists($collection->banner_image)) {
                Storage::disk('public')->delete($collection->banner_image);
            }

            $collection->banner_image = $request->file('banner_image')->store('collections/banners', 'public');
        }

        
        if ($request->hasFile('banner_video')) {
            if (!empty($collection->banner_video) && Storage::disk('public')->exists($collection->banner_video)) {
                Storage::disk('public')->delete($collection->banner_video);
            }

            $collection->banner_video = $request->file('banner_video')->store('collections/videos', 'public');
        }


        // Update fields
        $collection->name = $request->name;
        $collection->heading = $request->heading;
        $collection->description = $request->description;
        $collection->product_category_id = $isParent ? null : $categoryId;
        $collection->parent_category_id = $isParent ? $categoryId : null;
        $collection->sort_order = $request->sort_order ?? 0;
        $collection->alias = $request->alias;
        $collection->display_in_menu = $request->category_id ? 0 : 1;
        $collection->date_modified = now();
        $collection->updated_by = auth()->id();
        $collection->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Collection updated successfully!'
        ]);
    }

    public function destroy($id)
    {
        $collection = ProductCollection::find($id);
        
        if (!$collection) {
            return response()->json([
                'status' => 'error',
                'message' => 'Collection not found'
            ], 404);
        }

        // Delete files
        Storage::disk('public')->delete([
            $collection->collection_image,
            $collection->banner_image,
            $collection->banner_video // नया फ़ील्ड
        ]);
        
        $collection->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Collection deleted successfully!'
        ]);
    }
    
    public function updateStatus(Request $request, $id)
    {
        $collection = ProductCollection::find($id);
        $collection->update(['status' => $request->status]);
        return response()->json(['message' => 'Status updated successfully.']);
    }
    
    public function updateDisplay(Request $request, $id)
    {
        $collection = ProductCollection::find($id);
        $collection->update(['display_in_menu' => $request->display]);
        return response()->json(['message' => 'Display setting updated successfully.']);
    }
}