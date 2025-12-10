<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityMatser extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_name',
        'own_city',
        'state_id',
        'status',
    ];

    public function state(){
        return $this->belongsTo(StateMatser::class,'state_id','id');
    }
}
