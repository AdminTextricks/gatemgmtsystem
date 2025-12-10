@extends('layouts.app', ['elementActive' => 'notifications'])

@section('content')
<div class="content">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5><i class="fa fa-bell"></i> Notifications</h5>
            <a href="{{ route('notification.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> New
            </a>
        </div>

        <div class="card-body">
            <form method="GET" class="mb-3">
                <div class="row g-2">
                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control" placeholder="Search title/message..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="type" class="form-control">
                            <option value="">All Types</option>
                            <option value="parent" {{ request('type') == 'parent' ? 'selected' : '' }}>Parent</option>
                            <option value="teacher" {{ request('type') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                        </select>

                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-outline-primary w-100 m-0">Filter</button>
                    </div>
                </div>
            </form>


            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Total</th>
                            <th>Sent</th>
                            <th>Failed</th>
                            <th>Pending</th>
                            <th>Status</th>
                            <th>Attachment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notifications as $notif)
                        @php
                        $sent = $notif->success_count ?? $notif->logs->where('status','success')->count();
                        $failed = $notif->failed_count ?? $notif->logs->where('status','failed')->count();

                        $totalRecipients = $notif->send_to_all
                        ? \App\Models\User::where('role', $notif->type)->count()
                        : count($notif->recipient_ids ?? []);

                        $pending = max(0, $totalRecipients - ($sent + $failed));

                        if ($pending > 0) {
                        $statusHtml = '<span class="badge bg-warning">Pending</span>';
                        } elseif ($failed > 0) {
                        $statusHtml = '<span class="badge bg-danger">Failed</span>';
                        } else {
                        $statusHtml = '<span class="badge bg-success">Sent</span>';
                        }

                        $serial = ($notifications->firstItem() ?? 0) + $loop->index;
                        @endphp

                        <tr>
                            <td>{{ $serial }}</td>
                            <td>
                                <strong>{{ Str::limit($notif->title, 35) }}</strong><br>
                                <small class="text-muted">{{ Str::limit($notif->message, 50) }}</small>
                            </td>
                            <td>
                                <span class="badge bg-{{ 
                                        $notif->type == 'success' ? 'success' :
                                        ($notif->type == 'warning' ? 'warning' :
                                        ($notif->type == 'danger' ? 'danger' : 'info'))
                                    }}">
                                    {{ ucfirst($notif->type) }}
                                </span>
                            </td>
                            <td><strong>{{ $totalRecipients }}</strong></td>
                            <td><span class="text-success fw-bold">{{ $sent }}</span></td>
                            <td><span class="text-danger fw-bold">{{ $failed }}</span></td>
                            <td>
                                @if($pending > 0)
                                <span class="text-warning fw-bold">{{ $pending }}</span>
                                @else
                                <span class="text-muted">0</span>
                                @endif
                            </td>
                            <td>{!! $statusHtml !!}</td>
                            <td>
                                @if($notif->attachment)
                                <a href="{{ asset($notif->attachment) }}" target="_blank" class="text-primary">
                                    <i class="fa fa-paperclip"></i>
                                </a>
                                @else
                                <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-info" data-toggle="modal" data-target="#logModal{{ $notif->id }}">
                                        <i class="fa fa-list"></i>
                                    </button>
                                    


                                    @if($failed > 0)
                                    <form method="POST" action="" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Resend failed emails?')">
                                            <i class="fa fa-redo"></i>
                                        </button>
                                    </form>
                                    @endif

                                    <form method="POST" action="" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Delete this notification?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-5 text-muted">
                                <i class="fa fa-bell-slash fa-3x mb-3"></i><br>
                                No notifications found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $notifications->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>

@foreach($notifications as $notif)
<div class="modal fade" id="logModal{{ $notif->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Logs - {{ $notif->title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <strong>Total:</strong> {{ $notif->send_to_all ? \App\Models\User::where('role', $notif->type)->count() : count($notif->recipient_ids ?? []) }}
                    | <strong>Sent:</strong> {{ $notif->success_count ?? $notif->logs->where('status','success')->count() }}
                    | <strong>Failed:</strong> {{ $notif->failed_count ?? $notif->logs->where('status','failed')->count() }}
                    | <strong>Pending:</strong> {{ max(0, ( $notif->send_to_all ? \App\Models\User::where('role', $notif->type)->count() : count($notif->recipient_ids ?? [])) - (($notif->success_count ?? $notif->logs->where('status','success')->count()) + ($notif->failed_count ?? $notif->logs->where('status','failed')->count()))) }}
                </p>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Error</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notif->logs as $log)
                            <tr class="{{ $log->status == 'success' ? 'table-success' : 'table-danger' }}">
                                <td>{{ $log->user->name ?? '—' }}</td>
                                <td>{{ $log->user->email ?? '—' }}</td>
                                <td>
                                    <span class="badge bg-{{ $log->status == 'success' ? 'success' : 'danger' }}">{{ ucfirst($log->status) }}</span>
                                </td>
                                <td>{{ $log->error_message ? Str::limit($log->error_message, 120) : '—' }}</td>
                                <td>{{ optional($log->created_at)->format('d M Y H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No logs found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

@endsection