@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'studentregister',
])

@section('content')
    <style>
        .actionBtn {
            transition: transform 0.15s ease, background-color 0.3s ease;
        }

        .actionBtn:hover {
            transform: scale(0.90);
            /* background-color: #37b972 !important; */
            background-color: rgba(81, 203, 206 0.5) !important;
        }

        .header-shadow {
            box-shadow: 0 2px 4px rgba(122, 122, 123, 0.3);
        }

        .nav-item a {
            color: white;
        }

        .nav-pills-primary li {
            margin-left: 3px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease-in-out;
        }

        .nav-pills-primary li :hover {
            background-color: #b6b4b4;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        }


        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            /* background-color: #4a90e2; */
            color: #fff;
            padding: 10px;
            text-align: center;
            /* font-size: 24px; */
            font-weight: bold;
        }

        .details {
            width: 58%;
        }

        .info-section {
            display: flex;
            flex-wrap: wrap;
            /* gap: 20px; */
            margin-bottom: 20px;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
        }

        .details th,
        .details td {
            text-align: left;
            padding: 8px;
            font-size: .8rem;
            color: #333;

        }

        .details th {
            width: 40%;
            color: #4a90e2;
        }

        .details tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .photo {
            margin-top: 20px;
        }

        .photo img {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: scale(0.9);
            animation: fadeInScale 1.2s ease-out forwards 0.5s;
        }


        .nav-pills-primary li {
            background-color: gray;
            color: white;
        }

        @keyframes fadeInScale {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        h2 {
            font-size: 20px;
            color: #4a90e2;
            margin-bottom: 10px;
            border-bottom: 2px solid #4a90e2;
            display: inline-block;
        }

        .footer-section {
            margin-top: 20px;
        }

        .alltable tbody td {
            font-size: .8rem;
        }

        dl,
        ol,
        ul {
            margin-left: 2rem;
        }
    </style>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;Student Register</p>
                </div>
                <hr>
                <form id="searchForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date_range"> Date</label>
                                <input type="text" class="form-control" id="date_range" name="date_range" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="enroll_number">Enroll No.</label>
                                <input type="text" class="form-control" id="enroll_number" name="enroll_number" />
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="class_id">Current Class</label>
                                <select class="form-control" id="cur_class_id" name="cur_class_id">
                                    <option value="">Select Class</option>
                                    @foreach ($classMaster as $class)
                                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="">Select Type</option>
                                    <option value="Defence" @if ((isset($getdata->type) && $getdata->type == 'Defence') || old('type') == 'Defence') selected @endif>Defence
                                    </option>
                                    <option value="Civil Defence" @if ((isset($getdata->type) && $getdata->type == 'Civil Defence') || old('type') == 'Civil Defence') selected @endif>Civil
                                        Defence</option>
                                    <option value="ESM" @if ((isset($getdata->type) && $getdata->type == 'ESM') || old('type') == 'ESM') selected @endif>ESM</option>
                                    <option value="Civ Gov Employee" @if ((isset($getdata->type) && $getdata->type == 'Civ Gov Employee') || old('type') == 'Civ Gov Employee') selected @endif>Civ
                                        Gov Employee</option>
                                    <option value="Civilian" @if ((isset($getdata->type) && $getdata->type == 'Civilian') || old('type') == 'Civilian') selected @endif>Civilian
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="disability_id">Unique Disability</label>
                                <select class="form-control" id="disability_id" name="disability_id">
                                    <option value="">Select Disability</option>
                                    @foreach ($disabilityMatser as $disability)
                                        <option value="{{ $disability->id }}">{{ $disability->disability_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 text-right">
                            <button type="button" id="searchBtn" class="btn btn-primary actionBtn">
                                <div class="spinner-border spinner-border-sm text-white d-none " role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <span class="btn-text">{{ __('Search') }}</span>
                            </button>
                            <button type="button" id="clearBtn" class="btn btn-secondary actionBtn">Clear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card reporttable" style="display: none;">
            <div class="card-body">
                <div class="rp_table">
                    <table class="table table-bordered" id="studentsTable">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                {{-- <th>Session</th> --}}
                                {{-- <th>Date</th> --}}
                                <th>Photo</th>
                                <th>Enroll No.</th>
                                <th>Name</th>
                                {{-- <th>Admission Class</th> --}}
                                <th>Current Class</th>
                                {{-- <th>Type</th> --}}
                                {{-- <th>Father's Name</th> --}}
                                {{-- <th>Mother's Name</th> --}}
                                {{-- <th>State</th> --}}
                                {{-- <th>City</th> --}}
                                {{-- <th>Address</th> --}}
                                <th>Mobile</th>
                                {{-- <th>Gender</th> --}}
                                <th>DOB</th>
                                {{-- <th>Age</th> --}}
                                <th>Disability</th>
                                {{-- <th>Dis. Id</th> --}}
                                {{-- <th>Aadhar No.</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Student Details Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    {{-- <div class="modal-header">
                        <h6 class="modal-title">Student Details</h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div> --}}

                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="card content" style="min-height:100vh">
                            <div class="header">
                                <ul class="nav nav-pills nav-pills-primary" role="tablist" id="myTab">
                                    <li class="nav-item m-1">
                                        <a class="nav-link active student_byid" data-toggle="pill" href="#link1"
                                            role="tablist" data-id=""; id="general_info" style="font-size: .8rem; ">
                                            General Info
                                        </a>
                                    </li>
                                    @php
                                        $infotabs = [
                                            'Domain',
                                            'Therapy',
                                            'Extracurricular',
                                            'Documents',
                                            'Record Book',
                                        ];
                                        $link = 2;
                                    @endphp
                                    @foreach ($infotabs as $index => $tab)
                                        <li class="nav-item m-1">

                                            <a class="nav-link" data-toggle="tab" href="#link{{ $link++ }}"
                                                role="tablist" style="font-size: .8rem;">
                                                {{ $tab }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>

                           <div class="tab-content">
                                <div class="content tab-pane container active" id="link1">
                                    <div class="info-section row">
                                        <div class="details col-lg-8 col-8">
                                            <div class="card-header fw-bold p-1 px-3 mb-2 rounded-lg header-shadow ">
                                                <h6>General Information</h6>
                                            </div>
                                            <table>
                                                <tr>
                                                    <th>Enroll No.:</th>
                                                    <td>{{ $data->enroll_number ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Class:</th>
                                                    <td>{{ $data->cur_class->class_name ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Name:</th>
                                                    <td>{{ $data->student_name ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Age:</th>
                                                    <td>{{ $data->age ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Gender:</th>
                                                    <td>{{ $data->sex ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Date of Birth:</th>
                                                    <td>{{ $data->dob ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Mobile No.:</th>
                                                    <td>{{ $data->mobile ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Adhaar No.:</th>
                                                    <td>{{ $data->aadhar_no ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Address:</th>
                                                    <td>{{ $data->address ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Parent’s Name:</th>
                                                    <td>{{ $data->mothers_name ?? '' }} / {{ $data->fathers_name ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Type:</th>
                                                    <td>{{ $data->type ?? '' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="photo col-lg-4 col-4">
                                            <img class="img-fluid"
                                                src="{{ asset('student_documents/' . (isset($data->student_documents->image) && $data->student_documents->image ? $data->student_documents->image : 'No_image.jpg')) }}">
                                        </div>
                                    </div>
                                    <hr
                                        style="border: none; height: 2px; background: #ccc; box-shadow: 0 2px 4px rgba(24, 57, 244, 0.3); margin-top:2rem;">
                                    <div class="footer-section">
                                        <div class="card-header fw-bold p-1 px-3 mb-2 rounded-lg header-shadow">
                                            <h6>Medical Information</h6>
                                        </div>
                                        <div class="row  d-flex justify-content-start align-item-center px-2 "
                                            style="margin-top:8px; padding:15.5px">
                                            <div class="col-lg-4 col-6 border p-2 ">
                                                <h6 class="px-2" style="color: #007bff; font-size: .8rem;">Disability
                                                    Type</h6>
                                            </div>
                                            @php
                                                $disabilities_arr = $data->student_disability->pluck('disability_id');
                                                $disabilities = $disabilitymaster
                                                    ->whereIn('id', $disabilities_arr ?? [])
                                                    ->pluck('disability_name')
                                                    ->implode(', ');
                                            @endphp
                                            <div class="col-lg-8 col-6 border p-2 ">
                                                <h6 class="px-2" style="color:#414141; font-size: .8rem;">
                                                    {{ $disabilities ?? '' }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="tab-pane container fade" id="link2">
                                    <div class="footer-section">
                                        <div class="card-header fw-bold p-1 px-3 mb-2 rounded-lg header-shadow">
                                            <h6>Classwise Individual Educational Plan</h6>
                                        </div>
                                        @foreach ($domains as $item)
                                            <div class="row col-lg-6 d-flex justify-content-start align-item-center "
                                                style="margin-top:8px; padding:15.5px">
                                                <div class="col-6 border p-2 text-center"
                                                    style="background-color:#7272f2;">
                                                    <h6 style="color:white; font-weight:900;">Class Name</h6>
                                                </div>
                                                <div class="col-6 border p-2 text-center"
                                                    style="background-color:lavender;">
                                                    <h6 style="color:black">{{ $item->first()->class->class_name ?? '' }}
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="domain_table">
                                                <table class="table table-bordered alltable" id="example">
                                                    <thead class="text-primary">
                                                        <tr>
                                                            <th style="text-align: center; width: 30%;">Educational Plan
                                                            </th>
                                                            <th style="text-align: center;">Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($item as $domain)
                                                            <tr>
                                                                <td class="text-center">{{ $domain->domain_name ?? 'NA' }}
                                                                </td>
                                                                <td class="text-left">{!! $domain->description ?? 'NA' !!}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr
                                                style="border: none; height: 2px; background: #ccc; box-shadow: 0 2px 4px rgba(24, 57, 244, 0.3); margin-top:2rem;">
                                        @endforeach
                                    </div>
                                </div> --}}
                                {{-- <div class="tab-pane container fade" id="link3">
                                    <div class="footer-section">
                                        <div class="card-header fw-bold p-1 px-3 mb-2 rounded-lg header-shadow">
                                            <h6>Classwise Therapy Information</h6>
                                        </div>
                                        @foreach ($therapies as $item)
                                            <div class="row col-lg-6 d-flex justify-content-start align-item-center "
                                                style="margin-top:8px; padding:15.5px">
                                                <div class="col-6 border p-2 text-center"
                                                    style="background-color:#7272f2;">
                                                    <h6 style="color:white; font-weight:900;">Class Name</h6>
                                                </div>
                                                <div class="col-6 border p-2 text-center"
                                                    style="background-color:lavender;">
                                                    <h6 style="color:black">{{ $item->first()->class->class_name ?? '' }}
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="domain_table">
                                                <table class="table table-bordered alltable" id="example">
                                                    <thead class="text-primary">
                                                        <tr>
                                                            <th style="text-align: center; width: 20%;">Therapy</th>
                                                            <th style="text-align: center;">Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($item as $therapy)
                                                            <tr>
                                                                <td class="text-center">
                                                                    {{ $therapy->therapy_name ?? 'NA' }}</td>
                                                                <td class="text-left ">{!! $therapy->description ?? 'NA' !!}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr
                                                style="border: none; height: 2px; background: #ccc; box-shadow: 0 2px 4px rgba(24, 57, 244, 0.3); margin-top:2rem;">
                                        @endforeach
                                    </div>

                                </div> --}}

                                {{-- <div class="tab-pane container fade" id="link4">
                                    <div class="footer-section">
                                        <div class="card-header fw-bold p-1 px-3 mb-2 rounded-lg header-shadow">
                                            <h6>Extracurricular Activities</h6>
                                        </div>
                                        <div class="row col-lg-6 d-flex justify-content-start align-item-center "
                                            style="margin-top:8px; padding:15.5px">
                                            <div class="col-6 border p-2 text-center" style="background-color:#7272f2;">
                                                <h6 style="color:white; font-weight:900;">Class Name</h6>
                                            </div>
                                            <div class="col-6 border p-2 text-center" style="background-color:lavender;">
                                                <h6 style="color:black">{{ $data->cur_class->class_name ?? '' }}</h6>
                                            </div>
                                        </div>
                                        <div class="domain_table">
                                            <table class="table table-bordered alltable" id="example">
                                                <thead class="text-primary">
                                                    <tr>
                                                        <th style="text-align: center; width: 20%;">Activities</th>
                                                        <th style="text-align: center;">Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">Vocational & Skill Training</td>
                                                        <td class="text-left ">{!! $data->vocational_and_skill_training ?? 'NA' !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">Special Achievements</td>
                                                        <td class="text-left ">{!! $data->special_achievements ?? 'NA' !!}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr
                                            style="border: none; height: 2px; background: #ccc; box-shadow: 0 2px 4px rgba(24, 57, 244, 0.3); margin-top:2rem;">

                                    </div>

                                </div> --}}


                                {{-- <div class="tab-pane container fade" id="link5">
                                    <div class="footer-section">
                                        <div class="card-header fw-bold p-1 px-3 mb-2 rounded-lg header-shadow">
                                            <h6 class="">Child Documents</h6>
                                        </div>
                                    </div>
                                    <div class="container d-flex justify-content-between align-item-center row">
                                        <div class="footer-section col-lg-6 col-12">
                                            <div class="card-header fw-bold p-1 px-3 mb-2 rounded-lg header-shadow">
                                                <h6>UDID Certificate</h6>
                                            </div>
                                            <div class="photo" style="width:auto;">
                                                <a href="{{ asset('student_documents/' . ($data->student_documents->udid_certificate_image ?? 'No_image.jpg')) }}"
                                                    target="_blank">
                                                    <img style="height: 200px; width:100%;"
                                                        src="{{ asset('student_documents/' . (isset($data->student_documents->udid_certificate_image) && $data->student_documents->udid_certificate_image ? $data->student_documents->udid_certificate_image : 'No_image.jpg')) }}">
                                                </a>
                                            </div>
                                            <hr
                                                style="border: none; height: 2px; background: #ccc; box-shadow: 0 2px 4px rgba(24, 57, 244, 0.3); margin-top:2rem;">
                                        </div>
                                        <div class="footer-section col-lg-6 col-12">
                                            <div class="card-header fw-bold p-1 px-3 mb-2 rounded-lg header-shadow">
                                                <h6>Adhaar Card</h6>
                                            </div>
                                            <div class="photo" style="width:auto;">
                                                <a href="{{ asset('student_documents/' . ($data->student_documents->aadhar_image ?? 'No_image.jpg')) }}"
                                                    target="_blank">
                                                    <img style="height: 200px; width:100%;"
                                                        src="{{ asset('student_documents/' . (isset($data->student_documents->aadhar_image) && $data->student_documents->aadhar_image ? $data->student_documents->aadhar_image : 'No_image.jpg')) }}">
                                                </a>
                                            </div>
                                            <hr
                                                style="border: none; height: 2px; background: #ccc; box-shadow: 0 2px 4px rgba(24, 57, 244, 0.3); margin-top:2rem;">
                                        </div>
                                        <div class="footer-section col-lg-6 col-12">
                                            <div class="card-header fw-bold p-1 px-3 mb-2 rounded-lg header-shadow">
                                                <h6>Birth Certificate</h6>
                                            </div>
                                            <div class="photo" style="width:auto;">
                                                <a href="{{ asset('student_documents/' . ($data->student_documents->birth_certificate_image ?? 'No_image.jpg')) }}"
                                                    target="_blank">
                                                    <img style="height: 200px; width:100%;"
                                                        src="{{ asset('student_documents/' . (isset($data->student_documents->birth_certificate_image) && $data->student_documents->birth_certificate_image ? $data->student_documents->birth_certificate_image : 'No_image.jpg')) }}">
                                                </a>
                                            </div>
                                            <hr
                                                style="border: none; height: 2px; background: #ccc; box-shadow: 0 2px 4px rgba(24, 57, 244, 0.3); margin-top:2rem;">
                                        </div>
                                       
                                        <div class="footer-section col-lg-6 col-12">
                                            <div class="card-header fw-bold p-1 px-3 mb-2 rounded-lg header-shadow">
                                                <h6>Disability Certificate</h6>
                                            </div>
                                            <div class="photo" style="width:auto;">
                                                <a href="{{ asset('student_documents/' . ($data->student_documents->disability_certificate_image ?? 'No_image.jpg')) }}"
                                                    target="_blank">
                                                    <img style="height: 200px; width:100%;"
                                                        src="{{ asset('student_documents/' . (isset($data->student_documents->disability_certificate_image) && $data->student_documents->disability_certificate_image ? $data->student_documents->disability_certificate_image : 'No_image.jpg')) }}">
                                                </a>
                                            </div>
                                            <hr
                                                style="border: none; height: 2px; background: #ccc; box-shadow: 0 2px 4px rgba(24, 57, 244, 0.3); margin-top:2rem;">
                                        </div>
                                        <div class="footer-section col-lg-6 col-12">
                                            <div class="card-header fw-bold p-1 px-3 mb-2 rounded-lg header-shadow">
                                                <h6>Medical Certificate</h6>
                                            </div>
                                            <div class="photo" style="width:auto;">
                                                <a href="{{ asset('student_documents/' . ($data->student_documents->medical_certificate_image ?? 'No_image.jpg')) }}"
                                                    target="_blank">
                                                    <img style="height: 200px; width:100%;"
                                                        src="{{ asset('student_documents/' . (isset($data->student_documents->medical_certificate_image) && $data->student_documents->medical_certificate_image ? $data->student_documents->medical_certificate_image : 'No_image.jpg')) }}">
                                                </a>
                                            </div>
                                            <hr
                                                style="border: none; height: 2px; background: #ccc; box-shadow: 0 2px 4px rgba(24, 57, 244, 0.3); margin-top:2rem;">
                                        </div>

                                        <div class="footer-section col-lg-6 col-12">
                                            <div class="card-header fw-bold p-1 px-3 mb-2 rounded-lg header-shadow">
                                                <h6>Transfer Certificate</h6>
                                            </div>
                                            <div class="photo" style="width:auto;">
                                                <a href="{{ asset('student_documents/' . ($data->student_documents->transfer_certificate_image ?? 'No_image.jpg')) }}"
                                                    target="_blank">
                                                    <img style="height: 200px; width:100%;"
                                                        src="{{ asset('student_documents/' . (isset($data->student_documents->transfer_certificate_image) && $data->student_documents->transfer_certificate_image ? $data->student_documents->transfer_certificate_image : 'No_image.jpg')) }}">
                                                </a>
                                            </div>
                                            <hr
                                                style="border: none; height: 2px; background: #ccc; box-shadow: 0 2px 4px rgba(24, 57, 244, 0.3); margin-top:2rem;">
                                        </div>
                                    </div>

                                </div> --}}
                                {{-- <div class="tab-pane container fade" id="link6">
                                    <div class="footer-section">
                                        <div class="card-header fw-bold p-1 px-3 mb-2 rounded-lg header-shadow">
                                            <h6>Student Record Book</h6>
                                        </div>

                                        <div class="pdf-container"
                                            style="position: relative; width: 100%; height: 0; padding-bottom: 141%; /* 100% / aspect ratio */">
                                            <iframe src="{{ asset('student_pdfs/student_record_book.pdf') }}"
                                                style="position: absolute; top:0; left:0; width:100%; height:100%; border:none;"
                                                allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                </div> --}}

                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.reporttable').hide();
                let dataTable = null;

                $('#searchBtn').click(function() {
                    var $btn = $(this).find('.spinner-border');
                    $('.spinner-border').removeClass('d-none');
                    $('#searchBtn').find('.btn-text').text('Signing in...');
                    let dateRange = $('#date_range').val();
                    let dates = dateRange ? dateRange.split(' to ') : [];
                    let studentRoute = "{{ route('studentdetailsbyid', ['id' => ':id']) }}";
                    let formData = $('#searchForm').serializeArray();
                    formData.push({
                        name: 'start_date',
                        value: dates[0] || ''
                    });
                    formData.push({
                        name: 'end_date',
                        value: dates[1] || ''
                    });

                    $.ajax({
                        url: "{{ route('studentregister.fetch') }}",
                        method: "POST",
                        data: formData,
                        success: function(response) {
                            $('.spinner-border').addClass('d-none');
                            $('#searchBtn').find('.btn-text').text('Search');
                            let tbody = $('#studentsTable tbody');
                            tbody.empty();
                            $('.reporttable').show();
                            let baseUrl = "{{ asset('student_documents') }}/";
                            if (response.length > 0) {
                                $.each(response, function(index, data) {
                                    let studentUrl = studentRoute.replace(':id', data.id);
                                    let row = `
                                    <tr>
                                        <td>${index+1}</td>
                                        <td><img src="${baseUrl}${data.student_documents?.image || 'child_profile_pic.jpg'}" style="width: 50px;"></td>
                          {{-- <td>${data.session ?? 'NA'}</td> --}}
                            {{-- <td>${data.admission_date ?? 'NA'}</td>  --}}
                            <td>${data.enroll_number ?? 'NA'}</td>
                            <td>${data.student_name ?? 'NA'}</td>
                            {{-- <td>${data.adm_class ? data.adm_class.class_name : 'NA'}</td> --}}
                            <td>${data.cur_class ? data.cur_class.class_name : 'NA'}</td>
                            {{-- <td>${data.type ?? 'NA'}</td>  --}}
                             {{-- <td>${data.fathers_name ?? 'NA'}</td>   --}}
                            {{-- <td>${data.mothers_name ?? 'NA'}</td>  --}}
                           {{-- <td>${data.state ? data.state.state_name : 'NA'}</td>  --}}
                           {{--  <td>${data.city ? data.city.city_name : 'NA'}</td> --}}
                            {{-- <td>${data.address ?? 'NA'}</td>  --}}
                            <td>${data.mobile ?? 'NA'}</td>
                            {{-- <td>${data.sex ?? 'NA'}</td> --}}
                            <td>${data.dob ?? 'NA'}</td>
                           {{-- <td>${data.age ?? 'NA'}</td>  --}}
                          <td> ${   data.student_disability && data.student_disability.length > 0
                                    ? data.student_disability.map(d => d.disability.disability_name).join(', ')
                                    : 'NA'
                                }
                                </td>

                            {{-- <td>${data.aadhar_no ?? 'NA'}</td> --}}
                            <td class="not-export text-center viewdetail">
                                       {{-- <a href="${studentUrl}" class="text-primary" data-toggle="tooltip" title="View Full Details">                                           
                                            <i class="fa fa-eye"></i> 
                                        </a>&nbsp; --}}
                                        <button class="btn btn-primary view_button"  data-toggle="modal" data-target="#myModal" data-id="${data.id}" >                                           
                                            <i class="fa fa-eye"  data-toggle="tooltip" title="View Full Details"></i> 
                                        </button>&nbsp; 
                            </td>
                        </tr>
                    `;
                                    tbody.append(row);
                                });

                                if ($.fn.dataTable.isDataTable('#studentsTable')) {
                                    dataTable.clear().draw();
                                }
                                // else {
                                //     dataTable = $('#studentsTable').DataTable({
                                //         dom: 'Bfrtip',
                                //         buttons: [{
                                //                 extend: 'excel',
                                //                 text: 'Download Excel',
                                //                 title: function() {
                                //                     let startDate = dates[0] || '';
                                //                     let endDate = dates[1] || '';
                                //                     return `Student Register From : ${startDate} To : ${endDate}`;
                                //                 },
                                //             },
                                //             {
                                //                 extend: 'pdf',
                                //                 text: 'Download PDF',
                                //                 title: function() {
                                //                     let startDate = dates[0] || '';
                                //                     let endDate = dates[1] || '';
                                //                     return `Student Register From : ${startDate} To : ${endDate}`;
                                //                 },
                                //                 orientation: 'landscape',
                                //                 pageSize: 'A4',
                                //                 customize: function(doc) {

                                //                     doc.content[1].table.widths = ['6%', '6%', '6%', '6%', '6%', '6%', '6%', '6%', '6%', '6%', '6%', '6%', '6%', '6%', '6%', '6%','6%'];
                                //                     let tableRows = doc.content[1].table.body;
                                //                     tableRows.forEach(function(row) {
                                //                         if (row.length > 17) {
                                //                             row.splice(17, 1);
                                //                         }
                                //                     });
                                //                     doc.styles = {
                                //                         tableHeader: {
                                //                             bold: true,
                                //                             fontSize: 12,
                                //                             color: 'black',
                                //                             alignment: 'center',
                                //                             fillColor: '#f2f2f2',
                                //                         },
                                //                         tableCell: {
                                //                             fontSize: 10,
                                //                         }
                                //                     };

                                //                     doc.pageMargins = [20, 20, 20, 20];
                                //                 }
                                //             }
                                //         ],
                                //         paging: false,
                                //         responsive: true,
                                //         searching: false,
                                //         lengthChange: false,
                                //     });

                                // }
                            } else {
                                tbody.append(
                                    '<tr><td colspan="18" class="text-center">No records found</td></tr>'
                                );
                                if ($.fn.dataTable.isDataTable('#studentsTable')) {
                                    dataTable.clear().destroy();
                                }
                            }
                        }
                    });
                });

                $('#clearBtn').click(function() {
                    $('#date_range').val('');
                    $('#searchForm')[0].reset();
                    $('#studentsTable tbody').empty();
                    $('.reporttable').hide();
                    $('#date_range').data('daterangepicker').setStartDate(moment().startOf('day'));
                    $('#date_range').data('daterangepicker').setEndDate(moment().endOf('day'));
                });
            });
        </script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script>
            $('body').tooltip({
                selector: '[data-toggle="tooltip"]'
            });
        </script>
        <script>
            $(document).on('click', '.view_button', function() {
                var studentId = $(this).data('id');
                let base_url = "{{ route('studentdetailsbyid', ['id' => ':id']) }}";
                let url = base_url.replace(':id', studentId);

                $.ajax({
                    url: url,
                    method: 'get',
                    success: function(response) {
                        console.log("response");
                        console.log(response);
                    },
                    error: function(xhr) {
                        alert('Something went wrong');
                    }
                })
            })
        </script>
    @endpush
@endsection
