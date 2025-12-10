<?php

namespace App\Jobs;

use App\Mail\SendNotificationMail;
use App\Models\CustomNotification;
use App\Models\NotificationLog;
use App\Models\TeacherMaster;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notification;
    protected $edit_id;

    /**
     * Create a new job instance.
     */
    public function __construct(CustomNotification $notification, $edit_id=null)
    {
        $this->notification = $notification;
        $this->edit_id    = $edit_id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $success = 0;
        $failed = 0;
        try {
            $query = User::where('role', $this->notification->type);

            if (!$this->notification->send_to_all && !empty($this->notification->recipient_ids)) {
                $query->whereIn('id', $this->notification->recipient_ids);
            }

            $recipients = $query->get(['id', 'email']);

            Log::info('Notification dispatch started', [
                'notification_id' => $this->notification->id,
                'notification_email' => $this->notification->email,
                'notification_message' => $this->notification->message,
                'recipients' => $recipients,
            ]);

            foreach ($recipients as $user) {
                try {
                    Mail::to($user->email)->send(
                        new SendNotificationMail($this->notification, $this->notification->attachment)
                    );

                    if ($this->edit_id) {
                        $log = NotificationLog::find($this->edit_id);
                        $log->update([
                            'custom_notification_id' => $this->notification->id,
                            'notification_message' => $this->notification->message,
                            'user_id' => $user->id,
                            'status' => 'success',
                        ]);
                    } else {
                        NotificationLog::create([
                            'custom_notification_id' => $this->notification->id,
                            'notification_message' => $this->notification->message,
                            'user_id' => $user->id,
                            'status' => 'success',
                        ]);
                    }
                    $success++;
                } catch (\Exception $e) {
                    if ($this->edit_id) {
                        $log = NotificationLog::find($this->edit_id);
                        $log->update([
                            'custom_notification_id' => $this->notification->id,
                            'user_id' => $user->id,
                            'status' => 'failed',
                            'error_message' => $e->getMessage(),
                        ]);
                    } else {
                        NotificationLog::create([
                            'custom_notification_id' => $this->notification->id,
                            'user_id' => $user->id,
                            'status' => 'failed',
                            'error_message' => $e->getMessage(),
                        ]);
                    }


                    Log::error(' Mail sending failed', [
                        'email' => $user->id,
                        'custom_notification_id' => $this->notification->id,
                        'error' => $e->getMessage(),
                    ]);
                    $failed++;
                }
            }

            $this->notification->update([
                'success_count' => $success,
                'failed_count' => $failed,
            ]);
        } catch (\Exception $e) {
            Log::error(' Notification job crashed', [
                'notification_id' => $this->notification->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
