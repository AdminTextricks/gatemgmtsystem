<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LeaveModule;
use Illuminate\Http\Request;
use App\Models\StudentAdmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class LeaveModuleController extends Controller
{
    public function index(User $model)
    {
        $user = Auth::user();

        if (!empty($user) && $user->role === 'parent') {
            $studentIds = explode(',', $user->student_id);
            $data =  LeaveModule::with('student:id,student_name')->whereIn('student_id', $studentIds)->get();
        } else {
            $data =  LeaveModule::select()->with('student:id,student_name')->get();
        }

        return view('leave.index', compact('data'));
    }

    public function update_leave_status(Request $request, $id = null)
    {
        $request->validate([
            'status' => 'required|in:pending,rejected,approved,cancelled',
        ]);
        // $user = LeaveModule::find($request->id);
        $status = $request->status;
        if (isset($status) && !empty($status)) {
            $child = LeaveModule::findOrFail($request->id);
            if (!empty($child)) {
                $child->status = $status;

                if ($status === 'rejected' && !empty($request->remarks)) {
                    $child->remarks = $request->remarks;
                    $child->approved_by =null;
                    $child->approved_at =null;
                }
                if ($status === 'approved') {
                    $child->approved_by = auth()->id();
                    $child->approved_at = now();
                }

                $child->save();
                return redirect()->back()->with('success', 'Status updated successfully!');
            }
        }
        return redirect()->back()->with('error', 'Unable to save the record. Please try again.');
    }


    public function leave_action(Request $request)
    {
        $user = auth()->user();
        $student_ids = explode(',', $user->student_id);
        $action = $request->route()->parameter('action');
        $students = StudentAdmission::select('id', 'student_name', 'enroll_number')->whereIn('id', $student_ids)->get();
        $getdata = [];
        $status = ['pending', 'approved', 'rejected', 'cancelled'];
        if (isset($request->id) && !empty($request->id)) {
            $getdata = LeaveModule::where('id', $request->id)->first();
            //$student_ids = explode(',', $getdata->student_id ?? '');
        }
        return view('leave.action', compact('getdata', 'students', 'action', 'student_ids', 'status'));
    }



    public function leave_post_action(Request $request)
    {
        // dd( $request->student_id);
        $action = $request->route()->parameter('action');
        $rules = [
            'student_id'    => 'required|exists:student_admissions,id',
            'start_date'    => 'required',
            'end_date'      => 'required|after_or_equal:start_date',
            'total_days'    => 'required',
            'reason'        => 'required|string',
        ];


        $request->validate($rules);
        if (isset($request->edit_id) && !empty($request->edit_id)) {
            $user = User::where('id', $request->edit_id)->first();
        }



        if (isset($request->edit_id) && !empty($request->edit_id)) {
            $save = LeaveModule::where('id', $request->edit_id)->first();
        } else {
            $save = new LeaveModule();
        }
        $createnewFileName = $img_res = '';
        // Check if the image file is present
        if ($request->hasFile('attachment')) {
            $image = $request->attachment;
            $extension = $image->getClientOriginalExtension();
            $image_name = $image->getClientOriginalName();
            $getfilenamewitoutext = pathinfo($image_name, PATHINFO_FILENAME); // get the file name without extension
            $createnewFileName = time() . '_' . str_replace(' ', '_', $getfilenamewitoutext) . '.' . $extension; // create new random file name
            $img_res = $request->attachment->move(public_path('student_documents'), $createnewFileName);
        }

        if (!empty($request->edit_id) && !empty($request->attachment)) {
            $oldReceipt = public_path('student_documents/' . $save->attachment);
            if (File::exists($oldReceipt)) {
                unlink($oldReceipt);
            }
        }
        if (!empty($request->attachment) && !$img_res) {
            return back()->withErrors(['image' => 'Error occurred in image uploading.']);
        }
        $save->student_id       = $request->student_id;
        $save->start_date      = $request->start_date;
        $save->end_date      = $request->end_date;
        $save->total_days = $request->total_days;
        $save->reason  = trim($request->reason);
        $save->status = 'pending';
        if (!empty($createnewFileName)) {
            $save->attachment = $createnewFileName;
        }

        $save->save();
        return redirect()->route('leavelist')->with('success', 'Submitted Successfully...');
    }

    public function delete($id)
    {
        $leaveRecord = LeaveModule::findOrFail($id);

        $leaveRecord->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
    }
}
