<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDomain extends Model
{
    use HasFactory;
      protected $fillable = [
        'student_id',
        'cur_class_id',
        'domain_name',
        'description',
    ];

    public function student()
    {
        return $this->belongsTo(StudentAdmission::class, 'student_id', 'id');
    }

     public function class(){
        return $this->belongsTo(ClassMaster::class,'cur_class_id','id');
    }
}
