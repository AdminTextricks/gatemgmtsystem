@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'therapyvideos',
])

@section('content')
    <style>
        .form-group input[type="file"] {
            opacity: 1;
            position: relative;
        }

        .select2-container .select2-selection--single {
            height: 38px !important;
            line-height: 38px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #dddddd !important;
        }

        .select2-container--default .select2-selection--single:hover {
            border: 1px solid #dee2e6 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #66615b !important;
        }
    </style>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('therapyvideo.list') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} Student Therapy Video</p>
                </div>
                <hr>
                <form action="{{ route('therapyvideo_post.action') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student_admissions_id">STUDENT</label>
                                <select name="student_admissions_id" id="student_admissions_id"
                                    class="form-control2 select2" required>
                                    <option value="">Select Student</option>
                                    @foreach ($students as $student)
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
                                <div id="studentDetails"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cur_class">CURRENT CLASS</label>
                                <input type="text" class="form-control" id="cur_class" name="cur_class"
                                    placeholder="Current Class" value="{{ old('cur_class', $getdata->cur_class ?? '') }}"
                                    readonly />
                                @error('cur_class')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                @php
                                    $therapyArr = [
                                        'Speech Therapy',
                                        'Occupational Therapy',
                                        'Physiotherapy',
                                        "Counsellor's Suggestions",
                                        'Hydro Therapy',
                                        'Behaviour Therapy',
                                    ];
                                @endphp
                                <label for="therapy_name">THERAPY</label>
                                <select name="therapy_name" id="therapy_name" class="form-control select2" required>
                                    <option value="">Select Therapy</option>
                                    @foreach ($therapyArr as $index => $therapy)
                                        <option value="{{ $therapy }}"
                                            {{ old('therapy_name', $getdata->therapy_name ?? '') == $therapy ? 'selected' : '' }}>
                                            {{ $therapy }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('therapy_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div id="studentDetails"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                @php
                                    $domainArr = [
                                        'Motor',
                                        'Personal',
                                        'Social',
                                        'Language',
                                        'Number, Time, Money & Measurement',
                                        'Environmental Science',
                                        'Occupational & Vocational',
                                        'Co - Curricular',
                                        'Parental Involvement Plan / Home Management Plan',
                                    ];
                                @endphp
                                <label for="domain_name">DOMAIN</label>
                                <select name="domain_name" id="domain_name" class="form-control select2">
                                    <option value="">Select Domain</option>
                                    @foreach ($domainArr as $index => $domain)
                                        <option value="{{ $domain }}"
                                            {{ old('domain_name', $getdata->domain_name ?? '') == $domain ? 'selected' : '' }}>
                                            {{ $domain }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('domain_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div id="studentDetails"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">STATUS</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="1"
                                        {{ old('status', $getdata->status ?? '') == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0"
                                        {{ old('status', $getdata->status ?? '') == 0 ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                                @error('document')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="video">THERAPY VIDEO</label>
                                <input type="file" name="video" id="video"
                                    class="form-control @error('video') is-invalid @enderror" placeholder="Video" 
                                     {{ $action != 'Edit' ? 'required' : '' }}>
                                @error('video')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 reason">
                            <div class="form-group">
                                <label for="description">DESCRIPTION</label>
                                <textarea class="form-control ckeditor" id="description" name="description" placeholder="Enter Video Description">{{ old('description', $getdata->description ?? '') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @if (!empty($getdata->video))
                            <div class="col-md-6 mt-4">
                                <div class="form-groupp">
                                    <video id="sample_courseVideoPreview" controls="" style="max-width: 300px;">
                                        <source id="sample_courseVideoSource"
                                            src="{{ asset('videos/student_video/' . ($getdata->video ? $getdata->video : '')) }}"
                                            type="video/mp4">Your browser does not
                                        support the video tag.
                                    </video>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

            </div>
            </form>
        </div>

    </div>

    </div>
    <script>
        $(document).ready(function() {
            $('#student_admissions_id').select2({
                placeholder: "Select a Student",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
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
                        $('#cur_class').val(student.cur_class.class_name);

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
