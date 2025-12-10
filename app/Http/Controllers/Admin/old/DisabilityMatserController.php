<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\DisabilityMatser;
use Illuminate\Http\Request;

class DisabilityMatserController extends Controller
{
    public function index(Request $request)
    {
        $data = DisabilityMatser::all();        
        return view('admin.disability.index', compact('data'));
    }


    public function disability_action(Request $request)
    {
        $action = $request->route()->parameter('action');

        $getdata = [];

        if (isset($request->id) && !empty($request->id)) {
            $getdata = DisabilityMatser::where('id', $request->id)->first();
        }

        return view('admin.disability.action', compact('getdata', 'action'));
    }


    public function disability_post_action(Request $request)
    {
        $request->validate([
            'disability_id'     => 'required|unique:disability_matsers,disability_id,' . $request->edit_id,
            'disability_name'   => 'required',
            'description'       => 'required',
        ]);

        if (isset($request->edit_id) && !empty($request->edit_id)) {

            $save = DisabilityMatser::where('id', $request->edit_id)->first();
        } else {

            $save = new DisabilityMatser();
        }
        $save->disability_id = $request->disability_id;
        $save->disability_name = $request->disability_name;
        $save->description = $request->description;
        if ($request->has('status')) {
            $save->status = $request->status;
        }
        $save->save();
        return redirect()->route('disabilitylist')->with('success', 'Submitted Successfully...');
    }

    public function delete($id)
    {        
            $DisabilityMatser = DisabilityMatser::findOrFail($id);
            $DisabilityMatser->delete();
        
            return response()->json(['success' => true, 'message' => 'Disability deleted successfully.']);
    }
}
