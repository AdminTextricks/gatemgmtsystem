@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'leavelist',
])
@section('content')
    <style>
        .ck-editor__editable_inline {
            min-height: 100px;
        }
    </style>
    <div class="content">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('leavelist') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} leave Details</p>
                </div>
                <hr>
                <form action="{{ route('leave.action', ['action' => $action]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student_id">Students</label>
                                <select name="student_id" id="student_id" class="form-control">
                                    <option value="">Select Student</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}"
                                            {{ old('student_id', $getdata->student_id ?? '') == $student->id ? 'selected' : '' }}>
                                            {{-- @if ((isset($getdata->student_id) && $getdata->student_id == $student->id) || old('student_id') == $student->id) selected @endif>  --}}
                                            {{ $student->enroll_number }} - {{ $student->student_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('student_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="edit_id" id="edit_id"
                                    value="{{ isset($getdata->id) ? $getdata->id : '' }}" />
                            </div>
                        </div>

                        <div class="col-md-3 start-date">
                            <div class="form-group">
                                <label for="start_date"> Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    placeholder="Start Date" {{-- value="{{ old('start_date', isset($getdata->start_date) ? $getdata->start_date : '') }}" required onChange="resetenddate()"/> --}}
                                    value="{{ old('start_date', $getdata->start_date ?? '') }}" required
                                    onChange="resetenddate()" />
                                @error('start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 end-date">
                            <div class="form-group">
                                <label for="end_date"> End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    placeholder="End Date" {{-- value="{{ old('end_date', isset($getdata->end_date) ? $getdata->end_date : '') }}" required  onChange="calculateDays()"/> --}}
                                    value="{{ old('end_date', $getdata->end_date ?? '') }}" required
                                    onChange="calculateDays()" />
                                @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="enddate">Total Day</label>
                                <input type="text" class="form-control" id="total_days" name="total_days"
                                    placeholder="Total Days" {{-- value="{{ old('total_days', isset($getdata->total_days) ? $getdata->total_days : '') }}" required readonly/> --}}
                                    value="{{ old('total_days', $getdata->total_days ?? '') }}" required readonly />
                                @error('total_days')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 reason">
                            <div class="form-group">
                                <label for="reason">Reason</label>
                                <textarea class="form-control ckeditor" id="reason" name="reason" placeholder="Enter Reason">{{ old('reason', $getdata->reason ?? '') }}</textarea>
                                @error('reason')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-groupp">
                                <label for="attachment">Attachment</label>
                                <input type="file" class="form-control" id="attachment" name="attachment"
                                    placeholder="Attachment" value="" autocomplete="new-password" />
                                @error('attachment')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @if (isset($getdata->id) && !empty($getdata->attachment))
                            @if ($getdata->id ?? '')
                                <div class="col-md-3">
                                    <div class="form-groupp">
                                        <label for="doc"></label>
                                      
                                        <img src="{{ asset('student_documents/' . ($getdata->attachment ? $getdata->attachment : 'No_image.jpg')) }}"
                                            class="card-img-top" alt="Image" style="width: 170px; object-fit: cover;">
                                    </div>
                                </div>
                            @endif
                            @endif

                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                    </div>
                </form>
            </div>

        </div>

    </div>
    <script>
        document.querySelectorAll('.ckeditor').forEach(function(el) {
            ClassicEditor.create(el, {
                    toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'undo',
                        'redo', 'blockQuote', 'insertTable',
                    ],

                })
                .catch(error => console.error(error));
        });
    </script>

    {{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
    <script>
        function resetenddate() {
            document.getElementById("end_date").value = '';
        }

        function calculateDays() {
            // Get input field values
            const start_date = document.getElementById("start_date").value;
            const end_date = document.getElementById("end_date").value;

            // Validation check
            if (!start_date || !end_date) {
                alert("Please select both start and end dates");
                document.getElementById("start_date").value = '';
                document.getElementById("end_date").value = '';
                return;
            }
            // Convert to Date objects
            const start = new Date(start_date);
            const end = new Date(end_date);

            // Calculate difference in milliseconds
            const diffInMs = end - start;

            // Convert milliseconds to days
            const diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24)) + 1;
            if (diffInDays <= 0) {
                alert("Start date must be less then end date.");
                document.getElementById("start_date").value = '';
                document.getElementById("end_date").value = '';
                return false;
            }
            // Show result
            document.getElementById("total_days").value = diffInDays;
        }
    </script>
@endsection
