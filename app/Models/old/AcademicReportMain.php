<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicReportMain extends Model
{
    use HasFactory;

    protected $fillable=[
        'student_admissions_id',
        'pen_picture',
        'status',
    ];

    public function student(){
    return $this->belongsTo(StudentAdmission::class,'student_admissions_id','id');
}
}
