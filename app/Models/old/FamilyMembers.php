<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMembers extends Model
{
    protected $fillable=[
        'student_id',
        'member_name',
        'relation',
        'qualification',
        'occupation',
        'contact',
        'adhaar_no',
        'age',
        'gender',
    ];
    use HasFactory;

    public function students(){
        return $this->belongsTo(StudentAdmission::class,'student_id','id');
    }
}
