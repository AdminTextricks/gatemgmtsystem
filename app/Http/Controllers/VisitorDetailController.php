<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\VisitorDetail;
use Illuminate\Support\Facades\Auth;

class VisitorDetailController extends Controller
{
    public function index()
    {
        $data = VisitorDetail::all();
        return view('admin.visitordetails.index', compact('data'));
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

    public function visitor_action(Request $request)
    {
        $action = $request->route()->parameter('action');

        $getdata = [];
        $userdata = [];

        if (isset($request->id) && !empty($request->id)) {
            $getdata = VisitorDetail::where('id', $request->id)->first();
            // $userdata = User::where('user_id', $getdata->id)->first();
        }

        return view('admin.visitordetails.action', compact('getdata', 'action', 'userdata'));
    }

    //VisitorDetail form post request
    public function visitor_post_action(Request $request)
    {
        $action = $request->route()->parameter('action');
        $rules = [
            'uid'   => 'required|unique:visitor_details,uid,' . $request->edit_id,
            'name' => 'required',
            'email'      => 'nullable',
            'mobile'       => 'required|numeric',
            'date'       => 'required|date',
            'duration'       => 'required|',
            'max_allow_days' => 'required|numeric',
            'status'       => 'required|numeric',
            'created_by'       => 'required|numeric',
            'updated_by'       => 'required|numeric',

        ];

        $request->validate($rules);

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
            'updated_by' => Auth::id(),
        ];

        if ($action != 'Edit') {
            $data['created_by'] = Auth::id();
        }


        VisitorDetail::updateOrCreate(
            ['id' => $request->edit_id],
            $data
        );

        return redirect()->route('visitorlist')->with('success', 'Submitted Successfully...');
    }

    public function delete($id)
    {
        $VisitorDetail = VisitorDetail::findOrFail($id);
        $VisitorDetail->delete();
        return response()->json(['success' => true, 'message' => 'Visitor deleted successfully.']);
    }
}
