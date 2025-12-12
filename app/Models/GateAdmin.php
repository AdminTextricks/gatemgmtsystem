<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GateAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'gate_admin_id',
        'name',
        'email',
        'mobile',
        'device_id',
        'gate_no',
        'shift',
        'email_verified_at',
        'status',
    ];
}
