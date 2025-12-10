<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VistorInOutDetail extends Model
{
    use HasFactory;

     protected $fillable = [
       
        'visitor_id',
        'visiting_detail_id',
        'visitor_in_time',
        'visitor_out_time',
    ];
}
