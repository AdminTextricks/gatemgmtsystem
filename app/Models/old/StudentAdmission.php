<?php

namespace App\Models;

use App\Models\CityMatser;
use App\Models\ClassMaster;
use App\Models\LeaveModule;
use App\Models\StateMatser;
use App\Models\StudentDomain;
use App\Models\StudentVideos;
use App\Models\StudentTherapy;
use App\Models\DisabilityMatser;
use App\Models\StudentDocuments;
use App\Models\ProgressReportMain;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAdmission extends Model
{
    use HasFactory;
    use SoftDeletes;

    //  protected static function booted()
    // {
    //     static::deleting(function ($student) {

    //         // 🧾 Delete related StudentDocuments
    //         $document = $student->student_documents; // relationship defined below

    //         if ($document) {
    //             $fileColumns = [
    //                 'image',
    //                 'aadhar_image',
    //                 'birth_certificate_image',
    //                 'disability_certificate_image',
    //                 'medical_certificate_image',
    //                 'udid_certificate_image',
    //                 'transfer_certificate_image',
    //                 'doc_prescription',
    //                 'other_document_1',
    //                 'other_document_2',
    //                 'case_history'
    //             ];

    //             foreach ($fileColumns as $column) {
    //                 if (!empty($document->$column)) {
    //                     $filePath = public_path('student_documents/' . $document->$column);

    //                     if (File::exists($filePath)) {
    //                         File::delete($filePath);
    //                     }
    //                 }
    //             }

    //             $document->delete();
    //         }

    //          foreach ($student->student_fee as $fee) {
    //             if (!empty($fee->receipt_image)) {
    //                 $filePath = public_path('student_documents/' . $fee->receipt_image);
    //                 if (File::exists($filePath)) {
    //                     File::delete($filePath);
    //                 }
    //             }
    //             dd("hello");
    //              $student->student_fee()->delete();
    //         }

    //         foreach ($student->student_leave as $leave) {
    //             if (!empty($leave->attachment)) {
    //                 $filePath = public_path('student_documents/' . $leave->attachment);
    //                 if (File::exists($filePath)) {
    //                     File::delete($filePath);
    //                 }
    //             }
    //              $student->student_leave()->delete();
    //         }

    //         $student->student_disability()->delete();
    //         $student->student_domains()->delete();
    //         $student->student_therapy()->delete();
    //         $student->familyMembers()->delete();
    //         $student->progress_main()->delete();
    //         $student->progress_report()->delete();
    //         $student->progress_report_cur()->delete();
    //         $student->academic_main()->delete();
    //         $student->academic_report()->delete();
    //         $student->academic_report_cur()->delete();

    //         if (!empty($student->qrcode)) {
    //             $filePath = public_path($student->qrcode);
    //             if (File::exists($filePath)) {
    //                 File::delete($filePath);
    //             }
    //         }
    //     });
    // }


    //Relations
    public function cur_class()
    {
        return $this->belongsTo(ClassMaster::class, 'cur_class_id', 'id');
    }
    public function adm_class()
    {
        return $this->belongsTo(ClassMaster::class, 'adm_class_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(CityMatser::class, 'city_id', 'id');
    }
    public function state()
    {
        return $this->belongsTo(StateMatser::class, 'state_id', 'id');
    }

    public function disability()
    {
        return $this->belongsTo(DisabilityMatser::class, 'disability_id', 'id');
    }

    public function student_documents()
    {
        return $this->hasOne(StudentDocuments::class, 'student_admissions_id', 'id');
    }
    public function student_domains()
    {
        return $this->hasMany(StudentDomain::class, 'student_id', 'id');
    }
    public function student_therapy()
    {
        return $this->hasMany(StudentTherapy::class, 'student_id', 'id');
    }
    public function student_disability()
    {
        return $this->hasMany(StudentDisability::class, 'student_id', 'id');
    }

    public function familyMembers()
    {
        return $this->hasMany(FamilyMembers::class, 'student_id', 'id');
    }

    public function student_fee()
    {
        return $this->hasMany(FeeDetails::class, 'student_admissions_id', 'id');
    }

    public function student_leave()
    {
        return $this->hasMany(LeaveModule::class, 'student_id', 'id');
    }

    public function progress_main()
    {
        return $this->hasOne(ProgressReportMain::class, 'student_admissions_id', 'id');
    }
    public function progress_report()
    {
        return $this->hasMany(ProgressReport::class, 'student_admissions_id', 'id');
    }
    public function progress_report_cur()
    {
        return $this->hasOne(ProgressReport::class, 'student_admissions_id', 'id');
    }

    public function academic_main()
    {
        return $this->hasOne(AcademicReportMain::class, 'student_admissions_id', 'id');
    }
    public function academic_report()
    {
        return $this->hasMany(AcademicReport::class, 'student_admissions_id', 'id');
    }

    public function academic_report_cur()
    {
        return $this->hasMany(AcademicReportCoCurriculum::class, 'student_admissions_id', 'id');
    }

    public function record_pdfs()
    {
        return $this->hasMany(RecordBook::class, 'student_admissions_id', 'id');
    }

    public function student_videos(){
        return $this->hasMany(StudentVideos::class,'student_admissions_id', 'id');
    }
}
