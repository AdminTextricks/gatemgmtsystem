@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'pendingfee',
])

@section('content')
    <style>
        /* Custom style for file input */
        .form-group input[type="file"] {
            opacity: 1;
            position: relative;
        }
    </style>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} Fee Details</p>
                </div>
                <hr>
                <form action="{{ route('fee.action') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="student_admissions_id">Students</label>
                                <select name="student_admissions_id" id="student_admissions_id" class="form-control">
                                    <option value="">Select Enrollment No.</option>
                                    @foreach ($data as $student)
                                        <option value="{{ $student->id }}"
                                            {{ old('student_admissions_id', $getdata->student_admissions_id ?? '') == $student->id ? 'selected' : '' }}>
                                            {{ $student->enroll_number }} - {{ $student->student_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('student_admissions_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="edit_id" id="edit_id"
                                    value="{{ isset($getdata->id) ? $getdata->id : '' }}" />
                                    {{-- using for ajax error handling --}}
                                    <div id="studentDetails"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Child Name</label>
                                <input type="text" class="form-control" id="student_name" name="name"
                                    placeholder="Child Name"
                                    value="{{ isset($data->student_name) ? $data->student_name : '' }}" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="class">Child Class</label>
                                <input type="text" class="form-control" id="student_class" name="class"
                                    placeholder="Child Class"
                                    value="{{ isset($data->cur_class) ? $data->cur_class->class_name : '' }}" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- <input type="hidden" name="student_admissions_id" id="student_admissions_id"
                            value="{{ isset($data->id) ? $data->id : '' }}" /> --}}

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="transition_date">Date Of Transition</label>
                                <input type="date" name="transition_date" id="transition_date" class="form-control"
                                    value="{{ old('transition_date', isset($getdata->transition_date) ? $getdata->transition_date : '') }}"
                                    placeholder="Date Of Transition" max="{{ date('Y-m-d') }}" required>
                                @error('transition_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $fee_periods = ['Monthly', 'Quarterly', 'Half Yearly', 'Yearly'];
                                @endphp
                                <label for="fee_periods">Fee Periods</label>
                                <select class="form-control" name="fee_periods" id="fee_periods" required>
                                    <option value="">Select Fee Periods</option>
                                    @foreach ($fee_periods as $fee_period)
                                        <option value="{{ $fee_period }}"
                                            {{ old('fee_periods', $getdata->fee_periods ?? '') == $fee_period ? 'selected' : '' }}>
                                            {{ $fee_period }} </option>
                                    @endforeach
                                </select>
                                @error('fee_periods')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 " id="durationField">
                            <div class="form-group">
                                <label for="duration">Duration </label>
                                <select class="form-control" name="duration" id="duration" required>
                                    <option value="">--Select Duration--</option>
                                </select>
                                @error('duration')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="transaction_id">Transition Id</label>
                                <input type="text" name="transaction_id" id="transaction_id" class="form-control"
                                    value=" {{ old('transaction_id', isset($getdata->transaction_id) ? $getdata->transaction_id : '') }}",
                                    placeholder="Transition Id">
                                @error('transaction_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="transition_amount">Transition Amount </label>
                                <input type="number" name="transition_amount" id="transition_amount" class="form-control"
                                    value="{{ old('transition_amount', isset($getdata->transition_amount) ? $getdata->transition_amount : '') }}"
                                    step="1" min="0" placeholder="Transition Amount" required>
                                @error('transition_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="receipt_image">Receipt Image</label>
                                <input type="file" name="receipt_image" id="receipt_image"
                                    class="form-control @error('receipt_image') is-invalid @enderror"
                                    placeholder="Receipt Image" {{ $action != 'Edit' ? 'required' : '' }}>
                                @if (!empty($getdata->receipt_image))
                                    <div>
                                        <a class="text-primary student_photo" title="View" data-toggle="modal"
                                            style="font-size: .7rem; cursor: pointer;" data-target="#PhotoModal"
                                            data-src="{{ asset('student_documents/' . ($getdata->receipt_image ? $getdata->receipt_image : 'No_image.jpg')) }}">
                                            View Uploaded Receipt
                                        </a>
                                    </div>
                                @endif
                                @error('receipt_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>
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
                        <h6 class="modal-title">Uploaded Receipt Image</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body p-0 ">
                        <img id="StudentImage" src="#" controls autoplay />
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer justify-content-between">
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
        $(document).ready(function() {
            var oldDuration = "{{ old('fee_periods', $getdata->fee_periods ?? '') }}";
            var oldMonth = "{{ old('duration', $getdata->duration ?? '') }}";
            $('#fee_periods').on('change', function() {
                var val = $(this).val();
                var options = [];

                $('#durationField').show();
                if (val === 'Monthly') {
                    options = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug',
                        'Sep',
                        'Oct', 'Nov', 'Dec'
                    ];
                } else if (val === 'Quarterly') {
                    options = ['Q1 (Jan–Mar)', 'Q2 (Apr–Jun)', 'Q3 (Jul–Sep)', 'Q4 (Oct–Dec)'];
                } else if (val === 'Half Yearly') {
                    options = ['H1 (Jan–Jun)', 'H2 (Jul–Dec)'];
                } else if (val === 'Yearly') {
                    options = ['(Jan-Dec)'];
                }

                $('#duration').empty().append('<option value="">-- Select --</option>');
                $.each(options, function(_, name) {
                    $('#duration').append(`<option value="${name}">${name}</option>`);
                });

            });

            if (oldDuration) {
                $('#fee_periods').val(oldDuration).trigger('change');
                if (oldMonth) {
                    $('#duration').val(oldMonth);
                }
            }

        });
    </script>

    <script>
        $(document).on('change', '#student_admissions_id', function() {
            let studentId = $('#student_admissions_id').val();
             var main_url = "{{ route('studentby_id', ['id' => '_id_']) }}";
            var url = main_url.replace('_id_', studentId);

            $.ajax({
                url: url, 
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    $('#studentDetails').html('<p>Loading...</p>');
                },
                success: function(response) {
                    if (response.success) {
                        let student = response.data;
                         $('#studentDetails').html(``);
                        $('#student_class').val(student.cur_class.class_name);
                        $('#student_name').val(student.student_name);
                      
                    } else {
                        $('#studentDetails').html('<p style="color:red;">Student not found.</p>');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    $('#studentDetails').html('<p style="color:red;">An error occurred.</p>');
                }
            });
        });
    </script>
@endsection
