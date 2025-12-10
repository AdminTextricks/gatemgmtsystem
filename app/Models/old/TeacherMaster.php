<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'teacher_name',
        'address',
        'mobile',
        'email',
        'qualification',
        'date_of_joining',
        'proficiency',
        'document',
        'rci_registration',
        'classification',
        'class_id',
        'status',
    ];

    public function class()
    {
        return $this->belongsTo(ClassMaster::class, 'class_id', 'id');
    }
}
