<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StateMatser;
use App\Models\CityMatser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StateMatserController extends Controller
{
    public function index()
    {
        $data = StateMatser::all();

        return view('admin.statemaster.index', compact('data'));
    }


    public function state_action(Request $request)
    {
        $action = $request->route()->parameter('action');

        $getdata = [];
        if (isset($request->id) && !empty($request->id)) {
            $getdata = StateMatser::where('id', $request->id)->first();
        }
        return view('admin.statemaster.action', compact('getdata', 'action'));
    }

    public function state_post_action(Request $request)
    {
        $request->validate([
            'state_name'=> 'required|unique:state_matsers,state_name,' . $request->edit_id,
            'own_state' => 'required',
        ]);

        if (isset($request->edit_id) && !empty($request->edit_id)) {

            $save = StateMatser::where('id', $request->edit_id)->first();
        } else {

            $save = new StateMatser();
        }
        $save->state_name    = $request->state_name;
        $save->own_state     = $request->own_state;
        if ($request->has('status')) {
            $save->status = $request->status;
        }
        $save->save();
        return redirect()->route('statelist')->with('success', 'Submitted Successfully...');
    }

    public function delete($id)
    {        
            $statemaster = StateMatser::findOrFail($id);
            $statemaster->delete();
        
            return response()->json(['success' => true, 'message' => 'State has been deleted successfully.']);
    }
}
