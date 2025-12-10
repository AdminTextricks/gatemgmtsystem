<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CityMatser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityMatserController extends Controller
{
    public function index()
    {
        $data = CityMatser::with('state:id,state_name')->get();
        
        return view('admin.citymaster.index', compact('data'));
    }
   
    public function city_action(Request $request)
    {
        $action = $request->route()->parameter('action');

        $getdata = [];
        $states =  DB::table('state_matsers')->get();
        if (isset($request->id) && !empty($request->id)) {
            $getdata = CityMatser::where('id', $request->id)->first();
        }
        return view('admin.citymaster.action', compact('getdata', 'action', 'states'));
    }

    public function city_post_action(Request $request)
    {
        $request->validate([
            'city_name' => 'required|unique:city_matsers,city_name,' . $request->edit_id,
            'state_id'  => 'required',
            'own_city'  => 'required',
        ], [
            'state_id' => 'The state field is required.',
        ]);

        if (isset($request->edit_id) && !empty($request->edit_id)) {

            $save = CityMatser::where('id', $request->edit_id)->first();
        } else {

            $save = new CityMatser();
        }
        $save->city_name    = $request->city_name;
        $save->state_id     = $request->state_id;
        $save->own_city     = $request->own_city;
        if ($request->has('status')) {
            $save->status = $request->status;
        }
        $save->save();
        return redirect()->route('citylist')->with('success', 'Submitted Successfully...');
    }

    public function delete($id)
    {
        $citymaster = CityMatser::findOrFail($id);
        $citymaster->delete();
        return response()->json(['success' => true, 'message' => 'City has been deleted successfully.']);
    }
}
