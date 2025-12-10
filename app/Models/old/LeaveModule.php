<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveModule extends Model
{
    use HasFactory;
   
    protected static function booted()
    {
        static::deleting(function ($leaveRecord) {

            if (!empty($leaveRecord->attachment)) {
                $filePath = public_path('student_documents/' . $leaveRecord->attachment);
                if (File::exists($filePath)) {
                    unlink($filePath);
                }
            }
        });
    }

    public function student(){
        return $this->belongsTo(StudentAdmission::class,'student_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'approved_by','id');
    }
}
