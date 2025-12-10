@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'archivedstudents',
])
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> archived Student List</h6>
                            <!-- <a href="{{ route('student_action', ['action' => 'Add']) }}"
                                class="btn btn-sm btn-outline-info pull-right"><i class="fa fa-plus"></i>&nbsp;Add
                                Student</a> -->
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
                            <table class="table text-center table-bordered alltable" id="example">
                                <thead class="text-primary">
                                    <tr>
                                        <th class="not-export">Photo</th>
                                        <th>Enroll Number</th>
                                        <th>Current Class</th>
                                        <th>Student Name</th>
                                        <th>Parent</th>
                                        <th>Mobile</th>
                                        <th>Disability</th>
                                        <th class="not-export">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $studentmaster)
                                        <tr>
                                            <td class="not-export">
                                                <img src="{{ asset('student_documents/' . (isset($studentmaster->student_documents->image) && $studentmaster->student_documents->image ? $studentmaster->student_documents->image : 'child_profile_pic.jpg')) }}"
                                                    class="card-img-top" alt="Image"
                                                    style="width: 50px; object-fit: cover;">

                                            </td>
                                            <td>{{ $studentmaster->enroll_number ?? 'NA' }}</td>
                                            <td>{{ $studentmaster->cur_class->class_name ?? 'NA' }}</td>
                                            <td>{{ $studentmaster->student_name ?? 'NA' }}</td>
                                            <td>{{ $studentmaster->fathers_name ?? 'NA' }}</td>
                                            <td>{{ $studentmaster->mobile ?? 'NA' }}</td>
                                            @php
                                                $disabilities_arr = $studentmaster->student_disability->pluck(
                                                    'disability_id',
                                                );
                                                $disabilities = $disabilitymaster
                                                    ->whereIn('id', $disabilities_arr?? []) 
                                                    ->pluck('disability_name') 
                                                    ->implode(', ');
                                            @endphp
                                            <td>{{ $disabilities ?? 'NA' }}</td>
                                            <td class="not-export">
                                                <a href="{{ route('student_action', ['action' => 'View', 'id' => $studentmaster->id]) }}"
                                                    class="text-primary student_qr" title="View" data-toggle="modal"
                                                    data-target="#QrModal" data-src="{{ asset($studentmaster->qrcode) }}">

                                                    <i class="fa fa-qrcode"></i>
                                                </a>&nbsp;
                                                <!-- <a href="{{ route('student_action', ['action' => 'Edit', 'id' => $studentmaster->id]) }}"
                                                    class="text-primary" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>&nbsp; -->
                                                <a href="{{ route('student_documents', ['action' => 'Edit', 'student_id' => $studentmaster->id]) }}"
                                                    class="text-primary" title="Documents">
                                                    <i class="fa fa-file"></i>
                                                </a>&nbsp;
                                                <!-- <a href="javascript:void(0)" class="text-danger"
                                                    onclick="deleteStudent('{{ route('student.delete', $studentmaster->id) }}')"
                                                    title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a> -->
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

    {{-- QR modal --}}
    <div class="modal fade" id="QrModal" tabindex="-1" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content">

                <!-- Header with Close Button -->
                <div class="modal-header">
                    <h6 class="modal-title">Student Detail QR Code</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body p-0">
                    <img id="qrImage" src="#" controls autoplay style="width:100%; height:auto;" />
                </div>

                <!-- Footer -->
                <div class="modal-footer justify-content-start">
                    <span> Scan the QR Code to get student details.</span>
                </div>

            </div>
        </div>
    </div>
    {{-- end QR modal --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $('.student_qr').on('click', function(e) {
            // var button = $(e.relatedTarget);
            var qrUrl = $(this).data('src');
            var qrImg = document.getElementById('qrImage');
            qrImg.src = qrUrl;

        });
    </script>

    <script>
        function deleteStudent(url) {
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
