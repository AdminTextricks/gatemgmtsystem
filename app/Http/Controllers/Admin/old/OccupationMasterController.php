<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OccupationMaster;
use Illuminate\Http\Request;

class OccupationMasterController extends Controller
{
    public function index()
    {
        $data = OccupationMaster::all();
        return view('admin.occupationmaster.index', compact('data'));
    }

    public function occupation_action(Request $request)
    {
        $action = $request->route()->parameter('action');
        $getdata = [];
        if (isset($request->id) && !empty($request->id)) {
            $getdata = OccupationMaster::where('id', $request->id)->first();
        }
        return view('admin.occupationmaster.action', compact('getdata', 'action'));
    }


    public function occupation_post_action(Request $request)
    {
        $request->validate([
            'occupation_name' => 'required|unique:occupation_masters,occupation_name,' . $request->edit_id,
            'description' => 'nullable',
        ]);
        if (isset($request->edit_id) && !empty($request->edit_id)) {
            $save = OccupationMaster::where('id', $request->edit_id)->first();
        } else {
            $save = new OccupationMaster();
        }
        $save->occupation_name = $request->occupation_name;
        $save->description = $request->description;
        if ($request->has('status')) {
            $save->status = $request->status;
        }
        $save->save();
        return redirect()->route('occupationlist')->with('success', 'Submitted Successfully...');
    }
    public function delete($id)
    {
        $teachermaster = OccupationMaster::findOrFail($id);
        $teachermaster->delete();

        return response()->json(['success' => true, 'message' => 'Occupattion deleted successfully.']);
    }
}
