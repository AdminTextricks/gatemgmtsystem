<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassMaster;
use Illuminate\Http\Request;

class ClassMasterController extends Controller
{
    public function index()
    {
        $data = ClassMaster::all();

        return view('admin.classmaster.index', compact('data'));
    }

    public function classmaster_action(Request $request)
    {
        $action = $request->route()->parameter('action');

        $getdata = [];

        if (isset($request->id) && !empty($request->id)) {
            $getdata = ClassMaster::where('id', $request->id)->first();
        }

        return view('admin.classmaster.action', compact('getdata', 'action'));
    }

    public function classmaster_post_action(Request $request)
    {

        $request->validate([
            'class_id' => 'required|unique:class_masters,class_id,' . $request->edit_id,
            'class_name' => 'required',
            'class_order' => 'required|numeric',
        ]);
        
        if (isset($request->edit_id) && !empty($request->edit_id)) {

            $save = ClassMaster::where('id', $request->edit_id)->first();
        } else {

            $save = new ClassMaster();
        }
        $save->class_id = $request->class_id;
        $save->class_name = $request->class_name;
        $save->class_order = $request->class_order;
        if ($request->has('status')) {
            $save->status = $request->status;
        }
        $save->save();
        return redirect()->route('classlist')->with('success', 'Submitted Successfully...');
    }

    public function delete($id)
    {
        
            $classmaster = ClassMaster::findOrFail($id);
            $classmaster->delete();
        
            return response()->json(['success' => true, 'message' => 'Class deleted successfully.']);
        
        
    }
}
