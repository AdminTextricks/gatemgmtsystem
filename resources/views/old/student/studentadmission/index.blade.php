@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'studentlist',
])
@section('content')
    <style>
        /* Custom style for file input */
        .form-group input[type="file"] {
            opacity: 1;
            position: relative;
        }

        .item-card {
            position: relative;
            cursor: pointer;
        }

        .item-card .btn-list.onhover {
            position: absolute;
            top: 2%;
            right: -28%;
            transition: all 0.5s ease;
            opacity: 0;
            visibility: hidden;
        }

        .item-card:hover .btn-list.onhover {
            right: 1%;
            opacity: 1;
            visibility: visible;
        }

        .card .btn-list.onhover a.viewIcon {
            display: block;
            width: 30px;
            background: white;

        }

        .viewIcon {
            padding: 4px;
            font-size: 12px;
            color: #30afa3;
            display: inline-block;
            text-align: center;
            border-radius: 3px;
            border: none;
            background: white;
        }
    </style>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Student List</h6>
                            @if ($user->role != 'parent')
                                <a href="{{ route('student_action', ['action' => 'Add']) }}"
                                    class="btn btn-sm btn-outline-info pull-right"><i class="fa fa-plus"></i>&nbsp;Add
                                    Student</a>
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
                                                <a class="text-primary student_photo" title="View" data-toggle="modal"
                                                    data-target="#PhotoModal"
                                                    data-src="{{ asset('student_documents/' . (isset($studentmaster->student_documents->image) && $studentmaster->student_documents->image ? $studentmaster->student_documents->image : 'child_profile_pic.jpg')) }}">
                                                    <img src="{{ asset('student_documents/' . (isset($studentmaster->student_documents->image) && $studentmaster->student_documents->image ? $studentmaster->student_documents->image : 'child_profile_pic.jpg')) }}"
                                                        class="card-img-top" alt="Image"
                                                        style="width: 50px; object-fit: cover; cursor: pointer;">
                                                </a>

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
                                                    ->whereIn('id', $disabilities_arr ?? [])
                                                    ->pluck('disability_name')
                                                    ->implode('<br>');
                                            @endphp
                                            <td>
                                                {!! $disabilities ?? 'NA' !!}
                                            </td>
                                            @if ($user->role != 'parent')
                                                <td class="not-export">
                                                    <span data-toggle="modal" data-target="#QrModal">
                                                        <a class="text-primary student_qr" title="View"
                                                            data-toggle="tooltip" data-placement="top"
                                                            data-src="{{ asset($studentmaster->qrcode) }}">

                                                            <i class="fa fa-qrcode"></i>
                                                        </a>&nbsp;
                                                    </span>
                                                    <a href="{{ route('student_action', ['action' => 'Edit', 'id' => $studentmaster->id]) }}"
                                                        class="text-primary" title="Edit" data-toggle="tooltip"
                                                        data-placement="bottom">
                                                        <i class="fa fa-edit"></i>
                                                    </a>&nbsp;
                                                    <a href="{{ route('student_documents', ['action' => 'Edit', 'student_id' => $studentmaster->id]) }}"
                                                        class="text-primary" title="Documents" data-toggle="tooltip"
                                                        data-placement="top">
                                                        <i class="fa fa-file"></i>
                                                    </a>&nbsp;
                                                    <br>
                                                    {{-- start progress report --}}
                                                    @php
                                                        $getdataReport = App\Models\ProgressReport::where(
                                                            'student_admissions_id',
                                                            $studentmaster->id,
                                                        )->exists();
                                                        $getdataMain = App\Models\ProgressReportMain::where(
                                                            'student_admissions_id',
                                                            $studentmaster->id,
                                                        )->exists();
                                                        $getdataReportCur = App\Models\ProgressReportCoCurricular::where(
                                                            'student_admissions_id',
                                                            $studentmaster->id,
                                                        )->exists();
                                                        if ($getdataReport || $getdataMain || $getdataReportCur) {
                                                            $action = 'Edit';
                                                        } else {
                                                            $action = 'Add';
                                                        }

                                                        $getdataAcademicReport = App\Models\AcademicReport::where(
                                                            'student_admissions_id',
                                                            $studentmaster->id,
                                                        )->exists();
                                                        $getdataAcademicMain = App\Models\AcademicReportMain::where(
                                                            'student_admissions_id',
                                                            $studentmaster->id,
                                                        )->exists();
                                                        $getdataAcademicReportCur = App\Models\AcademicReportCoCurriculum::where(
                                                            'student_admissions_id',
                                                            $studentmaster->id,
                                                        )->exists();
                                                        if (
                                                            $getdataAcademicReport ||
                                                            $getdataAcademicReport ||
                                                            $getdataAcademicReport
                                                        ) {
                                                            $academicAction = 'Edit';
                                                        } else {
                                                            $academicAction = 'Add';
                                                        }

                                                    @endphp
                                                    <a href="{{ route('progressreport_form', ['action' => $action, 'id' => $studentmaster->id]) }}"
                                                        class="text-warning " title="Progress Report" data-toggle="tooltip"
                                                        data-placement="top">
                                                        <i class="fa-solid fa-bars-progress"></i>
                                                    </a>&nbsp;
                                                    <a href="{{ route('academicreport_form', ['action' => $academicAction, 'id' => $studentmaster->id]) }}"
                                                        class="text-warning" title="Academic Report" data-toggle="tooltip"
                                                        data-placement="bottom">
                                                        <i class="fa-solid fa-square-poll-horizontal"></i>
                                                    </a>&nbsp;
                                                    {{-- end progress report --}}
                                                    @if ($studentmaster->student_domains->isEmpty())
                                                        <a href="javascript:void(0)" class="text-danger"
                                                            onclick="deleteStudent('{{ route('student.delete', $studentmaster->id) }}')"
                                                            title="Delete" data-toggle="tooltip" data-placement="top">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            @else
                                                <td class="not-export text-center viewdetail">
                                                    <a href="{{ route('studentdetailsbyid', ['id' => $studentmaster->id]) }}"
                                                        class="text-primary" data-toggle="tooltip" title="View Full Details"
                                                        data-toggle="tooltip" data-placement="top" target="_blank">
                                                        <i class="fa fa-eye"></i>
                                                    </a>&nbsp;
                                                    @php
                                                        $timetablestatus =
                                                            $studentmaster?->cur_class?->timetable?->status;
                                                        $timetable = null;
                                                        if ($timetablestatus != 0) {
                                                            $timetable =
                                                                $studentmaster?->cur_class?->timetable?->document;
                                                        }

                                                    @endphp
                                                    @if (!empty($timetable))
                                                        <a href="{{ asset('teacher_documents/' . $timetable ?? '') }}"
                                                            class="text-success" data-toggle="tooltip"
                                                            data-placement="bottom" title="Time Table" target="_blank">
                                                            <i class="fa-solid fa-calendar-days"></i>
                                                        </a>&nbsp;
                                                    @else
                                                        <a class="text-muted" data-toggle="tooltip" data-placement="bottom"
                                                            title="Time Table Not Uploaded ">
                                                            <i class="fa-solid fa-calendar-days"></i>
                                                        </a>&nbsp;
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- QR modal --}}
        <div class="modal fade" id="QrModal" tabindex="-1" role="dialog">
            <div class="modal-dialog " role="document">
                <div class="modal-content">

                    <div class="qrcontainer" id="qrCode">
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
                    </div>

                    <!-- Footer -->
                    <div class="modal-footer justify-content-between">
                        <span> Scan the QR Code to get student details.</span>
                        <button type="button" class="btn btn-info print_qr" onclick="printQRCode()">Print</button>
                    </div>

                </div>
            </div>
        </div>
        {{-- end QR modal --}}



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
    </div>



    {{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
    <script>
        $('.student_qr').on('click', function(e) {
            // var button = $(e.relatedTarget);
            var qrUrl = $(this).data('src');
            var qrImg = document.getElementById('qrImage');
            qrImg.src = qrUrl;

        });
    </script>
    <script>
        $('.student_photo').on('click', function(e) {
            // var button = $(e.relatedTarget);
            var photoUrl = $(this).data('src');
            var photoImg = document.getElementById('StudentImage');
            photoImg.src = photoUrl;

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
    <script>
        function printQRCode() {
            var qrImg = document.getElementById('qrImage');
            if (!qrImg || !qrImg.src || qrImg.src === '#') {
                alert("QR code not loaded yet!");
                return;
            }
            var printImg = qrImg.cloneNode(true);
            printImg.style.width = '2in';
            printImg.style.height = '2in';
            var iframe = document.createElement('iframe');
            iframe.style.position = 'fixed';
            iframe.style.right = '0';
            iframe.style.bottom = '0';
            iframe.style.width = '0';
            iframe.style.height = '0';
            iframe.style.border = '0';
            document.body.appendChild(iframe);

            var doc = iframe.contentWindow.document;
            doc.open();
            doc.write(
                '<html><head><title>Student Details QR Code</title></head><body style="text-align:center;margin:0;padding:20px;"></body></html>'
            );
            doc.body.appendChild(printImg);
            doc.close();

            printImg.onload = function() {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
                document.body.removeChild(iframe);
            };

            if (printImg.complete) {
                printImg.onload();
            }
        }
    </script>

    <script>
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });
    </script>
@endsection
