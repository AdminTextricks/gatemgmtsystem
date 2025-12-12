<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GateAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class GateAdminController extends Controller
{
    public function index()
    {
        $data = GateAdmin::all();
        return view('admin.gateadmin.index', compact('data'));
    }

    // update user(GateAdmin) status 
    // public function updatestatus(Request $request, $id = null)
    // {
    //     $GateAdmin = GateAdmin::find($id);
    //     $user = User::where('user_id', $GateAdmin->id)->first();
    //     $status = $request->status;
    //     if (!empty($GateAdmin)) {
    //         $GateAdmin->status = $status;
    //         $user->status = $status;
    //         $GateAdmin->save();
    //         $user->save();
    //         return response()->json(['success' => true, 'message' => 'Status updated']);
    //     }
    //     return response()->json(['success' => false, 'message' => 'User not found']);
    // }

    //GateAdmin form 
    public function gateadmin_action(Request $request)
    {
        $action = $request->route()->parameter('action');

        $getdata = [];
        $userdata = [];

        if (isset($request->id) && !empty($request->id)) {
            $getdata = GateAdmin::where('id', $request->id)->first();
            // $userdata = User::where('user_id', $getdata->id)->first();
        }

        return view('admin.gateadmin.action', compact('getdata', 'action', 'userdata'));
    }

    //GateAdmin form post request
    public function gateadmin_post_action(Request $request)
    {
        // $action = $request->route()->parameter('action');
        $rules = [
            'gate_admin_id'   => 'required|unique:gate_admins,gate_admin_id,' . $request->edit_id,
            'name' => 'required|max:255',
            'email'      => 'nullable|unique:gate_admins,email,' . $request->edit_id,
            'mobile'       => 'required|numeric|unique:gate_admins,mobile,' . $request->edit_id,
            'device_id'       => 'required|unique:gate_admins,device_id,' . $request->edit_id,
            'gate_no'       => 'nullable|numeric',
            'shift'       => 'nullable',
            'status'       => 'required|numeric',

        ];

        $request->validate($rules);

        $data = [
            'gate_admin_id'   => $request->gate_admin_id,
            'name' => $request->name,
            'email'  => $request->email,
            'mobile' => $request->mobile,
            'device_id' => $request->device_id,
            'gate_no'   => $request->gate_no,
            'shift'     => $request->shift,
            'status' => $request->status,
        ];


        $gate_admin=GateAdmin::updateOrCreate(
            ['id' => $request->edit_id],
            $data
        );

        if(!empty($gate_admin)){
            $userdata=[
                "user_id"=>$gate_admin->gate_admin_id,
                "name"=>$gate_admin->name,
                "email"=>$gate_admin->email,
                "password"=>Hash::make('123456'),
                "role"=>"gateadmin",
                "status"=>$gate_admin->status,
            ];

           $user=User::updateOrCreate(['id'=>$request->edit_id], $userdata);
            
        }


        return redirect()->route('gateadminlist')->with('success', 'Submitted Successfully...');
    }

    public function delete($id)
    {
        $VisitorDetail = GateAdmin::findOrFail($id);
        $VisitorDetail->delete();
        return response()->json(['success' => true, 'message' => 'Gate Admin deleted successfully.']);
    }
}
