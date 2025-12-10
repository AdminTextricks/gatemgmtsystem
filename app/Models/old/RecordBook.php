<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordBook extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(StudentAdmission::class, 'student_admissions_id', 'id');
    }
}
