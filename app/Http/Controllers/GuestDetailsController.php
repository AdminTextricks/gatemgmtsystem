<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VisitorDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GuestDetailsController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        if (Auth::user()->role === 'admin') {
            $data = VisitorDetail::with('request_status:id,name')->get();
        } else {
            $data = VisitorDetail::with('request_status:id,name')->where('created_for', $userId)->get();
        }
        $user_role = Auth::user()->role;

        return view('admin.guestdetails.index', compact('data'));
    }

    public function vistorslist()
    {
        $userId = Auth::id();
        if (Auth::user()->role === 'admin') {
            $data = VisitorDetail::with('request_status:id,name')->get();
        } else {
            $data = VisitorDetail::with('request_status:id,name')->where('created_for', $userId)->get();
        }
        $user_role = Auth::user()->role;

        return view('admin.guestdetails.index', compact('data'));
    }


    // update user(VisitorDetail) status 
    public function updatestatus(Request $request, $id = null)
    {
        $VisitorDetail = VisitorDetail::find($id);
        $status = $request->status;
        if (!empty($VisitorDetail)) {
            $VisitorDetail->status = $status;
            $VisitorDetail->save();
            return response()->json(['success' => true, 'message' => 'Status updated']);
        }
        return response()->json(['success' => false, 'message' => 'User not found']);
    }

    //VisitorDetail form 

    public function guest_action(Request $request)
    {
        $action = $request->route()->parameter('action');

        $getdata = [];
        $memberdata = [];
        $Users = User::where('status', 1)->whereNot('role', 'admin')->select('id', 'name')->get();

        if (isset($request->id) && !empty($request->id)) {
            $getdata = VisitorDetail::where('id', $request->id)->first();
            // $userdata = User::where('user_id', $getdata->id)->first();
        }

        return view('admin.guestdetails.action', compact('getdata', 'action', 'Users'));
    }

    //VisitorDetail form post request
    public function guest_post_action(Request $request)
    {
        $action = $request->route()->parameter('action');
        $rules = [
            'uid'           => 'required|unique:visitor_details,uid,' . $request->edit_id,
            'name'          => 'required|string|max:255',
            'email'         => 'required|email',
            'block_no'      => 'required|string',
            'flat_no'       => 'required|string',
            'created_for'   => 'required|string',
            'mobile'        => 'required|digits:10',
            'date'          => 'required|date',
            'max_allow_days' => 'required|numeric|min:1|max:7',
        ];

        if (Auth::user()->role === 'member') {
            $rules['created_for'] = 'nullable';
            $rules['status'] = 'nullable';
        }

        $request->validate($rules);
        $unique_id = Str::uuid()->toString();
        $data = [
            'uid'   => $request->uid,
            'name' => $request->name,
            'email'  => $request->email,
            'mobile' => $request->mobile,
            'device_id' => $request->device_id,
            'date' => $request->date,
            'block_no'      => $request->block_no,
            'flat_no'      => $request->flat_no,
            // 'duration' => $request->duration,
            'max_allow_days' => $request->max_allow_days,

            'visitor_key' => $unique_id,
            'updated_by' => Auth::id(),
        ];

        if ($action != 'Edit') {
            $data['created_by'] = Auth::id();
        }

        if (Auth::user()->role === 'member') {
            $data['created_for'] = Auth::id();
            $data['status'] = 2;
        } else {
            $data['created_for'] = $request->created_for;
            $data['status'] = 1;
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
