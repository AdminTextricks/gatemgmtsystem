<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ClassMaster;
use Illuminate\Http\Request;
use App\Models\FamilyMembers;
use App\Models\OccupationMaster;
use App\Models\StudentAdmission;

class FamilyMembersController extends Controller
{
    public function student_family(Request $request)
    {
        $action = $request->route()->parameter('action');
        $student_id = $request->route()->parameter('student_id');
        $classMaster =  ClassMaster::select('id', 'class_id', 'class_name')
            ->where('status', 1)
            ->get();
        $occupations =  OccupationMaster::select('id', 'occupation_name')
            ->where('status', 1)
            ->get();
        $getdata = [];
        $familyMembers  = [];

        if (isset($student_id) && !empty($student_id)) {
            $getdata = StudentAdmission::where('id', $student_id)->first();
            $familyMembers = FamilyMembers::where('student_id', $student_id)->get();
        }

        return view('student.studentadmission.family', compact('getdata', 'action', 'familyMembers', 'classMaster', 'occupations'));
    }


    public function student_post_family(Request $request)
    {
        // dd($request->all());
        $rules = [
            'student_id'          => 'required|exists:student_admissions,id',
            'member_name'           => 'required|array',
            'member_name.*'         => 'required|string|max:255',
            'relation'              => 'required|array',
            'relation.*'            => 'required|string|max:50',
            'age'                   => 'required|array',
            'age.*'                 => 'required|integer',
            'gender'                => 'required|array',
            'gender.*'              => 'required|string|in:Male,Female,Other',
            // 'qualification'         => 'nullable|array',
            // 'qualification.*'       => 'nullable|string|max:100',
            'occupation'            => 'required|array',
            'occupation.*'          => 'required|string|max:100',
            // 'contact'               => 'required|array',
            // 'contact.*'             => 'required|string|max:10',
            'adhaar_no'             => 'nullable|array',
            'adhaar_no.*' => 'nullable|string|max:12',


        ];

        if (!empty($request->relation)) {
            foreach ($request->relation as $index => $relation) {
                if ($relation === 'Father') {
                    $rules["contact.$index"] = 'required|string|max:10';
                } else {
                    if (!in_array('Father', $request->relation) && $index == 0) {
                        $rules["contact.$index"] = 'required|string|max:10';
                    } else {
                        $rules["contact.$index"] = 'nullable|string|max:10';
                    }
                }
            }
        }

        $request->validate($rules);
        $count = count($request->relation);
        FamilyMembers::where('student_id', $request->student_id)->delete();
        for ($i = 0; $i < $count; $i++) {
            FamilyMembers::updateOrCreate([
                'id' =>    $request->edit_id[$i] ?? null,
                'student_id'     => $request->student_id,
            ], [
                'member_name'        => $request->member_name[$i] ?? null,
                'relation'    => $request->relation[$i] ?? null,
                'qualification'  => $request->qualification[$i] ?? null,
                'occupation'  => $request->occupation[$i] ?? null,
                'contact'     => $request->contact[$i] ?? null,
                'adhaar_no'     => $request->adhaar_no[$i] ?? null,
                'age'         => $request->age[$i] ?? null,
                'gender'         => $request->gender[$i] ?? null,
            ]);
        }


        return redirect()->route('student_documents', ['action' => 'Add', 'student_id' => $request->student_id])->with('success', 'Family members saved successfully!');
    }
}
