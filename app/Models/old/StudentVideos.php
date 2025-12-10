<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentVideos extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_admissions_id',
        'therapy_name',
        'cur_class',
        'domain_name',
        'video',
        'description',
        'status',
    ];

    public function students(){
        return $this->belongsTo(StudentAdmission::class, 'student_admissions_id', 'id');
    }
}
