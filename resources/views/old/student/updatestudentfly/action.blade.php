@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'studentFLY',
])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-body">
                 @if(session('success'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('studentlist') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} Update Student FLY</p>
                </div>
                <hr>
                <form action="{{route('studentfly.action')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="enroll_number">Enroll No.</label>
                                <input type="text" class="form-control" id="enroll_number" name="enroll_number"
                                    placeholder="Enroll No."
                                    value="{{ isset($getdata->enroll_number) ? $getdata->enroll_number : '' }}{{ old('enroll_number') }}" required/>
                                @error('enroll_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="edit_id" id="edit_id"
                                    value="{{ isset($getdata->id) ? $getdata->id : '' }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="admission_date">Admission Date</label>
                                <input type="date" class="form-control" id="admission_date" name="admission_date"
                                    placeholder="Admission Date"
                                    value="{{ isset($getdata->admission_date) ? $getdata->admission_date : '' }}{{ old('admission_date') }}" required/>
                                @error('admission_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Session</label>
                                <input type="text" class="form-control" id="session_id" name="session_id" placeholder=""
                                    value="" readonly />
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="student_name">Student Name</label>
                                <input type="text" class="form-control" id="student_name" name="student_name"
                                    placeholder="Student Name"
                                    value="{{ isset($getdata->student_name) ? $getdata->student_name : '' }}{{ old('student_name') }}" required/>
                                @error('student_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="class_id">Current Class</label>
                                <select class="form-control" id="last_class_id" name="last_class_id" required>
                                    <option value="">Select Class</option>
                                    @foreach ($classMaster as $class)
                                        <option value="{{ $class->id }}"
                                            @if ((isset($getdata->class_id) && $getdata->class_id == $class->id) || old('class_id') == $class->id) selected @endif> {{ $class->class_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="class_id">Promoted To</label>
                                <select class="form-control" id="new_class_id" name="new_class_id" required>
                                    <option value="">Select Class</option>
                                    @foreach ($classMaster as $class)
                                        <option value="{{ $class->id }}"
                                            @if ((isset($getdata->class_id) && $getdata->class_id == $class->id) || old('class_id') == $class->id) selected @endif> {{ $class->class_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}

    {{-- <script>
        var base_url = '';
        if (location.host === 'localhost' || location.host === '127.0.0.1:8000') {
            base_url = location.origin;
        } else {
            base_url = location.origin + "/school-crm/public/index.php";
        }
    </script> --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            var year = new Date().getFullYear();
            var session = `${year}-${year+1}`;
            $('#session_id').val(session);

            $('#enroll_number').on('change', function() {
                var id = $('#enroll_number').val();
                var main_url = "{{ route('getStudentById', ['id' => '__id__']) }}";
                var url = main_url.replace('__id__', id);
                $.ajax({
                    url: url,
                    method: "get",
                    processData: false,
                    contentType: false,
                    data: enroll_number,
                    success: function(response) {
                        if (response) {
                            var data = response.data;
                            $("#student_name").val(data.student_name);
                            $("#admission_date").val(data.admission_date);
                            $("#last_class_id").val(data.cur_class_id);
                            $("#edit_id").val(data.id);
                        }
                    },
                    error: function(xhr) {
                        console.log("Have some error");
                    }

                })
            })
        })
    </script>
@endsection
