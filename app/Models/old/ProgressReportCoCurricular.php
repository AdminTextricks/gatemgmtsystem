<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressReportCoCurricular extends Model
{
    use HasFactory;

     protected $fillable=[
        'student_admissions_id',
        'domain',
        'no_of_activities_assessed',
        'baseline',
        'first_qtr',
        'second_qtr',
        'third_qtr',
    ];

   
}
