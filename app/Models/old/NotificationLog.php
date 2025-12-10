<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'custom_notification_id',
        'user_id',
        'status',
        'error_message',
    ];

    public function notification()
    {
        return $this->belongsTo(CustomNotification::class, 'custom_notification_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
