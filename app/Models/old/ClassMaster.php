<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'class_name',
        'class_order',
        'status',
    ];

     public function students()
    {
        return $this->hasMany(StudentAdmission::class, 'cur_class_id', 'id');
    }

     public function timetable()
    {
        return $this->hasOne(TimeTable::class, 'class_masters_id', 'id');
    }
}
