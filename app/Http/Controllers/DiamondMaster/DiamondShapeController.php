<?php

namespace App\Http\Controllers\DiamondMaster;

use App\Http\Controllers\Controller;
use App\Models\DiamondShape;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DiamondShapeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) { 
            $shapes = DiamondShape::all();
            return response()->json($shapes);
        }
        return view('admin.DiamondMaster.Shape.index');
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request);
        $data = $this->handleImageUploads($request, $data);
        $data['date_added'] = now();
        
        DiamondShape::create($data);

        return response()->json(['success' => true, 'message' => 'Record added successfully.']);
    }

    public function update(Request $request, $id)
    {
        $shape = DiamondShape::findOrFail($id);
        $data = $this->validateRequest($request);
        $data = $this->handleImageUploads($request, $data, $shape);
        $data['date_modify'] = now();
        
        $shape->update($data);

        return response()->json(['success' => true, 'message' => 'Record updated successfully.']);
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'name' => 'nullable|string',
            'ALIAS' => 'nullable|string',
            'shortname' => 'nullable|string|max:15',
            'rap_shape' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'svg_image' => 'nullable|string',
            'remark' => 'nullable|integer',
            'display_in_front' => 'nullable|integer',
            'display_in_stud' => 'nullable|integer',
            'sort_order' => 'nullable|integer',
        ]);
    }

    private function handleImageUploads(Request $request, array $data, $existingRecord = null)
    {
        $imageFields = ['image', 'image2', 'image3', 'image4'];
        
        foreach ($imageFields as $field) {
            // Handle new uploads
            if ($request->hasFile($field)) {
                // Delete old image if exists
                if ($existingRecord && $existingRecord->$field) {
                    Storage::delete('public/shapes/'.$existingRecord->$field);
                }
                
                // Store new image
                $path = $request->file($field)->store('public/shapes');
                $data[$field] = basename($path);
            }
            // Handle existing image removal
            elseif ($request->input('existing_'.$field) === '') {
                // Delete existing image
                if ($existingRecord && $existingRecord->$field) {
                    Storage::delete('public/shapes/'.$existingRecord->$field);
                }
                $data[$field] = null;
            }
            // Keep existing image
            elseif ($existingRecord) {
                $data[$field] = $existingRecord->$field;
            }
        }
        
        return $data;
    }

    public function destroy($id)
    {
        $shape = DiamondShape::findOrFail($id);
        $shape->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Record deleted successfully.']);
        }
        return redirect()->route('shapes.index')
            ->with('success', 'Record deleted successfully.');
    }

    public function show(DiamondShape $id)
    {
        if (request()->ajax()) {
            return response()->json($id);
        }
        return view('admin.DiamondMaster.Shape.index', compact('id'));
    }
}
