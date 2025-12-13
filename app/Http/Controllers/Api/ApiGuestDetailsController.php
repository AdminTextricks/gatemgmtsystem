<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VisitorDetail;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;

class ApiGuestDetailsController extends Controller
{

    public function vistorslist(Request $request)
    {
        $userId = Auth::id();
        // $deviceId = $request->header('Device-Id');

        $data = [];

        try {

            if (Auth::user()->role === 'admin') {
                $data = VisitorDetail::with('request_status:id,name')->get();
            } else {
                $data = VisitorDetail::with('request_status:id,name')->where('created_for', $userId)->get();
            }

            if ($data->isEmpty()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'No users found',
                    'data'    => []
                ], 404);
            }

            // Success response
            return response()->json([
                'status'  => true,
                'message' => 'User list fetched successfully',
                'data'    => $data
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

        // update user(VisitorDetail) status 

    public function updatestatus(Request $request, $id = null)
    {
        // dd($id);
        // dd($request->status);
        try {

            $VisitorDetail = VisitorDetail::find($id);
            $status = $request->status;
            if (!empty($VisitorDetail)) {
                $VisitorDetail->status = $status;
                $VisitorDetail->save();
                return response()->json(['success' => true, 'message' => 'Status updated'],200);
            }
            return response()->json(['success' => false, 'message' => 'User not found'], 203);
            // Success response
           
        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage()
            ], 500);
        }
    }



    //VisitorDetail form 

    public function guest_action(Request $request)
    {
        $action = $request->route()->parameter('action');

        $getdata = [];
        $memberdata = [];
        $Users = User::where('status', 1)->whereNot('role', 'admin')->get();

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
