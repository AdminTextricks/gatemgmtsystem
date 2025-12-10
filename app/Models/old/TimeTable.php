<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeTable extends Model
{
    use HasFactory;

      protected static function booted()
    {
        static::deleting(function ($timetable) {

            if (!empty($timetable->document)) {
                $filePath = public_path('student_documents/' . $timetable->document);
                if (File::exists($filePath)) {
                    unlink($filePath);
                }
            }
        });
    }

    protected $fillable=[
        'class_masters_id',
        'document',
        'status',
        'short_description',
    ];


    public function class(){
        return $this->belongsTo(ClassMaster::class, 'class_masters_id', 'id');
    }
}
