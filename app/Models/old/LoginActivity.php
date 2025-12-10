<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginActivity extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'ip_address',
        'user_agent',
        'logged_in_at',
        'logged_out_at',
        'status',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
