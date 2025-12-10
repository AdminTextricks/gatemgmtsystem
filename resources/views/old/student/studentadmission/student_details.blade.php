<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
    <title>Student Information</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        body {
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 800px;
        }

        .header {
            /* background-color: #4a90e2; */
            color: #fff;
            padding: 10px;
            text-align: center;
            /* font-size: 24px; */
            font-weight: bold;
        }

        .content {
            padding: 20px;
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
</head>

<body>    
    <div class="card content" style="min-height:100vh">
        {{-- <div class="header">
            <ul class="nav nav-pills nav-pills-primary" role="tablist" id="myTab">
                <li class="nav-item m-1">
                    <a class="nav-link active student_byid" data-toggle="pill" href="#link1" role="tablist"
                        data-id=""; id="general_info" style="font-size: .8rem; ">
                        General Info
                    </a>
                </li>
                @php
                    $infotabs = ['Domain', 'Therapy', 'Extracurricular', 'Documents', 'Record Book'];
                    $link = 2;
                @endphp
                @foreach ($infotabs as $index => $tab)
                    <li class="nav-item m-1">

                        <a class="nav-link" data-toggle="tab" href="#link{{ $link++ }}" role="tablist"
                            style="font-size: .8rem;">
                            {{ $tab }}
                        </a>
                    </li>
                @endforeach
            </ul>

        </div> --}}

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
                                <td>{{ $data->c_address ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>Parent’s Name:</th>
                                <td>{{ $data->mothers_name ?? '' }} / {{ $data->fathers_name ?? '' }}</td>
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
                        <!-- <img src="image.png" alt="Student Photo"> -->
                    </div>
                </div>
                <hr
                    style="border: none; height: 2px; background: #ccc; box-shadow: 0 2px 4px rgba(24, 57, 244, 0.3); margin-top:2rem;">
                <div class="footer-section">
                    <div class="card-header fw-bold p-1 px-3 mb-2 rounded-lg header-shadow">
                        <h6>Medical Information</h6>
                    </div>
                    {{-- <p>Unique Disability: {{ $data->disability->disability_name }}</p> --}}
                    <div class="row  d-flex justify-content-start align-item-center px-2 "
                        style="margin-top:8px; padding:15.5px">
                        <div class="col-lg-4 col-6 border p-2 ">
                            <h6 class="px-2" style="color: #007bff; font-size: .8rem;">Disability Type</h6>
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
                            <div class="col-6 border p-2 text-center" style="background-color:#7272f2;">
                                <h6 style="color:white; font-weight:900;">Class Name</h6>
                            </div>
                            <div class="col-6 border p-2 text-center" style="background-color:lavender;">
                                <h6 style="color:black">{{ $item->first()->class->class_name ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="domain_table">
                            <table class="table table-bordered alltable" id="example">
                                <thead class="text-primary">
                                    <tr>
                                        <th style="text-align: center; width: 30%;">Educational Plan</th>
                                        <th style="text-align: center;">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item as $domain)
                                        <tr>
                                            <td class="text-center">{{ $domain->domain_name ?? 'NA' }}</td>
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
                            <div class="col-6 border p-2 text-center" style="background-color:#7272f2;">
                                <h6 style="color:white; font-weight:900;">Class Name</h6>
                            </div>
                            <div class="col-6 border p-2 text-center" style="background-color:lavender;">
                                <h6 style="color:black">{{ $item->first()->class->class_name ?? '' }}</h6>
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
                                            <td class="text-center">{{ $therapy->therapy_name ?? 'NA' }}</td>
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
                            <h6>CMO Certificate</h6>
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
                       <iframe src="{{ asset('recordbook/student_record_book.pdf') }}"
                            style="position: absolute; top:0; left:0; width:100%; height:100%; border:none;"
                            allowfullscreen>
                        </iframe>
                       
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
    </div>
    {{-- <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> --}}
</body>

</html>
