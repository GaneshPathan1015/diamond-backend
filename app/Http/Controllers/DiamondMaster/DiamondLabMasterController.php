<?php

namespace App\Http\Controllers\DiamondMaster;

use App\Http\Controllers\Controller;
use App\Models\DiamondLab;
use Illuminate\Http\Request;

class DiamondLabMasterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $labs = DiamondLab::all();
            return response()->json($labs);
        }
        return view('admin.DiamondMaster.Lab.index');
    }

    // Store new record
    public function store(Request $request)
    {
        $data = $request->validate([
            'dl_name' => 'nullable|string|max:250',
            'dl_display_in_front' => 'nullable|integer',
            'dl_sort_order' => 'nullable|integer',
            'image' => 'required|string|max:255', // image field required
            'cert_url' => 'nullable|string|max:255',

        ]);
        $data['date_added'] = now();
        DiamondLab::create($data);

        return redirect()->route('diamondlab.index')
            ->with('success', 'Record added successfully.');
    }

    public function edit($id)
    {
        $lab = DiamondLab::findOrFail($id);
        return view('admin.DiamondMaster.Lab.index', compact('lab'));
    }

    public function show(DiamondLab $id)
    {
        if (request()->ajax()) {
            return response()->json($id);
        }
        $lab = $id;
        return view('admin.DiamondMaster.Lab.index', compact('lab'));
    }

    // Update record
    public function update(Request $request, $id)
    {
        $lab = DiamondLab::findOrFail($id);

        if (
            ($request->has('dl_sort_order') || $request->has('dl_display_in_front')) &&
            !$request->has('dl_name') &&
            !$request->has('image') &&
            !$request->has('cert_url')
        ) {
            // Partial update: just sort/display
            $data = $request->validate([
                'dl_sort_order' => 'nullable|integer',
                'dl_display_in_front' => 'nullable|integer',
            ]);
        } else {
            // Full update
            $data = $request->validate([
                'dl_name' => 'nullable|string|max:250',
                'dl_display_in_front' => 'nullable|integer',
                'dl_sort_order' => 'nullable|integer',
                'image' => 'required|string|max:255',
                'cert_url' => 'nullable|string|max:255',
            ]);
        }

        $data['date_modify'] = now();
        $lab->update($data);

        return response()->json(['success' => true, 'message' => 'Record updated successfully.']);
    }

    // Delete record
    public function destroy($id)
    {
        $lab = DiamondLab::findOrFail($id);
        $lab->delete();
        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Record deleted successfully.']);
        }

        return redirect()->route('diamondlab.index')
            ->with('success', 'Record deleted successfully.');
    }
}
