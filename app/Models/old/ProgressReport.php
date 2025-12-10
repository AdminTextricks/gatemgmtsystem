<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressReport extends Model
{
    use HasFactory;

     protected $fillable=[
        'student_admissions_id',
        'domain',
        'no_of_activities_assessed',
        'maxm_score',
        'baseline_score',
        'baseline_percentage',
        'first_qtr_score',
        'first_qtr_percentage',
        'second_qtr_score',
        'second_qtr_percentage',
        'third_qtr_score',
        'third_qtr_percentage',
        

    ];

     public function student(){
        return $this->belongsTo(StudentAdmission::class,'student_admissions_id','id');
    }

    public function acadmicReport(){
        return $this->belongsTo(AcademicReportMain::class,'student_admissions_id','student_admissions_id');
    }

}
