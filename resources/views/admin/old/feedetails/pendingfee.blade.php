@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'pendingfee',
])
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Pending Fee List</h6>
                            @if (Auth::user()->role === 'parent')
                                <a href="{{ route('fee_form', ['action' => 'Add']) }}"
                                    class="btn btn-sm btn-outline-info pull-right"><i class="fa fa-plus"></i>&nbsp;Add
                                    Fee</a>
                            @endif
                        </div>
                        <hr>
                    </div>
                    {{-- temp 
                    <div>
                        <h5 class="card-body p-12"> Work is Under Process</h5>
                    </div>
                     end temp --}}
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
                            <table class="table text-center table-bordered alltable" id="example">
                                <thead class="text-primary">
                                    <tr>
                                        {{-- <th class="not-export">Photo</th> --}}
                                        {{-- <th>Enroll Id</th> --}}
                                        <th> Enroll/Name</th>
                                        <th> Class</th>
                                        <th>Trans. Date</th>
                                        <th>Fee Period</th>
                                        <th>Duration</th>
                                        <th>Trans. Amount</th>
                                        <th>Trans. Id</th>
                                        <th>Approved By</th>
                                        <th>Approved At</th>
                                        <th>Receipt</th>
                                        <th class="not-export">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $studentmaster)
                                        {{-- @php
                                        dd($studentmaster->student->student_documents->image);
                                    @endphp --}}
                                        <tr>

                                            <td>{{ $studentmaster->student->enroll_number ?? 'NA' }}-
                                                {{ $studentmaster->student->student_name ?? 'NA' }}</td>
                                            {{-- <td>{{ $studentmaster->student->student_name ?? 'NA' }}</td> --}}
                                            <td>{{ $studentmaster->student->cur_class->class_name ?? 'NA' }}</td>
                                            <td>{{ $studentmaster->transition_date ?? 'NA' }}</td>
                                            <td>{{ $studentmaster->fee_periods ?? 'NA' }}</td>
                                            <td>{{ $studentmaster->duration ?? 'NA' }}</td>
                                            <td>{{ $studentmaster->transition_amount ?? 'NA' }}</td>
                                            <td>{{ $studentmaster->transaction_id ?? 'NA' }}</td>
                                            <td>{{ $studentmaster->user->name ?? 'NA' }}</td>
                                            <td>{{ $studentmaster->approved_at ? \Carbon\Carbon::parse($studentmaster->approved_at)->format('d-M-Y H:i:s') : 'NA' }}
                                            </td>
                                            <td class="not-export">
                                                <a class="text-primary student_photo" title="View" data-toggle="modal"
                                                    data-target="#PhotoModal"
                                                    data-src="{{ asset('student_documents/' . ($studentmaster->receipt_image ? $studentmaster->receipt_image : 'child_profile_pic.jpg')) }}">
                                                    <img src="{{ asset('student_documents/' . ($studentmaster->receipt_image ? $studentmaster->receipt_image : 'child_profile_pic.jpg')) }}"
                                                        class="card-img-top" alt="Image"
                                                        style="width: 50px; object-fit: cover; cursor: pointer;">
                                                </a>

                                            </td>
                                            <td class="not-export">

                                                @php
                                                    $status = strtoupper($studentmaster->status ?? 'NA');
                                                    $statusClass = match ($studentmaster->status) {
                                                        'pending' => 'text-warning font-weight-bold',
                                                        'fail' => 'text-danger font-weight-bold',
                                                        'paid' => 'text-success font-weight-bold',
                                                        default => 'text-secondary font-weight-bold',
                                                    };
                                                @endphp
                                                <span class="{{ $statusClass }}">
                                                    {{ $status }}
                                                </span><br>
                                                <div class="mt-2">
                                                    <a href="#" class="text-info view_reason" title="View Remark"
                                                        data-toggle="modal" data-target="#reasonModal"
                                                        data-reason="{{ $studentmaster->reject_reason }}">
                                                        <i class="fa-solid fa-file-lines" style="font-size: .8rem;"></i>
                                                    </a>
                                                    @if (Auth::user()->role === 'admin' )
                                                        {{-- If status is "fail", show reason link --}}
                                                        <a href="#" class="{{ $statusClass }} fee_status "
                                                            title="Update Status" id="form_byid" data-toggle="modal"
                                                            data-target="#statusModal" data-id="{{ $studentmaster->id }}">
                                                            <span class="text-info"><i class="fa fa-edit"
                                                                    style="font-size: .8rem;"></i></span>
                                                        </a>
                                                        <a href="javascript:void(0)" class="text-danger "
                                                            onclick="deleteFee('{{ route('fee.delete', $studentmaster->id) }}')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>

                                                        {{-- End of If status is "fail", show reason link --}}
                                                    @elseif(Auth::user()->role == 'parent')
                                                        {{-- If status is "fail", show reason link even for parent --}}

                                                        @if ($studentmaster->status == 'fail')
                                                            <a href="{{ route('fee_form', ['action' => 'Edit', 'id' => $studentmaster->id]) }}"
                                                                class="text-info edit_fee_details" title="Edit Details">
                                                                <span class="text-primary"><i class="fa fa-edit"
                                                                        style="font-size: .8rem;"></i> </span>
                                                            </a>
                                                        @elseif($studentmaster->status == 'pending')
                                                            <a href="{{ route('fee_form', ['action' => 'Edit', 'id' => $studentmaster->id]) }}"
                                                                class="text-info edit_fee_details" title="Edit Details">
                                                                <span class="text-primary"><i class="fa fa-edit"
                                                                        style="font-size: .8rem;"></i> </span>
                                                            </a>
                                                            @if (empty($studentmaster->reject_reason))
                                                                <a href="javascript:void(0)" class="text-danger "
                                                                    onclick="deleteFee('{{ route('fee.delete', $studentmaster->id) }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            @endif
                                                        @endif
                                                        {{-- End of  If status is "fail", show reason link even for parent --}}
                                                    @endif
                                                </div>

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
    </div>

    {{-- Fee Status modal --}}
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Fee Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('updatefeestatus') }}" id="statusform">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" value="" name="id">
                            <label for="updatestatus" class="col-form-label">Status:</label>
                            <select class="form-control" id="updatestatus" name="status">
                                <option value="">Select Status</option>
                                <option value="paid">Approved</option>
                                <option value="pending">Pending</option>
                                <option value="fail">Rejected</option>
                            </select>
                            <div id="rejectReasonBox" style="display:none;" class="form-group mt-3">
                                <label for="rejectReason">Reason for Rejection:</label>
                                <textarea id="rejectReason" class="form-control" rows="3" placeholder="Enter reason" name="reject_reason"></textarea>
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
    {{-- end Fee Status modal --}}
    {{-- Start of Status Reason modal --}}
    <div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fee Status Remark</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="fail_reason" class="text-danger mb-0"></p>
                </div>
            </div>
        </div>
    </div>
    {{-- End of Status Reason modal --}}

    {{-- PHOTO modal --}}
    <div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content">

                <div class="qrcontainer" id="PhotoCode">
                    <!-- Header with Close Button -->
                    <div class="modal-header">
                        <h6 class="modal-title">Uploaded Receipt Image</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body p-0">
                        <img id="StudentImage" src="#" controls autoplay />
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer justify-content-between">
                    <!-- <span> Photo student details.</span> -->

                </div>

            </div>
        </div>
    </div>
    {{-- end Photo modal --}}

    {{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
    <script>
        $(document).on('change', '#updatestatus', function() {
            let rejectEditor;
            if ($(this).val() === 'fail') {
                $('#rejectReasonBox').show();
                if (!rejectEditor) {
                    ClassicEditor
                        .create(document.querySelector('#rejectReason'))
                        .then(editor => {
                            rejectEditor = editor;
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            } else {
                $('#rejectReasonBox').hide();
            }
        })
    </script>

    <script>
        $(document).on('click', '#form_byid', function(e) {
            e.preventDefault();
            var dataId = $(this).data('id');
            $('#statusform input[name="id"]').val(dataId);

        });
    </script>
    <script>
        $(document).on('click', '.view_reason', function(e) {
            e.preventDefault();
            var reason = $(this).data('reason');
            if (reason) {
                $('#fail_reason').text(reason);
            } else {
                $('#fail_reason').text("No Reason Available");
            }

        });
    </script>

    <script>
        $('.student_photo').on('click', function(e) {
            var photoUrl = $(this).data('src');
            var photoImg = document.getElementById('StudentImage');
            photoImg.src = photoUrl;

        });
    </script>

    <script>
        function deleteFee(url) {
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
