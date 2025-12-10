<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FeeDetails;
use Illuminate\Http\Request;
use App\Models\TeacherMaster;
use App\Models\DisabilityMatser;
use App\Models\StudentAdmission;
use Illuminate\Support\Facades\File;

class FeeDetailsController extends Controller
{


    public function pendingfee()
    {

        $user = auth()->user();
        $studentIds = explode(',', $user->student_id);
        $disabilitymaster = DisabilityMatser::select('id', 'disability_name')->where('status', 1)->get();

        if ($user->role === 'admin') {
            $query = FeeDetails::with('student');
        } 
        elseif ($user->role === 'teacher') {
            $teacher = TeacherMaster::select('class_id')->where('teacher_id', $user->user_id)->first();
            $query = FeeDetails::with('student')
                ->whereHas('student', function ($q) use ($teacher) {
                    $q->where('cur_class_id', $teacher->class_id);
                });

        } elseif ($user->role === 'parent') {
            $user_child_ids = User::select('id', 'student_id')->where('user_id', $user->user_id)->value('student_id');
            $id_array = explode(',', $user_child_ids ?? '');
            $query = FeeDetails::with('student')->whereIn('student_admissions_id', $studentIds);
        }

        $data = $query->get();


        return view('admin.feedetails.pendingfee', compact('data', 'disabilitymaster'));
    }


    public function fee_action(Request $request, $action, $id = null)
    {
        $getdata = null;
        $user = auth()->user();
        $student_ids = explode(',', $user->student_id);
        $data = StudentAdmission::select('id', 'student_name', 'enroll_number', 'cur_class_id')->whereIn('id', $student_ids)->get();
        if (!empty($id) && $action === 'Edit') {
            $getdata = FeeDetails::where('id', $id)->first();
        }
        return view('admin.feedetails.action', compact('action', 'data', 'getdata'));
    }


    public function fee_post_action(Request $request)
    {
        $request->validate([
            'student_admissions_id'    => 'required|exists:student_admissions,id',
            'transition_date'           => ['required', 'date', 'before_or_equal:today'],
            'duration'                  => 'required',
            'fee_periods'               => 'required',
            'transition_amount'         => 'required',
            'transaction_id'            => 'nullable|unique:fee_details,transaction_id,' . $request->edit_id,
            'receipt_image'             => (empty($request->edit_id) ? 'required' : 'nullable') . '|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'status'            => 'nullable',
            'reject_reason'     => 'nullable',

        ]);

        if (isset($request->edit_id) && !empty($request->edit_id)) {
            $save = FeeDetails::where('id', $request->edit_id)->first();
        } else {
            $save = new FeeDetails();
        }

        $createnewFileName = $img_res = '';
        // Check if the image file is present
        if ($request->hasFile('receipt_image')) {
            $image = $request->receipt_image;
            $extension = $image->getClientOriginalExtension();
            $image_name = $image->getClientOriginalName();
            $getfilenamewitoutext = pathinfo($image_name, PATHINFO_FILENAME); // get the file name without extension
            $createnewFileName = time() . '_' . str_replace(' ', '_', $getfilenamewitoutext) . '.' . $extension; // create new random file name

            if (!empty($request->edit_id) && !empty($request->receipt_image)) {
                $oldReceipt = public_path('student_documents/' . $save->receipt_image);
                if (File::exists($oldReceipt)) {
                    unlink($oldReceipt);
                }
            }

            $img_res = $request->receipt_image->move(public_path('student_documents'), $createnewFileName);
        }

        if (!empty($request->attachment) && !$img_res) {
            return back()->withErrors(['image' => 'Error occurred in image uploading.']);
        }
        $save->student_admissions_id     = $request->student_admissions_id;
        $save->transition_date             = $request->transition_date;
        $save->fee_periods      = $request->fee_periods;
        $save->duration = $request->duration;
        $save->transition_amount  = $request->transition_amount;
        $save->transaction_id   = $request->transaction_id;
        if (!empty($createnewFileName)) {
            $save->receipt_image            = $createnewFileName;
        }
        $save->status = 'pending';

        $save->save();

        if (!empty($request->edit_id)) {
            return redirect()->route('pendingfeelist')->with('success', 'Record Updated Successfully...');
        }
        return redirect()->route('pendingfeelist')->with('success', 'Fee Submitted Successfully...');
    }


    public function update_fee_status(Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,fail,paid',
        ]);

        if (isset($request->status)) {
            $childfeestatus = FeeDetails::findOrFail($request->id);
            $data = [
                'status' => $request->status,
            ];

            if ($request->status == 'fail') {
                $data['reject_reason'] = strip_tags($request->reject_reason);
                $data['approved_by'] = null;
                $data['approved_at'] = null;
            }
            if ($request->status == 'paid') {
                $data['approved_by'] = auth()->id();
                $data['approved_at'] = now();
            }

            $childfeestatus->update($data);
        }
        return redirect()->back()->with('success', 'Status updated successfully!');
    }


    public function delete($id)
    {
        $feeRecord = FeeDetails::findOrFail($id);

        $feeRecord->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
    }
}
