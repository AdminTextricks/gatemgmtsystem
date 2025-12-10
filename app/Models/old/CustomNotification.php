<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomNotification extends Model
{
    use HasFactory;

     protected $fillable = [
        'title', 'message', 'type', 'send_to_all', 'recipient_ids',
        'attachment', 'success_count', 'failed_count'
    ];

     protected $casts = [
        'recipient_ids' => 'array',
    ];

     public function logs()
    {
        return $this->hasMany(NotificationLog::class,'custom_notification_id');
    }

     public function notificationlog()
    {
        return $this->hasOne(NotificationLog::class,'custom_notification_id');
    }
    
}
