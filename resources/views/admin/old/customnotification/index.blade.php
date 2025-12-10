@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'notifications',
])

@section('content')
    <style>
        .tooltip-inner {
            max-width: 420px;
            white-space: normal;
            word-wrap: break-word;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0 auto;
            padding: 20px;
        }

        .email_message {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Notifications</h6>
                            <a href="{{ route('notification.create') }}" class="btn btn-sm btn-outline-info pull-right"><i
                                    class="fa fa-plus"></i>&nbsp;Add</a>

                        </div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if (session('success'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($notifications->isNotEmpty())
                                <table class="table text-center table-bordered alltable" id="example">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Sr.No</th>
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
                                        @foreach ($notifications as $index => $notif)
                                            @php
                                                $sent =
                                                    $notif->success_count ??
                                                    $notif->logs->where('status', 'success')->count();
                                                $failed =
                                                    $notif->failed_count ??
                                                    $notif->logs->where('status', 'failed')->count();

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

                                            @endphp

                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td data-toggle="tooltip" data-placement="top" class="email_message"
                                                    title="{!! $notif->message !!}">
                                                    <strong>{{ Str::limit($notif->title, 35) }}</strong><br>
                                                    <small class="text-muted">{!! Str::words($notif->message, 10, '...') !!}
                                                    </small>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $notif->type == 'teacher' ? 'primary' : 'info' }}">
                                                        {{ ucfirst($notif->type) }}
                                                    </span>

                                                </td>
                                                <td><strong>{{ $totalRecipients }}</strong></td>
                                                <td><span class="text-success fw-bold">{{ $sent }}</span></td>
                                                <td><span class="text-danger fw-bold">{{ $failed }}</span></td>
                                                <td>
                                                    @if ($pending > 0)
                                                        <span class="text-warning fw-bold">{{ $pending }}</span>
                                                    @else
                                                        <span class="text-muted">0</span>
                                                    @endif
                                                </td>
                                                <td>{!! $statusHtml !!}</td>
                                                <td>
                                                    @if ($notif->attachment)
                                                        <a href="{{ asset($notif->attachment) }}" target="_blank"
                                                         data-toggle="tooltip" data-placement="bottom" title="View Attached File"   class="text-primary">
                                                            <i class="fa fa-paperclip"></i>
                                                        </a>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a class="text-primary " data-toggle="modal"
                                                            data-target="#logModal{{ $notif->id }}">
                                                           <span data-toggle="tooltip" data-placement="bottom" title="View Notification Details" > <i class="fa fa-list"></i></span>

                                                        </a>&nbsp;

                                                        @if ($failed > 0)
                                                            <a href="#" class="text-danger" data-toggle="tooltip" data-placement="top"  title="Resend Notification" 
                                                                onclick="event.preventDefault(); 
                                                                    if(confirm('Resend failed email?')) {
                                                                        document.getElementById('redo_form_{{ $notif->notificationlog->id }}').submit();
                                                                    }">
                                                                <i class="fa fa-redo"></i>
                                                            </a>

                                                            <form id="redo_form_{{ $notif->notificationlog->id }}"
                                                                action="{{ route('email.resend', ['id' => $notif->notificationlog->id]) }}"
                                                                method="POST" style="display:none;">
                                                                @csrf
                                                            </form>
                                                        @endif

                                                        <a href="javascript:void(0)" class="text-danger " class="d-inline" data-toggle="tooltip" data-placement="top"
                                                         title="Delete Notification"   onclick="deleteClass('{{ route('notification.delete', $notif->id) }}')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            @else
                                <table class="table text-center table-bordered " id="emptytable">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="py-5 text-muted text-center">
                                                    <i class="fa fa-bell-slash fa-3x mb-3"></i><br>
                                                    No notifications found.
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- start logModal --}}
    @foreach ($notifications as $notif)
        <div class="modal fade" id="logModal{{ $notif->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title">Logs - {{ Str::title($notif->title) }}</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            <strong>Total:</strong>
                            {{ $notif->send_to_all ? \App\Models\User::where('role', $notif->type)->count() : count($notif->recipient_ids ?? []) }}
                            | <strong>Sent:</strong>
                            {{ $notif->success_count ?? $notif->logs->where('status', 'success')->count() }}
                            | <strong>Failed:</strong>
                            {{ $notif->failed_count ?? $notif->logs->where('status', 'failed')->count() }}
                            | <strong>Pending:</strong>
                            {{ max(0, ($notif->send_to_all ? \App\Models\User::where('role', $notif->type)->count() : count($notif->recipient_ids ?? [])) - (($notif->success_count ?? $notif->logs->where('status', 'success')->count()) + ($notif->failed_count ?? $notif->logs->where('status', 'failed')->count()))) }}
                        </p>

                        <div class="table-responsive">
                            <table class="table text-center table-bordered " id="example">
                                <thead class="text-primary">
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
                                                <span
                                                    class="badge bg-{{ $log->status == 'success' ? 'success' : 'danger' }}">{{ ucfirst($log->status) }}</span>
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
    {{-- end logModal --}}

    <script>
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });
    </script>
    <script>
        function deleteClass(url) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire("Deleted!", "Your record has been deleted.", "success")
                                    .then(() => location.reload()); // Refresh page after success
                            } else {
                                Swal.fire("Error!", "Failed to delete the record.", "error");
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire("Error!", "Something went wrong.", "error");
                        });
                }
            });
        }
    </script>
@endsection
