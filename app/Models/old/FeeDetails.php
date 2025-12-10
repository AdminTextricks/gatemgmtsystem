<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeeDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_admissions_id',
        'transition_date',
        'duration',
        'month',
        'transition_amount',
        'transaction_id',
        'receipt_image',
        'status',
        'approved_at',
        'approved_by',
        'reject_reason',
        'fee_periods',

    ];

       protected static function booted()
    {
        static::deleting(function ($feeRecord) {
            if (!empty($feeRecord->receipt_image)) {
                $filePath = public_path('student_documents/' . $feeRecord->receipt_image);
                if (File::exists($filePath)) {
                    unlink($filePath);
                }
            }
        });
    }

     public function student(){
        return $this->belongsTo(StudentAdmission::class,'student_admissions_id','id');
    }

     public function user(){
        return $this->belongsTo(User::class,'approved_by','id');
    }
}
