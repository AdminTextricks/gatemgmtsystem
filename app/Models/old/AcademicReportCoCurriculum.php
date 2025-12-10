<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicReportCoCurriculum extends Model
{
    use HasFactory;
      protected $fillable=[
        'student_admissions_id',
        'co_curriculum',
        'quarter_1',
        'quarter_2',
        'quarter_3',
        'Remarks',
    ];
}
