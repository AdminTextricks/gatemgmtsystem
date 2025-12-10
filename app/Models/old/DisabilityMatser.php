<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class 
DisabilityMatser extends Model
{
    use HasFactory;
    public function students()
    {
        return $this->hasMany(StudentDisability::class, 'disability_id', 'id');
    }

   
}
