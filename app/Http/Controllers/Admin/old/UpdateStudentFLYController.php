<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentAdmission;
use App\Models\ClassMaster;
use Illuminate\Http\Request;

class UpdateStudentFLYController extends Controller
{
    public function index()
    {
        $data = StudentAdmission::with('class:id,class_name')
            ->with('city:id,city_name')
            ->with('disability:id,disability_name')
            ->with('student_documents')
            ->orderBy('id', 'desc')
            ->get();

        return view('student.updatestudentfly.index', compact('data'));
    }


    public function studentfly_action(Request $request)
    {
        $action = $request->route()->parameter('action');
        $getdata = [];        
        $classMaster =  ClassMaster::select('id', 'class_id', 'class_name')
            ->where('status', 1)
            ->get();
        return view('student.updatestudentfly.action', compact('getdata', 'action','classMaster'));
    }

    public function getStudentById(Request $request, $id=null)
    {
        $action = $request->route()->parameter('action');
       $getdata=StudentAdmission::where('enroll_number', $id)->first();
       return response()->json([
        'success' => true,
        'data' => $getdata,
       ], 201);
    }


    public function studentfly_post_action(Request $request)
    {
      $student=StudentAdmission::where('id', $request->edit_id)->first();
      $student->cur_class_id   = $request->new_class_id;
       $student->save();

       return redirect()->back()->with('success', 'Data Updated Successfully...');
    
    }
    
}
