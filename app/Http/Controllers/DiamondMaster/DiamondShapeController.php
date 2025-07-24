<?php

namespace App\Http\Controllers\DiamondMaster;

use App\Http\Controllers\Controller;
use App\Models\DiamondShape;
use Illuminate\Http\Request;

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
        $data = $request->validate([
            'name' => 'nullable|string',
            'ALIAS' => 'nullable|string',
            'shortname' => 'nullable|string|max:15',
            'rap_shape' => 'nullable|string',
            'image' => 'nullable|string',
            'image2' => 'nullable|string',
            'image3' => 'nullable|string',
            'image4' => 'nullable|string',
            'svg_image' => 'nullable|string',
            'remark' => 'nullable|string',
            'display_in_front' => 'nullable|integer',
            'display_in_stud' => 'nullable|integer',
            'sort_order' => 'nullable|integer',
        ]);
        $data['date_added'] = now();
        DiamondShape::create($data);

        return redirect()->route('shapes.index')
            ->with('success', 'Record added successfully.');
    }

    public function update(Request $request, $id)
    {
        $shape = DiamondShape::findOrFail($id);

        $data = $request->validate([
            'name' => 'nullable|string',
            'ALIAS' => 'nullable|string',
            'shortname' => 'nullable|string|max:15',
            'rap_shape' => 'nullable|string',
            'image' => 'nullable|string',
            'image2' => 'nullable|string',
            'image3' => 'nullable|string',
            'image4' => 'nullable|string',
            'svg_image' => 'nullable|string',
            'remark' => 'nullable|string',
            'display_in_front' => 'nullable|integer',
            'display_in_stud' => 'nullable|integer',
            'sort_order' => 'nullable|integer',
            'date_added' => 'nullable|date',
            'date_modify' => 'nullable|date',
        ]);
        $data['date_modify'] = now();
        $shape->update($data);

        return redirect()->route('shapes.index')
            ->with('success', 'Record updated successfully.');
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
