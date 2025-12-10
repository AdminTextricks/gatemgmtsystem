@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'studentFLY',
])

@section('content')
    <style>
        .table .thead-light th {
            border: 1px solid lightgray;
        }
    </style>
    </style>
    <div class="content">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} Student Progress Report</p>
                </div>
                <hr>
                <div class="logo text-center mt-2">
                    <a href="#" class="simple-text logo-mini">
                        <div class="logo-image-small">
                            <img src="{{ asset('paper') }}/img/logo.png" style="width: 10%;">
                        </div>
                    </a>
                    <p class="h6 mt-0 pt-0" style="text-transform: capitalize; font-weight: 600;">ACADEMIC REPORT CARD
                        (SAMPLE)</p>
                </div>
                <form action="{{ route('academicreport.action', ['action'=>$action]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-4" style="margin: auto;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" style="font-weight:600; color:black;">Name of the Student:</label>
                                <input type="text" class="form-control-sm d-inline-block border-0"
                                    value="{{ isset($student->student_name) ? strToUpper($student->student_name) : '' }}"
                                    disabled />
                                <input type="hidden" name="student_admissions_id" id="student_admissions_id"
                                    value="{{ isset($student->id) ? $student->id : '' }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="class" style="font-weight:600; color:black;">Class:</label>
                                <input type="text" class="form-control-sm d-inline-block border-0"
                                    value="{{ isset($student->cur_class->class_name) ? $student->cur_class->class_name : '' }}"
                                    disabled />
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2 mb-4" style="margin: auto;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="age" style="font-weight:600; color:black;">Pen picture of the
                                    student</label>
                                <textarea class="form-control" row="4" name="pen_picture" placeholder="Enter your Pen picture here...">{{ old('pen_picture', $getdataMain->pen_picture ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                    {{-- start progress report table --}}
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>S.No</th>
                                    <th>Subjects</th>
                                    <th>Quarter- 1<br>Marks Obtained</th>
                                    <th>Quarter- 2<br>Marks Obtained</th>
                                    <th>Quarter- 3<br>Marks Obtained</th>
                                    <th>Max Marks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Domains -->
                                @php
                                    $domains = ['English', 'Hindi', 'Mathematics', 'EVS', 'Computer', '<b>Total<b>'];
                                @endphp
                                @foreach ($domains as $index => $domain)
                                    <tr>
                                        @if ($index > 4)
                                            <td name="domain" id="" colspan="2" class="text-center">
                                                {!! $domain !!}</td>
                                        @else
                                            <td>0{{ $index + 1 }}</td>
                                            <td name="domain" id="">{!! $domain !!}</td>
                                        @endif

                                        <td><input type="text" name="domain[{{ $domain }}][quarter_1]"
                                                value="{{ old('domain.' . $domain . '.quarter_1', $getdataReport ? $getdataReport[$domain]['quarter_1'] : '') }}"
                                                class="form-control"></td>
                                        <td><input type="text" name="domain[{{ $domain }}][quarter_2]"
                                                value="{{ old('domain.' . $domain . '.quarter_2', $getdataReport ? $getdataReport[$domain]['quarter_2'] : '') }}"
                                                class="form-control"></td>
                                        <td><input type="text" name="domain[{{ $domain }}][quarter_3]"
                                                value="{{ old('domain.' . $domain . '.quarter_3', $getdataReport ? $getdataReport[$domain]['quarter_3'] : '') }}"
                                                class="form-control"></td>
                                        <td><input type="text" name="domain[{{ $domain }}][max_marks]"
                                                value="{{ old('domain.' . $domain . '.max_marks', $getdataReport ? $getdataReport[$domain]['max_marks'] : '') }}"
                                                class="form-control"></td>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- end progress report table --}}

                    {{-- Start Curricular domain table --}}
                    <hr class="custom-shadow" style="margin-top:2px; ">
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>S No</th>
                                    <th>Co-Curriculum</th>
                                    <th>Quarter- 1<br>Grade Obtained</th>
                                    <th>Quarter- 2<br>Grade Obtained</th>
                                    <th>Quarter- 3<br>Grade Obtained</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Domains -->
                                @php
                                    $domains = ['Art & Craft', 'Music & Dance', 'Games/ Sports'];
                                @endphp
                                @foreach ($domains as $index => $domain)
                                    <tr>
                                        <td>0{{ $index + 1 }}</td>
                                        <td name="domain" id="">{!! $domain !!}</td>
                                        <td><input type="text" name="Co_Curriculum[{{ $domain }}][quarter_1]"
                                                value="{{ old('domain.' . $domain . '.quarter_1', $getdataReportCur ? $getdataReportCur[$domain]['quarter_1'] : '') }}"
                                                class="form-control"></td>
                                        <td><input type="text" name="Co_Curriculum[{{ $domain }}][quarter_2]"
                                                value="{{ old('domain.' . $domain . '.quarter_2', $getdataReportCur ? $getdataReportCur[$domain]['quarter_2'] : '') }}"
                                                class="form-control"></td>
                                        <td><input type="text" name="Co_Curriculum[{{ $domain }}][quarter_3]"
                                                value="{{ old('domain.' . $domain . '.quarter_3', $getdataReportCur ? $getdataReportCur[$domain]['quarter_3'] : '') }}"
                                                class="form-control"></td>
                                        <td><input type="text" name="Co_Curriculum[{{ $domain }}][Remarks]"
                                                value="{{ old('domain.' . $domain . '.Remarks', $getdataReportCur ? $getdataReportCur[$domain]['Remarks'] : '') }}"
                                                class="form-control"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-4" style="margin: auto;">
                        <div class="col-md-6">
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Grade</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>A</td>
                                            <td name="domain" id="">Exceptional, outstanding and excellent</td>
                                        </tr>
                                        <tr>
                                            <td>B</td>
                                            <td name="domain" id="">Very good, good</td>
                                        </tr>
                                        <tr>
                                            <td>C</td>
                                            <td name="domain" id="">Satisfactory,</td>
                                        </tr>
                                        <tr>
                                            <td>D</td>
                                            <td name="domain" id="">Needs improvement</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 mt-5">

                            <div class="form-check  col-md-12 col-12 text-right mt-5" style="margin-block: auto;">
                                <label class="form-check-label">
                                    <input class="form-check-input" name="status" type="checkbox" value="yes" {{ old('status', $getdataMain->status ?? '') == 'yes' ? 'checked' : '' }}>
                                    <span class="form-check-sign"></span>
                                    All Details Filled Successfully
                                </label>
                            </div>

                            <div class="col-sm-12 text-right mt-5">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
@endsection
