<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDisability extends Model
{

    protected $fillable=[
        'student_id',
        'disability_id',
        'description'
    ];
    use HasFactory;
    
     public function disability(){
        return $this->belongsTo(DisabilityMatser::class,'disability_id','id');
    }

    public function studentdetails(){
        return $this->belongsTo(StudentAdmission::class,'student_id','id');
    }
}
