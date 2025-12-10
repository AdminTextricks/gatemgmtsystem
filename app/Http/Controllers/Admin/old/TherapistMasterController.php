<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassMaster;
use App\Models\TherapistMaster;
use Illuminate\Http\Request;

class TherapistMasterController extends Controller
{
    public function index()
    {
        $data = TherapistMaster::all();
        return view('admin.therapistmaster.index', compact('data'));
    }

    public function therapist_action(Request $request)
    {
        $action = $request->route()->parameter('action');
        $getdata = [];
        if (isset($request->id) && !empty($request->id)) {
            $getdata = TherapistMaster::where('id', $request->id)->first();
        }
        $class = ClassMaster::all();
        return view('admin.therapistmaster.action', compact('getdata', 'action', 'class'));
    }


    public function therapist_post_action(Request $request)
    {
        $request->validate([
            'therapist_id' => 'required|unique:therapist_masters,therapist_id,' . $request->edit_id,
            'therapist_name' => 'required',
            'therapy_name' => 'required',
            'address' => 'nullable',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:therapist_masters,email,' . $request->edit_id,
            'qualification' => 'nullable',
            'classification' => 'nullable',
            'date_of_joining' => 'required',
            'proficiency' => 'nullable',
            // 'class_id' => 'required|array|exists:class_masters,id',
        ]);
        if (isset($request->edit_id) && !empty($request->edit_id)) {

            $save = TherapistMaster::where('id', $request->edit_id)->first();
        } else {

            $save = new TherapistMaster();
        }
        $save->therapist_id = $request->therapist_id;
        $save->therapist_name = $request->therapist_name;
        $save->therapy_name = $request->therapy_name;
        $save->address = $request->address;
        $save->mobile = $request->mobile;
        $save->email = $request->email;
        $save->qualification = $request->qualification;
        $save->classification = $request->classification;
        // $save->experience = $request->experience;
        $save->date_of_joining = $request->date_of_joining;
        $save->proficiency = $request->proficiency;
        // $save->class_id = $request->class_id;
        if ($request->has('status')) {
            $save->status = $request->status;
        }
        $save->save();
        return redirect()->route('therapistlist')->with('success', 'Submitted Successfully...');
    }
    public function delete($id)
    {
        $teachermaster = TherapistMaster::findOrFail($id);
        $teachermaster->delete();

        return response()->json(['success' => true, 'message' => 'Teacher deleted successfully.']);
    }
}
