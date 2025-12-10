<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicReport extends Model
{
    use HasFactory;
     protected $fillable=[
        'student_admissions_id',
        'subjects',
        'quarter_1',
        'quarter_2',
        'quarter_3',
        'max_marks',
    ];

      public function academic_report(){
        return $this->belongsTo(AcademicReport::class,'student_admissions_id','id');
    }
}
