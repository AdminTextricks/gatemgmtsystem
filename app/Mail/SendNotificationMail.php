<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\NotificationLog;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $notification;
    public $attachmentPath;
    /**
     * Create a new message instance.
     */
    public function __construct($notification, $attachmentPath = null)
    {
        $this->notification = $notification;
        $this->attachmentPath = $attachmentPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->notification->title ?? 'Notification'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        return new Content(
            view: 'emails.notification',
            with: [
                'messageBody' => $this->notification->message ?? '',
                'title' => $this->notification->title ?? 'Notification',
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if ($this->attachmentPath && file_exists(public_path($this->attachmentPath))) {
            return [
                Attachment::fromPath(public_path($this->attachmentPath)),
            ];
        }

        return [];
    }
}
