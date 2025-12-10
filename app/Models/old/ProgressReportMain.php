<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressReportMain extends Model
{
    use HasFactory;

    protected $fillable=[
        'student_admissions_id',
        'progress_report_year',
        'pen_picture',
        'dates_of_assessment',
        'baseline',
        'first_qtr',
        'second_qtr',
        'third_qtr',
        'teacher_remarks',
        'principal_remarks',
        'status',

    ];

      public function student(){
        return $this->belongsTo(StudentAdmission::class,'student_admissions_id','id');
    }
      public function acadmicReport(){
        return $this->belongsTo(AcademicReportMain::class,'student_admissions_id','student_admissions_id');
    }
}
