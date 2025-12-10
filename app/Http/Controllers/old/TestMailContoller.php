<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessNotification;
use App\Models\CustomNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestMailContoller extends Controller
{
    //
    public function index(Request $request)
    {
        $users = User::where('status', 1)->get();

        $query = CustomNotification::with(['logs.user'])
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

        $notifications = $query->latest()->paginate(5);

        return view('admin.customnotification.index', compact('notifications'));
    }

    public function create()
    {
        $users = User::where('status', 1)->get();
        return view('admin.customnotification.create', compact('users'));
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

        return redirect()->route('notifications.index')->with('success', 'Notification queued successfully!');
    }
}
