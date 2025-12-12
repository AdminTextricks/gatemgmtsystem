<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'uid',
        'block_no',
        'flat_no',
        'date',
        'duration',
        'max_allow_days',
        'status',
        'visitor_key',
        'created_by',
        'created_for',
        'updated_by',
    ];


    public function request_status()
    {
        return $this->belongsTo(VisitorStatus::class, 'status', 'id');
    }
}
