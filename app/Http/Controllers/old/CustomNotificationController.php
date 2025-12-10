<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessNotification;
use App\Models\CustomNotification;
use App\Models\NotificationLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomNotificationController extends Controller
{
    public function index(Request $request)
    {
        $query = CustomNotification::with(['logs.user'])->with('notificationlog')
            ->withCount('logs as total_logs_count');

        if ($search = $request->search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($type = $request->type) {
            $query->where('type', $type);
        }

        $notifications = $query->latest()->get();
        return view('admin.customnotification.index', compact('notifications'));
    }

    public function create(Request $request)
    {
        $action = $request->route()->parameter('action');
        $teachers = User::select('id', 'name', 'user_id', 'email')->where('role', 'teacher')->get();
        $parents = User::select('id', 'name', 'user_id', 'email')->where('role', 'parent')->get();


        return view('admin.customnotification.create', compact('action', 'teachers', 'parents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|string',
            'send_to_all' => 'boolean',
            'recipient_ids' => 'nullable|array',
            'attachment' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            $file       = $request->file('attachment');
            $extension  = $file->getClientOriginalExtension();
            $newFileName = Str::uuid() . '.' . $extension;
            $directory = public_path('notifications');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            $file->move(public_path('notifications'), $newFileName);


            $attachmentPath = 'notifications/' . $newFileName;
        }

        $notification = CustomNotification::create([
            'title' => $validated['title'],
            'message' => $validated['message'],
            'type' => $validated['type'],
            'send_to_all' => $request->boolean('send_to_all'),
            'recipient_ids' => $request->boolean('send_to_all') ? null : $validated['recipient_ids'],
            'attachment' => $attachmentPath ?? null,
            'success_count' => 0,
            'failed_count' => 0,
        ]);

        ProcessNotification::dispatch($notification);

        return redirect()->route('notificationlist')->with('success', 'Notification queued successfully!');
    }

    public function resendFailed($id)
    {
        $log = NotificationLog::findOrFail($id);
        $notification=CustomNotification::where('id', $log->custom_notification_id)->first();
        $edit_id=$log->id;

        // Only resend If failed
        if ($log->status !== 'failed') {
            return back()->with('error', 'Email was not failed.');
        }

        try {
            ProcessNotification::dispatch($notification, $edit_id);
            // $log->status = 'sent';
            // $log->error_message = null;
            // $log->save();

            return back()->with('success', 'Email resent successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed again: ' . $e->getMessage());
        }
    }


    public function delete($id)
    {
        $data = CustomNotification::findOrFail($id);
        if (!empty($data)) {
            if (!empty($data->attachment)) {
                $filePath = public_path($data->attachment);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $data->delete();
        return response()->json(['success' => true, 'message' => 'Notification has been deleted successfully.']);
    }
}
