@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'timetablelist',
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i>&nbsp;Time Table List</h6>
                            @if (Auth::user()->role != 'parent')
                                <a href="{{ route('timetable_action', ['action' => 'Add']) }}"
                                    class="btn btn-sm btn-outline-info pull-right"><i class="fa fa-plus"></i>&nbsp;Add
                                    Time Table</a>
                            @endif
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
                            @if (session('error'))
                                <div class="error alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <table class="table text-center table-bordered alltable" id="example">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Time Table </th>
                                        <th>Document </th>
                                        <th>Description </th>
                                        <th>Created at </th>
                                        <th>Updated at </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $getdata)
                                        @php
                                            $status = strtoupper($getdata->status ?? 'NA');
                                            $statusClass = match ($getdata->status) {
                                                0 => 'text-danger font-weight-bold',
                                                1 => 'text-success font-weight-bold',
                                                default => 'text-secondary font-weight-bold',
                                            };
                                        @endphp
                                        <tr>
                                            <td>{{ $getdata->class->class_name ?? 'NA' }} </td>

                                            <td class="{{$statusClass}}">{{(($getdata->status??'')!='1')? 'InActive' : 'Active'}}  </td>
                                            <td >
                                                <a href="{{ asset('teacher_documents/' . $getdata->document) }}" target="_blank" class="text-primary table_doc" title="View Doc">                                                 
                                                 View Time Table Doc                                                  
                                                </a>
                                            </td>
                                            <td id="video_description" data-toggle="tooltip" data-placement="top"
                                                title="{{ strip_tags($getdata->short_description) }}">
                                                {!! Str::limit($getdata->short_description ?? 'NA', 60) !!}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($getdata->created_at)->format('d-M-Y') ?? 'NA' }} </td>
                                            <td>{{ \Carbon\Carbon::parse($getdata->updated_at)->format('d-M-Y') ?? 'NA' }} </td>

                                            <td class="not-export">
                                                <a href="{{ route('timetable_action', ['action' => 'Edit', 'id' => $getdata->id]) }}"
                                                    class="text-primary ">
                                                    <i class="fa fa-edit"></i>

                                                </a>&nbsp;
                                                <a href="javascript:void(0)" class="text-danger "
                                                    onclick="deleteClass('{{ route('timetable.delete', $getdata->id) }}')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        {{-- attachment  modal --}}
        <div class="modal fade" id="reasonAttachment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Leave Request Attachment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="#" alt="" id="leaveAttachment">
                    </div>
                </div>
            </div>
        </div>
        {{-- end attachment Status modal --}}

        {{-- Start Reason Status modal --}}
        <div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Leave Reason</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="reasonData"></p>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Reason Status modal --}}
        {{-- Start Remarks Status modal --}}
        <div class="modal fade" id="remarkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remark Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="remarksData"></p>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Remarks Status modal --}}

        {{-- Start Leave Status modal --}}
        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Leave Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('updateleavestatus') }}" id="statusform">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" value="" name="id">
                                <label for="updatestatus" class="col-form-label">Status:</label>
                                <select class="form-control" id="updatestatus" name="status">
                                    <option value="">Select Status</option>
                                    <option value="approved">Approved</option>
                                    <option value="pending">Pending</option>
                                    <option value="rejected">Rejected</option>
                                    {{-- <option value="cancelled">Cancel</option> --}}
                                </select>
                                <div id="rejectReasonBox" class="form-group mt-3 d-none ">
                                    <label for="rejectReason">Remarks:</label>
                                    <textarea id="rejectReason" class="form-control text-danger" rows="3" placeholder="Enter reason"
                                        name="remarks"></textarea>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="button" class="btn btn-light rounded-pill mr-10"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary rounded-pill" id="saveBtn"
                                    style="float: right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Leave Status modal --}}

        <script>
            var status_value = '';
            $(document).on('click', '#form_byid', function(e) {
                e.preventDefault();
                var dataId = $(this).data('id');
                var status = $(this).data('status');
                status_value = status;
                var remarks = $(this).data('remarks');
                $('#statusform input[name="id"]').val(dataId);
                $('#updatestatus').val(status);
                if (remarks && status === 'rejected') {
                    $('#rejectReason').val(remarks);
                    $('#rejectReasonBox').removeClass('d-none');
                } else {
                    $('#rejectReasonBox').addClass('d-none');
                    $('#rejectReason').val("No Reason Available");
                }

            });
        </script>
        <script>
            $(document).on('change', '#updatestatus', function() {
                if ($(this).val() === 'rejected') {
                    $('#rejectReasonBox').removeClass('d-none');
                    if (status_value != 'rejected') {
                        $('#rejectReason').val('');
                    }

                } else {
                    $('#rejectReasonBox').addClass('d-none');
                }
            })
        </script>

        <script>
            $(document).on('click', '.view_attachment', function(e) {
                e.preventDefault();
                var attachment = $(this).data('attachment');
                var leaveAttachment = document.getElementById('leaveAttachment');
                leaveAttachment.src = attachment;
            });
        </script>

        <script>
            $(document).on('click', '.view_reason', function(e) {
                e.preventDefault();
                var reason = $(this).data('reason');
                if (reason) {
                    $('#reasonData').html(reason);
                } else {
                    $('#reasonData').html("No Reason Available");
                }
            });
        </script>

        <script>
            $(document).on('click', '.view_remarks', function(e) {
                e.preventDefault();
                var reason = $(this).data('remarks');
                if (reason) {
                    $('#remarksData').html(reason);
                } else {
                    $('#remarksData').html("No Reason Available");
                }
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
