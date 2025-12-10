@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'progressreport',
])

@section('content')
    <style>
        .table .thead-light th {
            border: 1px solid lightgray;
        }
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
                    <p class="h6 mt-0 pt-0" style="text-transform: capitalize; font-weight: 600;">Asha School Progress
                        Report </p>
                    <p class="h6 mt-0 pt-0" style="text-transform: capitalize; font-weight: 600;">Year
                        (<input type="text" class="form-control-sm d-inline-block border-0" name="progress_report_year"
                            placeholder="Enter Year" style="text-align: center; width: 100px;"
                            value="{{ isset($getdataMain->progress_report_year) ? $getdataMain->progress_report_year : '' }}{{ old('progress_report_year') }}" />)
                    </p>
                </div>
                <form action="{{ route('progressreport.action', ['action' => $action]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-4" style="margin: auto;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" style="font-weight:600; color:black;">Name:</label>
                                <input type="text" class="form-control-sm d-inline-block border-0"
                                    value="{{ isset($student->student_name) ? strToUpper($student->student_name) : '' }}"
                                    disabled />
                                <input type="hidden" name="student_admissions_id" id="student_admissions_id"
                                    value="{{ isset($student->id) ? $student->id : '' }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="class" style="font-weight:600; color:black;">Class:</label>
                                <input type="text" class="form-control-sm d-inline-block border-0"
                                    value="{{ isset($student->cur_class->class_name) ? $student->cur_class->class_name : '' }}"
                                    disabled />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age" style="font-weight:600; color:black;">Age:</label>
                                <input type="text" class="form-control-sm d-inline-block border-0 text-dark"
                                    value="{{ isset($student->age) ? $student->age : '' }}" disabled />
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2 mb-4" style="margin: auto;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="age" style="font-weight:600; color:black;">Pen picture of the
                                    student</label>
                                <textarea class="form-control" row="4" name="pen_picture" placeholder="Enter your Pen picture here...">{{ isset($getdataMain->pen_picture) ? $getdataMain->pen_picture : '' }}{{ old('pen_picture') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top:3rem;">
                    <div class="row text-center mt-2">
                        <div class="col-md-12">
                            <p class="h6 mt-0 pt-0" style="text-transform: capitalize; font-weight: 600;">Annual Record for
                                the Year
                                (<input type="text" class="form-control-sm d-inline-block border-0"
                                    id="progress_report_year" name="progress_report_year" placeholder="Enter Year"
                                    style="text-align: center; width: 100px;"
                                    value="{{ isset($getdataMain->progress_report_year) ? $getdataMain->progress_report_year : '' }}{{ old('progress_report_year') }}" />)
                            </p>
                        </div>
                    </div>
                    <div class="row mt-4" style="margin: auto;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dates_of_assessment" style="font-weight:600; color:black;">Dates of
                                    Assessment:</label>
                                <input type="date" class="form-control-sm d-inline-block border-0"
                                    id="dates_of_assessment" name="dates_of_assessment"
                                    placeholder=".............................."
                                    value="{{ old('dates_of_assessment', $getdataMain->dates_of_assessment ?? '') }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="baseline" style="font-weight:600; color:black;">Baseline:</label>
                                <input type="text" class="form-control-sm d-inline-block border-0" id="baseline"
                                    name="baseline" placeholder=".............................."
                                    value="{{ old('baseline', $getdataMain->baseline ?? '') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2" style="margin: auto;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_qtr" style="font-weight:600; color:black;">1st Qtr:</label>
                                <input type="text" class="form-control-sm d-inline-block border-0" id="first_qtr"
                                    name="first_qtr" placeholder=".............................."
                                    value="{{ old('first_qtr', $getdataMain->first_qtr ?? '') }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="second_qtr" style="font-weight:600; color:black;">2nd Qtr:</label>
                                <input type="text" class="form-control-sm d-inline-block border-0" id="second_qtr"
                                    name="second_qtr" placeholder=".............................."
                                    value="{{ old('second_qtr', $getdataMain->second_qtr ?? '') }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="third_qtr" style="font-weight:600; color:black;">3rd Qtr:</label>
                                <input type="text" class="form-control-sm d-inline-block border-0" id="third_qtr"
                                    name="third_qtr" placeholder=".............................."
                                    value="{{ old('third_qtr', $getdataMain->third_qtr ?? '') }}" />
                            </div>
                        </div>
                    </div>
                    {{-- start progress report table --}}

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th rowspan="2">S.No</th>
                                    <th rowspan="2">Domain</th>
                                    <th rowspan="2">No of<br>activities<br>assessed</th>
                                    <th rowspan="2">Maxm<br>Score</th>
                                    <th colspan="2">Baseline</th>
                                    <th colspan="2">1<sup>st</sup> Qtr</th>
                                    <th colspan="2">2<sup>nd</sup> Qtr</th>
                                    <th colspan="2">3<sup>rd</sup> Qtr</th>
                                </tr>
                                <tr>
                                    <th>Score</th>
                                    <th>%</th>
                                    <th>Score</th>
                                    <th>%</th>
                                    <th>Score</th>
                                    <th>%</th>
                                    <th>Score</th>
                                    <th>%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $domains = [
                                        'Motor (M)',
                                        'Personal (P)',
                                        'Social (S)',
                                        'Language (L)',
                                        'Number Time Money & Measurement (N)',
                                        'Environmental',
                                        'Science and',
                                        'Awareness (EVS)',
                                        'Occupational & Vocational (OV)',
                                        '<b>Total<b>',
                                    ];
                                @endphp

                                @foreach ($domains as $index => $domain)
                                    <tr>
                                        @if ($index > 8)
                                            <td name="domain" id="" colspan="2" class="text-center">
                                                {!! $domain !!}</td>
                                        @else
                                            <td>0{{ $index + 1 }}</td>
                                            <td name="domain" id="">{!! $domain !!}</td>
                                        @endif
                                        <td><input type="text"
                                                name="domain[{{ $domain }}][no_of_activities_assessed]"
                                                value="{{ old('domain.' . $domain . '.no_of_activities_assessed', $getdataReport ? $getdataReport[$domain]['no_of_activities_assessed'] : '') }}"
                                                class="form-control"></td>
                                        <td><input type="text" name="domain[{{ $domain }}][maxm_score]"
                                                value="{{ old('domain.' . $domain . '.maxm_score', $getdataReport ? $getdataReport[$domain]['maxm_score'] : '') }}"
                                                class="form-control"></td>
                                        <td><input type="text" name="domain[{{ $domain }}][baseline_score]"
                                                value="{{ old('domain.' . $domain . '.baseline_score', $getdataReport ? $getdataReport[$domain]['baseline_score'] : '') }}"
                                                class="form-control"></td>
                                        <td><input type="text" name="domain[{{ $domain }}][baseline_percentage]"
                                                value="{{ old('domain.' . $domain . '.baseline_percentage', $getdataReport ? $getdataReport[$domain]['baseline_percentage'] : '') }}"
                                                class="form-control"></td>
                                        <td><input type="text" name="domain[{{ $domain }}][first_qtr_score]"
                                                value="{{ old('domain.' . $domain . '.first_qtr_score', $getdataReport ? $getdataReport[$domain]['first_qtr_score'] : '') }}"
                                                class="form-control"></td>
                                        <td><input type="text"
                                                name="domain[{{ $domain }}][first_qtr_percentage]"
                                                value="{{ old('domain.' . $domain . '.first_qtr_percentage', $getdataReport ? $getdataReport[$domain]['first_qtr_percentage'] : '') }}"
                                                class="form-control"></td>
                                        <td><input type="text" name="domain[{{ $domain }}][second_qtr_score]"
                                                value="{{ old('domain.' . $domain . '.second_qtr_score', $getdataReport ? $getdataReport[$domain]['second_qtr_score'] : '') }}"
                                                class="form-control"></td>
                                        <td><input type="text"
                                                name="domain[{{ $domain }}][second_qtr_percentage]"
                                                value="{{ old('domain.' . $domain . '.second_qtr_percentage', $getdataReport ? $getdataReport[$domain]['second_qtr_percentage'] : '') }}"
                                                class="form-control"></td>
                                        <td><input type="text" name="domain[{{ $domain }}][third_qtr_score]"
                                                value="{{ old('domain.' . $domain . '.third_qtr_score', $getdataReport ? $getdataReport[$domain]['third_qtr_score'] : '') }}"
                                                class="form-control"></td>
                                        <td><input type="text"
                                                name="domain[{{ $domain }}][third_qtr_percentage]"
                                                value="{{ old('domain.' . $domain . '.third_qtr_percentage', $getdataReport ? $getdataReport[$domain]['third_qtr_percentage'] : '') }}"
                                                class="form-control">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- end progress report table --}}

                    {{-- Start Curricular domain table --}}
                    <hr class="custom-shadow" style="margin-top:2px; ">
                    <div class="row text-center " style="margin-top:2.5rem; ">
                        <div class="col-md-12">
                            <p class="h6 mt-0 pt-0" style="text-transform: capitalize; font-weight: 600;">
                                Grades for Co-Curricular Domain
                            </p>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th rowspan="2">S No</th>
                                    <th rowspan="2">Domain</th>
                                    <th rowspan="2">No of<br>activities<br>assessed</th>
                                    <th colspan="4">Final Grade </th>

                                </tr>
                                <tr>
                                    <th>Baseline</th>
                                    <th>1<sup>st</sup> Qtr</th>
                                    <th>2<sup>nd</sup> Qtr</th>
                                    <th>3<sup>rd</sup> Qtr</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01</td>
                                    <td name="domain" id="domain_co_curricular">Co-Curricular</td>
                                    <td><input type="text" name="Co-Curricular[no_of_activities_assessed]"
                                            value="{{ old('Co-Curricular.no_of_activities_assessed', $getdataReportCur ? $getdataReportCur['no_of_activities_assessed'] : '') }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="Co-Curricular[baseline]" class="form-control"
                                            value="{{ old('Co-Curricular.baseline', $getdataReportCur ? $getdataReportCur['baseline'] : '') }}">
                                    </td>
                                    <td><input type="text" name="Co-Curricular[first_qtr]" class="form-control"
                                            value="{{ old('Co-Curricular.first_qtr', $getdataReportCur ? $getdataReportCur['first_qtr'] : '') }}">
                                    </td>
                                    <td><input type="text" name="Co-Curricular[second_qtr]"
                                            value="{{ old('Co-Curricular.second_qtr', $getdataReportCur ? $getdataReportCur['second_qtr'] : '') }}"class="form-control">
                                    </td>
                                    <td><input type="text" name="Co-Curricular[third_qtr]"
                                            value="{{ old('Co-Curricular.third_qtr', $getdataReportCur ? $getdataReportCur['third_qtr'] : '') }}"class="form-control">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- end Curricular domain table --}}
                    {{-- <hr class="custom-shadow" style="margin-top:2px; "> --}}
                    <div class="row text-center " style="margin-top:2.5rem; ">
                        <div class="col-md-12">
                            <p class="h6 mt-0 pt-0"
                                style="text-transform: capitalize; font-weight: 600; font-style: italic; width:80%; margin:auto;">
                                GRADES: A- Takes initiative and participates effectively; B- Participates effectively
                                when someone else initiates; C- Involves self but is not aware of rules/does not
                                cooperate; D- Observes with interest; E- Not Interested; NE- No exposure
                            </p>
                        </div>
                    </div>

                    <hr class="custom-shadow" style="margin-top:20px;">
                    <div class="row text-center " style="margin-top:2.5rem; ">
                        <div class="col-md-12">
                            <p class="h6 mt-0 pt-0" style="text-transform: capitalize; font-weight: 600;">
                                Concluding Remarks
                            </p>
                        </div>
                    </div>
                    <div class="row mt-2 mb-4" style="margin: auto;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="age" style="font-weight:600; color:black;">Teacher:</label>
                                <textarea class="form-control" row="4" name="teacher_remarks"
                                    placeholder="Enter your Teacher's Remarks  here...">{{ isset($getdataMain->teacher_remarks) ? $getdataMain->teacher_remarks : '' }}{{ old('teacher_remarks') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 mb-4" style="margin: auto;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="age" style="font-weight:600; color:black;">Principal:</label>
                                <textarea class="form-control" row="4" name="principal_remarks"
                                    placeholder="Enter your Principal's Remarks here...">{{ isset($getdataMain->principal_remarks) ? $getdataMain->principal_remarks : '' }}{{ old('principal_remarks') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center " style="margin-top:2.5rem; ">
                        <div class="col-md-4">
                            <p class="h6 mt-0 pt-0" style="text-transform: capitalize; font-weight: 600;">
                                Teacher’s Signature
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p class="h6 mt-0 pt-0" style="text-transform: capitalize; font-weight: 600;">
                                Principal’s Signature
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p class="h6 mt-0 pt-0" style="text-transform: capitalize; font-weight: 600;">
                                Parent’s Signature
                            </p>
                        </div>
                    </div>

                    {{-- end progress report table --}}

                    <div class="form-group d-flex justify-content-end align-item-center mt-5">
                        <div class="form-check  col-md-3 col-3 text-right" style="margin-block: auto;">
                            <label class="form-check-label">
                                <input class="form-check-input" name="status" type="checkbox" value="yes"
                                    {{ old('status', $getdataMain->status ?? '') == 'yes' ? 'checked' : '' }}>
                                <span class="form-check-sign"></span>
                                All Details Filled Successfully
                            </label>
                        </div>
                        <div class="col-md-3 col-3 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                    {{-- </div> --}}
                </form>
            </div>
        </div>
    </div>
@endsection
