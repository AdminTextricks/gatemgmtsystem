<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AcademicReport;
use App\Models\AcademicReportCoCurriculum;
use App\Models\AcademicReportMain;
use App\Models\ClassMaster;
use Illuminate\Http\Request;
use App\Models\ProgressReport;
use App\Models\StudentAdmission;
use App\Models\ProgressReportMain;
use App\Models\ProgressReportCoCurricular;

class AcademicReportController extends Controller
{

    public function studentlist_academicreport()
    {
        $data = AcademicReportMain::with('student')->get();

        return view('student.academicreport.index', compact('data'));
    }


    public function academicreport_action(Request $request, $action, $id = null)
    {
        $action = $request->route()->parameter('action');
        $getdataReportCur = [];
        $getdataReport = [];
        $getdataMain = [];
        $student = [];
        $classMaster =  ClassMaster::select('id', 'class_id', 'class_name')
            ->where('status', 1)
            ->get();

        if (!empty($id)) {
            $student = StudentAdmission::with('cur_class:id,class_name')->where('id', $id)->where('status', 1)->first();
        }

        if (isset($request->id) && !empty($request->id)) {
            $getdataReport = AcademicReport::where('student_admissions_id', $id)->exists();
            $getdataReportCur = AcademicReportCoCurriculum::where('student_admissions_id', $id)->exists();
            $getdataMain = AcademicReportMain::where('student_admissions_id', $id)->exists();

            if ($getdataReport) {
                $getdataReport = AcademicReport::where('student_admissions_id', $id)->get()->keyBy('subjects')->toArray();
                $action = 'Edit';
            }
            if ($getdataReportCur) {
                $getdataReportCur = AcademicReportCoCurriculum::where('student_admissions_id', $id)->get()->keyBy('co_curriculum')->toArray();
                $action = 'Edit';
            }
            if ($getdataMain) {
                $getdataMain = AcademicReportMain::where('student_admissions_id', $id)->first();
                $action = 'Edit';
            }
        }
        return view('student.academicreport.action', compact('getdataReport', 'action', 'student', 'classMaster', 'getdataReportCur', 'getdataMain'));
    }

    public function academicreport_action_post(Request $request, $action = null)
    {
        // dd($request->all());
        $request->validate([
            'domain.*.*' => 'nullable|max:255',
            'Co_Curriculum.*.*' => 'nullable|max:255',
        ], [
            'domain.*.*.max' => 'The value must be less than 255 characters.',
            'Co_Curriculum.*.*.max' => 'The value must be less than 255 characters.',
        ]);
        $main_table_data = [
            'student_admissions_id' => $request->student_admissions_id,
            'pen_picture'          => $request->pen_picture,
            'status'          => $request->input('status', 'no'),

        ];

        AcademicReportMain::updateOrCreate(
            ['student_admissions_id' => $request->student_admissions_id],
            $main_table_data
        );


        foreach ($request->domain as $domainName => $domainData) {
            AcademicReport::updateOrCreate(
                [
                    'student_admissions_id' => $request->student_admissions_id,
                    'subjects'             => $domainName,
                ],
                [
                    'quarter_1'     => $domainData['quarter_1'],
                    'quarter_2'     => $domainData['quarter_2'],
                    'quarter_3'     => $domainData['quarter_3'],
                    'max_marks'     => $domainData['max_marks'],
                ]
            );
        }

        foreach ($request->Co_Curriculum as $domainName => $domainData) {
            AcademicReportCoCurriculum::updateOrCreate(
                [
                    'student_admissions_id' => $request->student_admissions_id,
                    'co_curriculum'             => $domainName,
                ],
                [
                    'quarter_1'     => $domainData['quarter_1'],
                    'quarter_2'     => $domainData['quarter_2'],
                    'quarter_3'     => $domainData['quarter_3'],
                    'Remarks'     => $domainData['Remarks'],
                ]
            );
        }

        if (!empty($action) && $action != 'Add') {
            return redirect()->route('progressreport_list', ['id' => $request->student_admissions_id])->with('success', 'Report Updated Submitted Successfully...');
        } else {
            return redirect()->route('progressreport_list', ['id' => $request->student_admissions_id])->with('success', 'Report Created Submitted Successfully...');
        }
    }
}
