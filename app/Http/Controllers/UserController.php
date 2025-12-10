<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FamilyMembers;
use App\Models\StudentAdmission;
use App\Http\Requests\UserRequest;
use App\Models\LoginActivity;
use Illuminate\Support\Facades\Hash;

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
        $students = StudentAdmission::select('id', 'student_name', 'enroll_number')->get();
        $getdata = [];
        $student_ids = [];
        $role = ['admin', 'teacher', 'parent'];
        if (isset($request->id) && !empty($request->id)) {
            $getdata = User::where('id', $request->id)->first();
            $student_ids = explode(',', $getdata->student_id ?? '');
        }
        return view('users.action', compact('getdata', 'action', 'students', 'student_ids', 'role'));
    }

    //Teacher form post request
    public function user_post_action(Request $request)
    {
        // dd( $request->student_id);
        // if ($request->role === 'parent') {
        //     $rules = [
        //         'user_id'   => 'required|unique:users,user_id,' . $request->edit_id,
        //         'role'       => 'required|string',
        //         'password' => 'required|string|min:6|confirmed',
        //     ];
        // } else {
        //     $rules = [
        //         'user_id'   => 'required|unique:users,user_id,' . $request->edit_id,
        //         'name' => 'required',
        //         'role'       => 'required|string',
        //         'email'   => 'required|unique:users,email,' . $request->edit_id,
        //         'password' => 'required|string|min:6|confirmed',
        //     ];
        // }

        $action = $request->route()->parameter('action');
        $rules = [
            'user_id'   => 'required|unique:users,user_id,' . $request->edit_id,
            'name' => 'required',
            'role'       => 'required|string',
            'email'   => 'required|unique:users,email,' . $request->edit_id,
            'password' => 'required|string|min:6|confirmed',
        ];

        if ($action == 'Edit') {
            $rules['password'] = ['nullable'];
        }
        $request->validate($rules);
        // if (isset($request->edit_id) && !empty($request->edit_id)) {
        //     $user = User::where('id', $request->edit_id)->first();
        // }else{
        //     $user=new User;
        // }

        $data = [

            'user_id' => $request->user_id,
            'email' => $request->email,
            'email_verified_at' => now(),
            'role' => $request->role,
            'status' => $request->status,
            'name' => $request->name,

        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
        if (!empty($request->student_id)) {
            $studentIds = $request->student_id;
            $student_ids = implode(',', $studentIds ?? []);
            $data['student_id'] = $student_ids ?? '';
        }
        // else {
        //     $data['password'] = $user->password;
        // }

        // if ($request->role === 'parent') {
        //     $studentIds = $request->student_id;
        //     $familymember = FamilyMembers::whereIn('student_id', $studentIds ?? [])->first();

        //     if (empty($familymember)) {
        //         return redirect()->back()->with('error', 'First Create Student Family Member For All Selected Student...');
        //     }
        //     $data['name'] = $familymember->member_name ?? 'NA';
        //     $data['email'] = $request->user_id . '@asha.com';
        //     $student_ids = implode(',', $studentIds ?? []);
        //     $data['student_id'] = $student_ids ?? '';
        // } else {
        //     $data['email'] = $request->email ?? 'NA';
        //     $data['name'] = $request->name ?? 'NA';
        // }

        if (isset($request->edit_id) && !empty($request->edit_id)) {
            User::where('id', $request->edit_id)->update($data);
        } else {
            User::Create($data);
        }

        return redirect()->route('userlist')->with('success', 'Submitted Successfully...');
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
