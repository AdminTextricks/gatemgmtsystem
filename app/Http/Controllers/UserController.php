<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Member;
use App\Models\OtpCode;
use Illuminate\Http\Request;
use App\Models\FamilyMembers;
use App\Models\LoginActivity;
use App\Models\StudentAdmission;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $data = User::select('id', 'name', 'role', 'email', 'user_id', 'password', 'status')->where('role', 'parent')->get();
        return view('users.index', compact('data'));
    }

    public function login_activity(Request $request, User $model)
    {

        $query = LoginActivity::with('users:id,name,user_id,role')->orderBy('logged_in_at', 'desc')->whereHas('users', function ($q) {
            $q->where('role', 'teacher');
        });

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $from = Carbon::parse($request->from_date)->startOfDay();
            $to   = Carbon::parse($request->to_date)->endOfDay();
            $query->whereBetween('logged_in_at', [$from, $to]);
        }
        $data = $query->get();

        return view('users.login_activity', compact('data'));
    }

    public function updatestatus(Request $request, $id = null)
    {
        $user = User::find($id);
        $status = $request->status;
        if (!empty($user)) {
            $user->status = $status;
            $user->save();
            return response()->json(['success' => true, 'message' => 'Status updated']);
        }
        return response()->json(['success' => false, 'message' => 'User not found']);
    }

    //User form 
    public function user_action(Request $request)
    {
        $action = $request->route()->parameter('action');
        $member = Member::select('id', 'student_name', 'enroll_number')->get();
        $getdata = [];
        $student_ids = [];
        $role = ['admin', 'teacher', 'parent'];
        if (isset($request->id) && !empty($request->id)) {
            $getdata = User::where('id', $request->id)->first();
            $student_ids = explode(',', $getdata->student_id ?? '');
        }
        return view('users.action', compact('getdata', 'action', 'students', 'student_ids', 'role'));
    }

    //Member form post request
    public function member_post_action(Request $request)
    {
        // $action = $request->route()->parameter('action');
        $userId = 'user';
        // if ($action == 'Edit') {
        //     $rules['password'] = 'nullable';
        // }

        // if (!empty($request->mobile) && !empty($request->device_id)) {
        //     $rules['role'] = 'nullable';
        //     $rules['user_id'] = 'nullable';
        // }
        // dd($rules);

        $validator = Validator::make($request->all(), [
            // 'user_id'   => 'required|unique:users,user_id,' . $request->edit_id,
            // 'name' => 'required',
            // 'role'       => 'required|string',
            'email'   => 'required|unique:users,email,' . $request->edit_id,
            // 'password' => 'required|string|min:6|confirmed',
            'mobile' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        if (!empty($request->mobile) && !empty($request->header('Device-Id'))) {
            $member = Member::where('mobile', $request->mobile)->first();
            $role = 'member';
            $firstName = explode(' ', trim($member->name))[0];
            $userId = $firstName . substr($member->mobile, 0, 4);
        } 
        // else {
        //     return response()->json([
        //         "status" => false,
        //         "message" => "Fill the required details",
        //     ], 422);
        // }


        //Send OTP on user email id

        $otp = rand(100000, 999999);

        if(!empty($member->email)){
            $otpData=OtpCode::create([
            'user_id'   => $userId,
            'otp'       => $otp,
            'email'       => $member->email,
            'status'       => 'pending',
            'expires_at' => Carbon::now()->addMinutes(5),
        ]);
        }

        // Send email
        if (!empty($otpData)) {
            Mail::raw("Your OTP is: $otp", function ($message) use ($member) {
                $message->to($member->email)
                    ->subject('Email Verification OTP');
            });
        }


        return response()->json([
            'status'  => true,
            'message' => 'Your OTP sent to email.',
        ]);

     
        // return redirect()->route('login')->with('success', 'Submitted Successfully...');
    }


    public function delete($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'admin') {
            return response()->json(['error' => true, 'message' => "Can't delete that account..."]);
        } else {
            $user->delete();
        }

        return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
    }
}
