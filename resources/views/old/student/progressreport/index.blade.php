@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'progressreport',
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Progress Report List</h6>
                            {{-- <a href="{{ route('progressreport_form', ['action' => 'Add']) }}" class="btn btn-sm btn-outline-info pull-right"><i class="fa fa-plus"></i>&nbsp;Add Progress Report</a> --}}

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
                                        <th>Photo</th>
                                        <th>Enroll Number</th>
                                        <th>Class Name</th>
                                        <th>Student Name</th>
                                        <th>Progress Report</th>
                                        <th>Academic Report</th>
                                        <th>Generate Record Book</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $studentreports)
                                        @php
                                            $progressstatusClass = match ($studentreports->progress_main?->status) {
                                                'yes' => 'text-success font-weight-bold',
                                                default => 'text-warning font-weight-bold',
                                            };

                                            $acadmicstatusClass = match ($studentreports?->academic_main?->status) {
                                                'yes' => 'text-success font-weight-bold',
                                                default => 'text-warning font-weight-bold',
                                            };
                                        @endphp
                                        <tr>
                                            <td>
                                                <a class="text-primary student_photo" title="View" data-toggle="modal"
                                                    data-target="#PhotoModal"
                                                    data-src="{{ asset('student_documents/' . (isset($studentreports->student_documents->image) ? $studentreports->student_documents?->image : 'No_image.jpg')) }}">
                                                    <img src="{{ asset('student_documents/' . (isset($studentreports->student_documents->image) ? $studentreports->student_documents?->image : 'No_image.jpg')) }}"
                                                        class="card-img-top" alt="Image"
                                                        style="width: 50px; object-fit: cover; cursor: pointer;">
                                                </a>                                                

                                            </td>
                                            <td>{{ $studentreports->enroll_number ?? 'NA' }}</td>
                                            <td>{{ $studentreports->cur_class->class_name ?? 'NA' }}</td>
                                            <td>{{ $studentreports->student_name ?? 'NA' }}</td>
                                            <td>
                                                <a href="{{ route('progressreport_form', ['action' => 'Edit', 'id' => $studentreports->id]) }}"
                                                    class="{{ $progressstatusClass }}, text-center"
                                                    title="Edit Progress Report" data-toggle="tooltip" data-placement="top"
                                                    style="font-weight: 600;">
                                                    {{ $studentreports->progress_main?->status != 'yes' ? 'INCOMPLETE' : 'COMPLETED' }}
                                                </a>&nbsp;
                                            </td>
                                            <td>
                                                <a href="{{ route('academicreport_form', ['action' => 'Edit', 'id' => $studentreports->id]) }}"
                                                    class="{{ $acadmicstatusClass }}, text-center"
                                                    title="Edit Academic Report" data-toggle="tooltip" data-placement="top"
                                                    style="font-weight: 600;">
                                                    {{ $studentreports?->academic_main?->status != 'yes' ? 'INCOMPLETE' : 'COMPLETED' }}
                                                </a>&nbsp;
                                            </td>
                                            <td>
                                                @if ($studentreports->progress_main?->status === 'yes' && $studentreports?->academic_main?->status === 'yes')
                                                    <a href="{{ route('generate.recordbook', ['id' => $studentreports->id]) }}"
                                                        class="text-success" data-toggle="tooltip" data-placement="top" id="generateButton"
                                                        title="Generate Record Book" style="font-weight: 600;">
                                                        <i class="fa-solid fa-lock-open mr-1 text-danger"></i>
                                                        <div class="spinner-border spinner-border-sm text-warning d-none "
                                                            role="status">
                                                        </div>
                                                        <span class="btn-text">{{ __('GENERATE') }}</span>
                                                    </a>
                                                @else
                                                    <span class="text-muted" data-toggle="tooltip" data-placement="top"
                                                        title="Disabled" style=" cursor:not-allowed;"><i
                                                            class="fa fa-lock mr-1 text-danger"></i>RECORDS
                                                        INCOMPLETE</span>&nbsp;
                                                @endif

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

     {{-- PHOTO modal --}}
    <div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content">

                <div class="qrcontainer" id="PhotoCode">
                    <!-- Header with Close Button -->
                    <div class="modal-header">
                        <h6 class="modal-title">Student Photo</h6>
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
    <script>
        $('.student_photo').on('click', function(e) {
            var photoUrl = $(this).data('src');
            var photoImg = document.getElementById('StudentImage');
            photoImg.src = photoUrl;

        });
    </script>
    <script>
         $(document).on('click', '#generateButton', function(e) {
            var btn = $(this);
            btn.find('.spinner-border').removeClass('d-none');
            btn.find('.btn-text').text('Loading...');
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
