<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Asha School Progress Report</title>
    <style>
        @page {
            margin: 0cm;
            padding: 0cm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            line-height: 1.4;
            margin: 40px;
        }

        .text-center {
            text-align: center;
        }

        .title {
            font-weight: 600;
            text-transform: capitalize;
            font-size: 16px;
        }

        .year {
            font-weight: 600;
        }

        ol.content-list {
            font-weight: bold;
            font-size: 14px;
            margin-left: 25px;
            margin-top: 50px;
            line-height: 2;
        }

        ol.content-list li {
            margin-bottom: 5px;
        }

        .info-line {
            width: 100%;
            margin-top: 15px;
            font-size: 13px;
        }

        .info-line div {
            display: inline-block;
            margin-left: 10%;
            margin-right: 10%;
        }

        .section-title {
            margin-top: 20px;
            text-decoration: underline;
            font-weight: 600;
            text-transform: capitalize;
            font-size: 16px;
        }


        .assessment {
            margin: auto;
            margin-top: 20px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: center;
            font-size: 12px;
        }

        .section {
            margin-bottom: 8px;
        }
       
    </style>
</head>

<body>

    <!--Page-1 Header -->
    <div style="width: 100%; text-align: center; margin: 0; padding: 0;">
        <img src="{{ public_path('student_documents/record_book/record_book_page-1.jpg') }}" alt="Record Book Page"
            style="width: 100%; height: 100vh; object-fit: contain; margin: 0; padding: 0;">
    </div>

    <div style="page-break-before: always;"></div>

    <!--Page-2 Header -->
    <div class="text-center">
        <a href="#" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ public_path('paper/img/logo.png') }}" style="width: 10%;">
            </div>
        </a>
        <p class="title" style="text-decoration: underline; margin-bottom:0px;">STUDENT RECORD BOOK</p>
    </div>

    <div style="width: 100%; text-align: center; margin-bottom: 15px; margin-top: 100px;">
        <img src="{{ public_path('student_documents/' . (optional($student->student_documents)->image ?? 'child_profile_pic')) }}"
            alt="Profile Photo" style="width: 200px; height: 200px; border-radius: 20%; object-fit: cover;">
    </div>

    <div style="width:100%; margin-top:40px;">
        <div style="display:inline-block; text-align:center; width:100%; margin-bottom:20px;">
            <strong>STUDENT'S NAME:</strong> {{ $student->student_name ?? '_________________' }}
        </div>

        <div style="display:inline-block; text-align:left; width:49%;">
            <strong>SCHOOL'S NAME:</strong> Asha School
        </div>

        <div style="display:inline-block; text-align:right; width:49%;">
            <strong>STATION’S NAME:</strong> Lucknow
        </div>
    </div>

    <div class="text-center " style=" margin-top:130px;">
        <p class="title" style="text-decoration: underline; margin-bottom:0px;">CONTENTS</p>
    </div>
    <ol class="content-list">
        <li>Student Demographic Details</li>
        <li>Progress Report as per Asha Curriculum Guide </li>
        <li>Academic Report Card </li>
    </ol>

    <div style="page-break-before: always;"></div>

    <!-- Start Page-3 Header -->
    <div class="text-center">
        <a href="#" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ public_path('paper/img/logo.png') }}" style="width: 10%;">
            </div>
        </a>
        <p class="title" style="text-decoration: underline; margin-bottom:0px;">DEMOGRAPHIC DETAILS </p>
    </div>
    <div class="section" style="margin-top:40px;">
        <p>
        <div style="width:100%;">
            <div style="display:inline-block; text-align:left; width:48%;">
                <strong>Name of Student: </strong> <span>{{ $student->student_name ?? '_________________' }}</span>
            </div>

            <div style="display:inline-block;  width:48%;">
                <strong>Date of Birth: </strong> <span
                    style="width: 80px;">{{ $student->sex ?? '_________________' }}</span>
            </div>
        </div>
        </p>

        <div style="width:100%;">
            <div style="display:inline-block; text-align:left; width:48%;">
                <strong>Age: </strong> <span style="width: 60px;">{{ $student->age ?? '_________________' }}</span>
            </div>

            <div style="display:inline-block;  width:48%;">
                <strong>Gender</strong> <span style="width: 80px;">{{ $student->sex ?? '_________________' }}</span>
            </div>
        </div>

        <div style="width:100%;">
            <div style="display:inline-block; text-align:left; width:48%;">
                <strong>Date of Admission: </strong> <span>{{ $student->admission_date ?? '_________________' }}</span>
            </div>

            <div style="display:inline-block;  width:48%;">
                <strong>Admission No.: </strong> <span
                    style="width: 80px;">{{ $student->enroll_number ?? '_________________' }}</span>
            </div>
        </div>
        <hr style="margin-bottom: 40px;">
        <div style="width:100%;">
            <div style="display:inline-block; text-align:left; width:48%;">
                <strong>Father’s Name: </strong>
                <span>{{ $family_member['Father']->member_name ?? '_________________' }}</span>
            </div>

            <div style="display:inline-block;  width:48%;">
                <strong>Mobile Number: </strong> <span
                    style="width: 180px;">{{ $family_member['Father']->contact ?? '_________________' }}</span>
            </div>
        </div>

        <div style="width:100%;">
            <div style="display:inline-block; text-align:left; width:48%;">
                <strong>Education: </strong>
                <span>{{ $family_member['Father']->qualification ?? '_________________' }}</span>
            </div>

            <div style="display:inline-block;  width:48%;">
                <strong>Occupation: </strong> <span
                    style="width: 80px;">{{ $family_member['Father']->occupation ?? '_________________' }}</span>
            </div>
        </div>

        <hr style="margin-bottom: 40px;">


        <div style="width:100%;">
            <div style="display:inline-block; text-align:left; width:48%;">
                <strong>Mother's Name: </strong>
                <span>{{ $family_member['Mother']->member_name ?? '_________________' }}</span>
            </div>

            <div style="display:inline-block;  width:48%;">
                <strong>Mobile Number: </strong> <span
                    style="width: 180px;">{{ $family_member['Mother']->contact ?? '_________________' }}</span>
            </div>
        </div>

        <div style="width:100%;">
            <div style="display:inline-block; text-align:left; width:48%;">
                <strong>Education: </strong>
                <span>{{ $family_member['Mother']->qualification ?? '_________________' }}</span>
            </div>

            <div style="display:inline-block;  width:48%;">
                <strong>Occupation: </strong> <span
                    style="width: 80px;">{{ $family_member['Mother']->occupation ?? '_________________' }}</span>
            </div>
        </div>

        <hr style="margin-bottom: 40px;">
        <p>
            <strong>Residential Address (Present): </strong> <span
                style="width: 400px;">{{ $student->c_address ?? '_________________' }}</span>
        </p>

        <p>
            <strong>Residential Address (Permanent): </strong> <span
                style="width: 380px;">{{ $student->p_address ?? '_________________' }}</span>
        </p>
        <hr style="margin-bottom: 40px;">
        <div style="width:100%;">
            <div style="display:inline-block; text-align:left; width:32%;">
                <strong>Brother: </strong>
                <span>{{ $family_member['Brother']->member_name ?? '_________________' }}</span>
            </div>

            <div style="display:inline-block;  width:32%;">
                <strong>Sister: </strong> <span
                    style="width: 80px;">{{ $family_member['Sister']->member_name ?? '_________________' }}</span>
            </div>
            <div style="display:inline-block;  width:32%;">
                <strong>Other: </strong> <span
                    style="width: 80px;">{{ $family_member['Other']->member_name ?? '_________________' }}</span>
            </div>
        </div>

        <p><strong>Age and Education of Siblings:</strong></p>
        <p>1. <span style="width: 400px;"><strong>Age:
                </strong>{{ $family_member['Brother']->age ?? '_________________' }}<strong>Education:
                </strong>{{ $family_member['Brother']->qualification ?? '_________________' }}</span></p>
        <p>2. <span style="width: 400px;"><strong>Age:
                </strong>{{ $family_member['Sister']->age ?? '_________________' }}<strong>Education:
                </strong>{{ $family_member['Brother']->qualification ?? '_________________' }}</span></p>
        <p>3. <span style="width: 400px;"><strong>Age:
                </strong>{{ $family_member['Sister']->age ?? '_________________' }}<strong>Education:
                </strong>{{ $family_member['Brother']->qualification ?? '_________________' }}</span></p>

    </div>
    <div style="page-break-before: always;"></div>
    <!-- End Page-3 Header -->

    <!-- Page-4 Header -->
    <div class="text-center">
        <a href="#" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ public_path('paper/img/logo.png') }}" style="width: 10%;">
            </div>
        </a>
        <p class="title" style="text-decoration: underline; margin-bottom:0px;">Asha School Progress Report</p>
        <p class="year" style="text-decoration: underline; margin-top:0px; ">Year (
            {{ $progressReportMain->progress_report_year ?? '__________' }} )</p>
    </div>

    <!-- Student Info -->
    <div style="width:100%; margin-top:40px;">
        <div style="display:inline-block; text-align:left; width:32%;">
            <strong>Name:</strong> {{ $student->student_name ?? '________________________' }}
        </div>

        <div style="display:inline-block; text-align:center; width:32%;">
            <strong>Class:</strong> {{ $student->cur_class->class_name ?? '_________________' }}
        </div>

        <div style="display:inline-block; text-align:right; width:32%;">
            <strong>Age:</strong> {{ $student->age ? $student->age . ' Years' : '_________________' }}
        </div>
    </div>

    <!-- Section 1: Pen Picture -->
    <p class="section-title" style="margin-top:40px;">Pen picture of the student:</p>
    <p>{{ $progressReportMain->pen_picture ?? '' }}</p>

    <hr>

    <!-- Section 2: Annual Record -->
    <div class="text-center" style="text-decoration: underline;">
        <p class="title">Annual Record for the Year (
            {{ $progressReportMain->progress_report_year ?? '__________' }} )</p>
    </div>

    <div class="assessment">
        <p>
            <strong>Dates of Assessment:</strong>&nbsp;&nbsp; {{ $progressReportMain->dates_of_assessment ?? '' }}
            <strong style="margin-left: 200px;">Baseline:</strong>&nbsp;&nbsp;
            {{ $progressReportMain->baseline ?? '' }}
        </p>
       
        <div style="width:100%; margin-top:40px;">
            <div style="display:inline-block; text-align:left; width:32%;">
                <strong>1<sup>st</sup> Qtr:</strong>&nbsp;{{ $progressReportMain->first_qtr }}
            </div>

            <div style="display:inline-block; text-align:center; width:32%;">
                <strong>2<sup>nd</sup> Qtr:</strong>
                &nbsp;{{ $progressReportMain->second_qtr }}
            </div>

            <div style="display:inline-block; text-align:right; width:32%;">
                <strong>3<sup>rd</sup> Qtr:</strong>
                &nbsp;{{ $progressReportMain->third_qtr }}
            </div>
        </div>

    </div>

    <!-- Start First Table -->
    <table style="margin-top: 40px;">
        <thead>
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
                    <td>{{ $progressReport[$domain]['no_of_activities_assessed'] ?? '' }}</td>
                    <td>{{ $progressReport[$domain]['maxm_score'] ?? '' }}</td>
                    <td>{{ $progressReport[$domain]['baseline_score'] ?? '' }}</td>
                    <td>{{ $progressReport[$domain]['baseline_percentage'] ?? '' }}</td>
                    <td>{{ $progressReport[$domain]['first_qtr_score'] ?? '' }}</td>
                    <td>{{ $progressReport[$domain]['first_qtr_percentage'] ?? '' }}</td>
                    <td>{{ $progressReport[$domain]['second_qtr_score'] ?? '' }}</td>
                    <td>{{ $progressReport[$domain]['second_qtr_percentage'] ?? '' }}</td>
                    <td>{{ $progressReport[$domain]['third_qtr_score'] ?? '' }}</td>
                    <td>{{ $progressReport[$domain]['third_qtr_percentage'] ?? '' }}</td>
                </tr>
            @endforeach
            </tr>
        </tbody>
    </table>
    <!-- End First Table -->

    <!-- Section 3: Annual Record -->
    <div class="text-center" style="text-decoration: underline; margin-top: 40px;">
        <p class="title">Grades for Co-Curricular Domain</p>
    </div>

    <!-- Start Second Table -->
    <table style="margin-top: 40px;">
        <thead>
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
                <td>{{ $progressReportCurr['no_of_activities_assessed'] ?? '' }}</td>
                <td>{{ $progressReportCurr['baseline'] ?? '' }}</td>
                <td>{{ $progressReportCurr['first_qtr'] ?? '' }}</td>
                <td>{{ $progressReportCurr['second_qtr'] ?? '' }}</td>
                <td>{{ $progressReportCurr['third_qtr'] ?? '' }}</td>
            </tr>

            </tr>
        </tbody>
    </table>
    <!-- End Second Table -->

    <div style="margin-top: 40px;">
        <p style="text-transform: capitalize; font-weight: 600; font-style: italic; margin:auto; ">
            <b> GRADES: A- Takes initiative and participates effectively; B- Participates effectively
                when someone else initiates; C- Involves self but is not aware of rules/does not
                cooperate; D- Observes with interest; E- Not Interested; NE- No exposure</b>
        </p>
    </div>

    <!-- Section 4: Annual Record -->
    <div class="text-center" style="text-decoration: underline; margin-top: 40px;">
        <p class="title">Concluding Remarks</p>
    </div>
    <div style="margin-top: 40px;">
        <p>
            <strong>Teacher:</strong>&nbsp;&nbsp; {{ $progressReportMain->teacher_remarks ?? '' }}
        </p>
        <p style="margin-top: 40px;">
            <strong>Principal:</strong>&nbsp;&nbsp; {{ $progressReportMain->principal_remarks ?? '' }}
        </p>
    </div>

    <div class="info-line" style="margin-top:80px;">
        <div style="margin-left:0px; margin-right:0px;"><strong>Teacher’s Signature :</strong> </div>
        <div style="margin-left:75px; margin-right:0px;"><strong>Principal’s Signature :</strong> </div>
        <div style="margin-left:75px; margin-right:0px;"><strong>Parent’s Signature </div>
    </div>

    <div style="page-break-before: always;"></div>

    <div class="text-center">
        <a href="#" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ public_path('paper/img/logo.png') }}" style="width: 10%;">
            </div>
        </a>
        <p class="title" style="text-decoration: underline; margin-bottom:0px;">ACADEMIC REPORT CARD </p>
    </div>

    <!-- Student Info -->
    <div style="width:100%; margin-top:40px;">
        <div style="display:inline-block; text-align:left; width:49%;">
            <strong>Name:</strong> {{ $student->student_name ?? '________________________' }}
        </div>

        <div style="display:inline-block; text-align:right; width:49%;">
            <strong>Class:</strong> {{ $student->cur_class->class_name ?? '_________________' }}
        </div>
    </div>


    <!-- Section 1: Pen Picture -->
    <p class="section-title" style="">Pen picture of the student:</p>
    <p>{{ $progressReportMain->pen_picture ?? '' }}</p>
    <hr>
    <!-- Start Third Table -->
    <table style="margin-top: 40px;">
        <thead>
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
                    <td>{{ $academicReport[$domain]['quarter_1'] ?? '' }}</td>
                    <td>{{ $academicReport[$domain]['quarter_2'] ?? '' }}</td>
                    <td>{{ $academicReport[$domain]['quarter_3'] ?? '' }}</td>
                    <td>{{ $academicReport[$domain]['max_marks'] ?? '' }}</td>
                </tr>
            @endforeach
            </tr>
        </tbody>
    </table>
    <!-- End Third Table -->

    <!-- Start Fourth Table -->
    <table style="margin-top: 40px;">
        <thead>
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
            @php
                $domains = ['Art & Craft', 'Music & Dance', 'Games/ Sports'];
            @endphp

            @foreach ($domains as $index => $domain)
                <tr>
                    <td>0{{ $index + 1 }}</td>
                    <td name="domain" id="">{!! $domain !!}</td>
                    <td>{{ $academicReportCurr[$domain]['quarter_1'] ?? '' }}</td>
                    <td>{{ $academicReportCurr[$domain]['quarter_2'] ?? '' }}</td>
                    <td>{{ $academicReportCurr[$domain]['quarter_3'] ?? '' }}</td>
                    <td>{{ $academicReportCurr[$domain]['Remarks'] ?? '' }}</td>
                </tr>
            @endforeach
            </tr>
        </tbody>
    </table>
    <!-- End Fourth Table -->

    <!-- Start Fifth Table -->
    <table class="" style="width:50%;">
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
    <!-- End Fifth Table -->
    <hr style="margin-top: 80px;">
    <div style="page-break-before: always;"></div>
    <div style="width: 100%; text-align: center; margin: 0; padding: 0;">
        <img src="{{ public_path('student_documents/record_book/record_book_last_page.jpg') }}"
            alt="Record Book Page" style="width: 100%; height: 100vh; object-fit: contain; margin: 0; padding: 0;">
    </div>
</body>

</html>
