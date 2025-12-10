<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyMembers;
use App\Models\AcademicReport;
use App\Models\ProgressReport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\StudentAdmission;
use App\Models\ProgressReportMain;
use Illuminate\Support\Facades\File;
use App\Models\AcademicReportCoCurriculum;
use App\Models\ProgressReportCoCurricular;
use App\Models\RecordBook;

class RecordBookController extends Controller
{
   public function generate_recordBook($id = null)
   {

      if (!empty($id)) {
         $student = StudentAdmission::with('student_documents')->where('id', $id)->first();
         $family_member = FamilyMembers::where('student_id', $id)->get()->keyBy('relation');
         $progressReportMain = ProgressReportMain::with('student')->with('acadmicReport')->where('student_admissions_id', $id)->first();
         $progressReport = ProgressReport::where('student_admissions_id', $id)->get()->keyBy('domain')->toArray();
         $academicReport = AcademicReport::where('student_admissions_id', $id)->get()->keyBy('subjects')->toArray();
         $progressReportCurr = ProgressReportCoCurricular::where('student_admissions_id', $id)->first()->toArray();
         $academicReportCurr = AcademicReportCoCurriculum::where('student_admissions_id', $id)->get()->keyBy('co_curriculum')->toArray();
         $save = RecordBook::where('student_admissions_id', $id)->first();
      } 

      if(empty($save)){
         $save = new RecordBook();
      }
      // dd($family_member);
      $data = [
         'title' => 'Student Record Book',
         'student' => $student,
         'family_member' => $family_member,
         'progressReportMain' => $progressReportMain,
         'progressReport' => $progressReport,
         'academicReport' => $academicReport,
         'progressReportCurr' => $progressReportCurr,
         'academicReportCurr' => $academicReportCurr,
      ];

      $pdf = '';
      $pdf = Pdf::loadView('student.progressreport.report_page', $data);

      //FilePath
      $filepath = public_path('recordbook');
      if (!file_exists($filepath)) {
         mkdir($filepath, 0755, true);
      }
      // return $pdf->stream();
      $newFileName = $book_res =  '';
      $newFileName = date('YMdHis') . '_' . $student->enroll_number . '.pdf';


      if (!empty($save) && ($save->class_id == $student->cur_class_id)) {
         if (!empty($newFileName)) {
            $oldFile = public_path('recordbook/' . $save->record_book);
            if (File::exists($oldFile)) {
               unlink($oldFile);
            }
         }
      }
      
      $book_res = $pdf->save($filepath . '/' . $newFileName);
      $save->record_book = $newFileName;

      if (!$book_res) {
         return back()->withErrors(['record_book' => 'Error occurred in record_book uploading.']);
      }

         $save->student_admissions_id = $student->id;
         $save->class_id = $student->cur_class_id;
         $save->year = $progressReportMain->progress_report_year;
         $save->save();

      return redirect()->route('progressreport_list')->with('success', "Record Book Genereate Successfully");
   }
}
