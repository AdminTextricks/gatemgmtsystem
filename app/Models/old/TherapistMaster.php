<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TherapistMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'therapist_id',
        'therapist_name',
        'therapy_name',
        'address',
        'mobile',
        'email',
        'experience',
        'qualification',
        'date_of_joining',
        'proficiency',
        'classification',
        // 'class_id',
        'status',
    ];

    public function class()
    {
        return $this->belongsTo(ClassMaster::class, 'class_id', 'id');
    }
}
