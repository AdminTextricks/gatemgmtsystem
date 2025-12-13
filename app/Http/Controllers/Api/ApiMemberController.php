<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;

class ApiMemberController extends Controller
{
    public function index()
    {
        $data = Member::all();
        return view('admin.membermaster.index', compact('data'));
    }


    //Start Mobile Api Response
    public function checkDevice(Request $request)
    {
        $deviceId = $request->header('Device-Id');
        if (!$deviceId) {
            return response()->json([
                'status' => false,
                'message' => 'device_id missing in header'
            ], 400);
        } else {

            $exists = Member::where('device_id', $deviceId)->exists();

            if (empty($exists)) {
                return response()->json([
                    "status" => false,
                ]);
            }

            return response()->json([
                'status' => true,
            ], 200);
        }
    }

    public function checkPhone(Request $request)
    {
        $phoneNumber = $request->input('phone_number');
        if (!$phoneNumber) {
            return response()->json([
                'status' => false,
                'message' => 'Phone Number is missing'
            ], 400);
        } else {

            $memberdetails = Member::where('mobile', $phoneNumber)->first();
            // dd($memberdetails);          

            if (empty($memberdetails)) {
                return response()->json([
                    "status" => false,
                ], 203);
            } else {
                $data = [
                    'email' => $memberdetails->email ?? '',
                    'name' => $memberdetails->name ?? '',
                ];
                return response()->json([
                    'status' => true,
                    "member_data" => $data,
                ], 200);
            }
        }
    }

    //End Mobile Api Response


    // update user(member) status 
    // public function updatestatus(Request $request, $id = null)
    // {
    //     $member = Member::find($id);
    //     $user = User::where('user_id', $member->id)->first();
    //     $status = $request->status;
    //     if (!empty($member)) {
    //         $member->status = $status;
    //         $user->status = $status;
    //         $member->save();
    //         $user->save();
    //         return response()->json(['success' => true, 'message' => 'Status updated']);
    //     }
    //     return response()->json(['success' => false, 'message' => 'User not found']);
    // }

    //Member form 
    public function member_action(Request $request)
    {
        $action = $request->route()->parameter('action');

        $getdata = [];
        $userdata = [];

        if (isset($request->id) && !empty($request->id)) {
            $getdata = Member::where('id', $request->id)->first();
            // $userdata = User::where('user_id', $getdata->id)->first();
        }

        return view('admin.membermaster.action', compact('getdata', 'action', 'userdata'));
    }

    //Member form post request
    public function member_post_action(Request $request)
    {
        // $action = $request->route()->parameter('action');
        $rules = [
            'uid'   => 'required|unique:members,uid,' . $request->edit_id,
            'name' => 'required|max:255',
            'email'      => 'nullable|unique:members,email,'. $request->edit_id,
            'mobile'       => 'required|numeric|unique:members,mobile,'. $request->edit_id,
            'status'       => 'required|numeric',

        ];

        $request->validate($rules);

        $data = [
            'uid'   => $request->uid,
            'name' => $request->name,
            'email'  => $request->email,
            'mobile' => $request->mobile,
            // 'device_id' => $request->device_id,
            'status' => $request->status,
        ];
        

        Member::updateOrCreate(
            ['id' => $request->edit_id],
            $data
        );


        return redirect()->route('memberlist')->with('success', 'Submitted Successfully...');
    }

    public function delete($id)
    {
        $MemberDetail = Member::findOrFail($id);
        User::where('email', $MemberDetail->email)->first()->delete();
        $MemberDetail->delete();
        return response()->json(['success' => true, 'message' => 'Member deleted successfully.']);
    }
}
