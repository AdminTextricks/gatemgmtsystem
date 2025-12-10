<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\ClassMaster;
use Illuminate\Http\Request;
use App\Models\TeacherMaster;
use App\Models\AcademicReport;
use App\Models\ProgressReport;
use App\Models\StudentAdmission;
use App\Models\AcademicReportMain;
use App\Models\ProgressReportMain;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgressReportCoCurricular;


class ProgressReportController extends Controller
{
    public function studentlist_progressreport($id = null)
    {
        $user = Auth::user();
        if ($user->role === 'teacher') {
            $teacherclass = TeacherMaster::where('teacher_id', $user->user_id)->value('class_id');
            $data = StudentAdmission::with(['student_documents', 'progress_main', 'academic_main'])
                ->where('cur_class_id', $teacherclass)
                ->where(function ($q) {
                    $q->whereHas('progress_main')
                        ->orWhereHas('academic_main');
                })
                ->get();
        } else {
            $data = StudentAdmission::with('student_documents')->with('progress_main')->with('academic_main')->whereHas('progress_main')
                ->orWhereHas('academic_main')
                ->get();
        }

        return view('student.progressreport.index', compact('data'));
    }


    public function progressreport_action(Request $request, $action, $id = null)
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
            $getdataReport = ProgressReport::where('student_admissions_id', $id)->exists();
            $getdataReportCur = ProgressReportCoCurricular::where('student_admissions_id', $id)->exists();
            $getdataMain = ProgressReportMain::where('student_admissions_id', $id)->exists();

            if ($getdataReport) {
                $getdataReport = ProgressReport::where('student_admissions_id', $id)->get()->keyBy('domain')->toArray();
                $action = 'Edit';
            }
            if ($getdataReportCur) {
                $getdataReportCur = ProgressReportCoCurricular::where('student_admissions_id', $id)->first()->toArray();
                $action = 'Edit';
            }
            if ($getdataMain) {
                $getdataMain = ProgressReportMain::where('student_admissions_id', $id)->first();
                $action = 'Edit';
            }
        }

        return view('student.progressreport.action', compact('getdataReport', 'action', 'student', 'classMaster', 'getdataReportCur', 'getdataMain'));
    }




    public function progressreport_action_post(Request $request, $action = null)
    {
        // dd($request->all());
        $request->validate([
            'domain.*.*' => 'nullable|max:255',
            'Co-Curricular.*' => 'nullable|max:255',
        ], [
            'domain.*.*.max' => 'The value must be less than 255 characters.',
            'Co-Curricular.*.max' => 'The value must be less than 255 characters.',
        ]);


        $main_table_data = [
            'student_admissions_id' => $request->student_admissions_id,
            'progress_report_year' => $request->progress_report_year,
            'pen_picture'          => $request->pen_picture,
            'dates_of_assessment'  => $request->dates_of_assessment,
            'baseline'             => $request->baseline,
            'first_qtr'            => $request->first_qtr,
            'second_qtr'           => $request->second_qtr,
            'third_qtr'            => $request->third_qtr,
            'teacher_remarks'      => $request->teacher_remarks,
            'principal_remarks'    => $request->principal_remarks,
            'status'    => $request->input('status', 'no'),
        ];

        ProgressReportMain::updateOrCreate(
            ['student_admissions_id' => $request->student_admissions_id],
            $main_table_data
        );


        foreach ($request->domain as $domainName => $domainData) {
            ProgressReport::updateOrCreate(
                [
                    'student_admissions_id' => $request->student_admissions_id,
                    'domain'             => $domainName,
                ],
                [
                    'no_of_activities_assessed' => $domainData['no_of_activities_assessed'],
                    'maxm_score'                => $domainData['maxm_score'],
                    'baseline_score'            => $domainData['baseline_score'],
                    'baseline_percentage'       => $domainData['baseline_percentage'],
                    'first_qtr_score'           => $domainData['first_qtr_score'],
                    'first_qtr_percentage'      => $domainData['first_qtr_percentage'],
                    'second_qtr_score'          => $domainData['second_qtr_score'],
                    'second_qtr_percentage'     => $domainData['second_qtr_percentage'],
                    'third_qtr_score'           => $domainData['third_qtr_score'],
                    'third_qtr_percentage'      => $domainData['third_qtr_percentage'],
                ]
            );
        }
        ProgressReportCoCurricular::updateOrCreate(
            [
                'student_admissions_id' => $request->student_admissions_id,
                'domain'             => 'Co-Curricular',
            ],
            [
                'no_of_activities_assessed' => $request['Co-Curricular']['no_of_activities_assessed'],
                'baseline'                => $request['Co-Curricular']['baseline'],
                'first_qtr'                => $request['Co-Curricular']['first_qtr'],
                'second_qtr'                => $request['Co-Curricular']['second_qtr'],
                'third_qtr'                => $request['Co-Curricular']['third_qtr'],

            ]
        );


        if (!empty($action) && $action != 'Add') {
            return redirect()->route('progressreport_list', ['id' => $request->student_admissions_id])->with('success', 'Report Updated Submitted Successfully...');
        } else {
            return redirect()->route('progressreport_list', ['id' => $request->student_admissions_id])->with('success', 'Report Created Submitted Successfully...');
        }
    }
}
