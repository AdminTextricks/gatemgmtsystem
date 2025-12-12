<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VisitorDetail;
use Illuminate\Support\Facades\Auth;

class VisitorDetailController extends Controller
{
    public function index()
    {
        $data = VisitorDetail::all();
        $user_role=Auth::user()->role;
        if($user_role==='admin' || $user_role==='member'){
        return view('admin.guestdetails.index', compact('data'));    
        }
        else{
            return view('admin.visitordetails.index', compact('data'));
        }
        
    }


    // update user(VisitorDetail) status 
    // public function updatestatus(Request $request, $id = null)
    // {
    //     $VisitorDetail = VisitorDetail::find($id);
    //     $user = User::where('user_id', $VisitorDetail->id)->first();
    //     $status = $request->status;
    //     if (!empty($VisitorDetail)) {
    //         $VisitorDetail->status = $status;
    //         $user->status = $status;
    //         $VisitorDetail->save();
    //         $user->save();
    //         return response()->json(['success' => true, 'message' => 'Status updated']);
    //     }
    //     return response()->json(['success' => false, 'message' => 'User not found']);
    // }

    //VisitorDetail form 

    public function guest_action(Request $request)
    {
        $action = $request->route()->parameter('action');

        $getdata = [];
        $userdata = [];

        if (isset($request->id) && !empty($request->id)) {
            $getdata = VisitorDetail::where('id', $request->id)->first();
            // $userdata = User::where('user_id', $getdata->id)->first();
        }

        return view('admin.guestdetails.action', compact('getdata', 'action', 'userdata'));
    }

    //VisitorDetail form post request
    public function guest_post_action(Request $request)
    {
        $action = $request->route()->parameter('action');
        $rules = [
            'uid'   => 'required|unique:visitor_details,uid,' . $request->edit_id,
            'name' => 'required',
            'email'      => 'required|nullable',
            'mobile'       => 'required|numeric',
            'date'       => 'required|date',
            'duration'       => 'required|',
            'max_allow_days' => 'required|numeric',
            'status'       => 'required|numeric',

        ];

        $request->validate($rules);
        $unique_id=Str::uuid()->toString();
        // dd($unique_id);
        $data = [
            'uid'   => $request->uid,
            'name' => $request->name,
            'email'  => $request->email,
            'mobile' => $request->mobile,
            'device_id' => $request->device_id,
            'date' => $request->date,
            'duration' => $request->duration,
            'max_allow_days' => $request->max_allow_days,
            'status' => $request->status,
            'visitor_key' => $unique_id,
            'updated_by' => Auth::id(),
        ];

        if ($action != 'Edit') {
            $data['created_by'] = Auth::id();
        }

        // dd($data);

        VisitorDetail::updateOrCreate(
            ['id' => $request->edit_id],
            $data
        );

        return redirect()->route('guestlist')->with('success', 'Submitted Successfully...');
    }

    public function delete($id)
    {
        $VisitorDetail = VisitorDetail::findOrFail($id);
        $VisitorDetail->delete();
        return response()->json(['success' => true, 'message' => 'Visitor deleted successfully.']);
    }
}
