@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'studentlist',
])
@section('content')
    <style>
        .addSiblingBtn {
            transition: transform 0.15s ease, background-color 0.3s ease;
        }

        .addSiblingBtn:hover {
            transform: scale(0.95);
            background-color: #39b771 !important;
        }
    </style>
    <div class="content">
        @if (session('success'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('student_action', ['action' => 'Edit', 'id' => $getdata->id]) }}"
                        class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} Family Members</p>
                </div>
                <hr>
                <form action="{{ route('student.family') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student_id">Student Id</label>
                                <input type="text" class="form-control" id="enroll_number" name="enroll_number"
                                    placeholder="Student Enroll No."
                                    value="{{ old('enroll_number', $getdata->enroll_number ?? '') }}" disabled />
                                @error('student_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="student_id" id="student_id"
                                    value="{{ isset($getdata->id) ? $getdata->id : '' }}" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student_name">Student Name</label>
                                <input type="text" class="form-control" id="student_name" name="student_name"
                                    placeholder="Admission Date"
                                    value="{{ isset($getdata->student_name) ? $getdata->student_name : '' }}" disabled />
                                @error('student_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="class_id">Class</label>
                                <select class="form-control" id="class_id" name="class_id" disabled>
                                    <option value="">Select Class</option>
                                    @foreach ($classMaster as $class)
                                        <option value="{{ $class->id }}"
                                            @if (isset($getdata->cur_class_id) && $getdata->cur_class_id == $class->id) selected @endif> {{ $class->class_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 text-right" style="margin: auto;">
                            <button type="button" id="addSiblingBtn" class="btn btn-success p-2 mt-4 addSiblingBtn"><i
                                    class="fa fa-plus"></i> Add Member</button>
                        </div>
                    </div>
                    <hr class="custom-shadow">
                    <div class="container" id="member_container">
                        @php
                            // Merge old input and DB members
                            $members = old('member_name')
                                ? array_map(
                                    function ($name, $i) {
                                        return [
                                            'member_name' => $name,
                                            'relation' => old('relation.' . $i),
                                            'age' => old('age.' . $i),
                                            'qualification' => old('qualification.' . $i),
                                            'occupation' => old('occupation.' . $i),
                                            'contact' => old('contact.' . $i),
                                            'adhaar_no' => old('adhaar_no.' . $i),
                                            'gender' => old('gender.' . $i),
                                        ];
                                    },
                                    old('member_name'),
                                    array_keys(old('member_name')),
                                )
                                : ($familyMembers->isNotEmpty()
                                    ? $familyMembers
                                    : [
                                        [
                                            'member_name' => '',
                                            'relation' => 'Father',
                                            'age' => '',
                                            'qualification' => '',
                                            'occupation' => '',
                                            'contact' => '',
                                            'adhaar_no' => '',
                                            'gender' => '',
                                        ],
                                    ]);
                        @endphp
                        @foreach ($members as $i => $member)
                            <input type="hidden" name="edit_id[]" value="{{ $member->id ?? '' }}">
                            <div class="member-item" data-index="{{ $loop->index }}">
                                <div class="d-flex justify-content-between">
                                    <p class="h6"><i class="fa fa-user"></i>
                                        {{ $member['relation'] ? $member['relation'] : 'Member ' . ($i + 1) }} Details
                                    </p>
                                    <div class="buttons">
                                        <button type="button" class="btn p-1 mt-0 removeSiblingBtn"
                                            style="background: #f76f6f;"><i class="fa fa-trash"></i> </button>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Member Name</label>
                                            <input type="text" name="member_name[]" class="form-control member_name"
                                                placeholder="Enter Name" value="{{ $member['member_name'] ?? '' }}"
                                                required>
                                            @if ($errors->has('member_name.' . $i))
                                                <span class="text-danger">member name field is required.</span>
                                            @endif
                                        </div>
                                    </div>
                                    @php
                                        $disableRel = ['Father', 'Mother'];
                                        $relationVal = $member['relation'];
                                    @endphp
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Relation</label>
                                            <input type="text" name="relation[]" class="form-control relation" required
                                                placeholder="Enter Relation" value="{{ $member['relation'] ?? '' }}"
                                                @if (in_array($relationVal, $disableRel)) @readonly(true) @endif>
                                            @if ($errors->has('relation.' . $i))
                                                <span class="text-danger">relation field is required.</span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Qualification</label>
                                        <input type="text" name="qualification[]" class="form-control qualification"
                                            placeholder="Enter Qualification"
                                            value="{{ $member['qualification'] ?? '' }}">
                                        @if ($errors->has('qualification.' . $i))
                                            <span class="text-danger">
                                                {{ preg_replace('/qualification\.\d+/', 'qualification', $errors->first('qualification.' . $i)) }}</span>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Occupation</label>
                                    <select name="occupation[]" class="form-control occupation" required>
                                        <option value=""> Select Occupation </option>
                                        @foreach ($occupations as $occupation)
                                            <option value="{{ $occupation->id }}"
                                                {{ ($member['occupation'] ?? '') == $occupation->id ? 'selected' : '' }}>
                                                {{ $occupation->occupation_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('occupation.' . $i))
                                        <span class="text-danger">
                                            {{ preg_replace('/occupation\.\d+/', 'occupation', $errors->first('occupation.' . $i)) }}</span>
                                    @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Contact No.</label>
                                <input type="text" name="contact[]" class="form-control contact"
                                    placeholder="Enter Contact No." value="{{ $member['contact'] ?? '' }}"
                                      >                                 
                                @if ($errors->has('contact.' . $i))
                                    <span class="text-danger">
                                        {{ preg_replace('/contact\.\d+/', 'contact', $errors->first('contact.' . $i)) }}</span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender[]" class="form-control " required>
                                <option value="">
                                    Select Gender
                                </option>
                                <option value="Male"
                                    {{ ($member['gender'] ?? '') == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female"
                                    {{ ($member['gender'] ?? '') == 'Female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="Other"
                                    {{ ($member['gender'] ?? '') == 'Other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                            @if ($errors->has('gender.' . $i))
                                <span class="text-danger">gender field is required.</span>
                            @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Person Age</label>
                        <input type="text" name="age[]" class="form-control"
                            placeholder="Enter Age" value="{{ $member['age'] ?? '' }}" required>
                        @if ($errors->has('age.' . $i))
                            <span class="text-danger">age field is required and must be an
                                integer.</span>
                        @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Aadhar No.</label>
                    <input type="text" name="adhaar_no[]" class="form-control adhaar_no"
                        placeholder="Enter Aadhar No." value="{{ $member['adhaar_no'] ?? '' }}">
                    @if ($errors->has('adhaar_no.' . $i))
                        <span class="text-danger"> Adhaar number must be unique</span>
                    @enderror
            </div>
        </div>

    </div>
    <hr class="custom-shadow">
</div>
@endforeach
</div>



<div class="col-sm-12 text-center">
<button type="submit" class="btn btn-primary">Submit</button>

<a href="{{ route('student_documents', ['action' => 'Add', 'student_id' => $getdata->id]) }}"><button
    type="button" class="btn btn-primary">Update Documents</button></a>
</div>
</div>
</form>

<!-- Start Hidden template -->
<div id="siblingTemplate" class="d-none">
<input type="hidden" name="edit_id[]" value="">
<div class="member-item" data-index="__INDEX__">
<div class="d-flex justify-content-between">
<p class="h6">Member__NUM__ Details</p>
<button type="button" class="btn p-1 mt-0 removeSiblingBtn" style="background: #f76f6f;"><i
    class="fa fa-trash"></i> </button>
</div>
<div class="row">
<div class="col-md-3">
<div class="form-group">
    <label>Member__NUM__ Name</label>
    <input type="text" name="member_name[]" class="form-control member_name"
        placeholder="Enter Name" value="" required>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
    <label>Relation</label>
    <select name="relation[]" class="form-control relation" required>
        <option value="" selected>Select Relation</option>
        <option value="Father">Father</option>
        <option value="Mother">Mother</option>
        <option value="Brother">Brother</option>
        <option value="Sister">Sister</option>
        <option value="Other">Other</option>
    </select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
    <label>Qualification</label>
    <input type="text" name="qualification[]" class="form-control qualification"
        placeholder="Enter Qualification" value="">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
    <label>Occupation</label>
    {{-- <input type="text" name="occupation[]" class="form-control occupation"
        placeholder="Enter Occupation" value=""> --}}
    <select name="occupation[]" class="form-control occupation" required>
        <option value=""> Select Occupation </option>
        @foreach ($occupations as $occupation)
            <option value="{{ $occupation->id }}">                
                {{ $occupation->occupation_name }}</option>
        @endforeach
    </select>
</div>
</div>
</div>

<div class="row">
<div class="col-md-3">
<div class="form-group">
    <label>Contact No.</label>
    <input type="text" name="contact[]" class="form-control contact"
        placeholder="Enter Contact No." value="" required>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
    <label>Gender</label>
    <select name="gender[]" class="form-control" required>
        <option value="">
            Select Gender
        </option>
        <option value="Male">
            Male
        </option>
        <option value="Female">
            Female
        </option>
        <option value="Other">
            Other
        </option>
    </select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
    <label>Person Age</label>
    <input type="text" name="age[]" class="form-control age" placeholder="Enter Age"
        value="" required>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
    <label>Aadhar No.</label>
    <input type="text" name="adhaar_no[]" class="form-control adhaar_no"
        placeholder="Enter Aadhar No." value="">
</div>
</div>

</div>
<hr class="custom-shadow">
</div>
</div>
<!-- End Hidden template -->

</div>
</div>
</div>


<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script> --}}
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

<script>
    let siblingIndex = $('#member_container .member-item').length;
    $('#addSiblingBtn').on('click', function() {
        let template = $('#siblingTemplate').html();
        template = template.replace(/__INDEX__/g, siblingIndex)
            .replace(/__NUM__/g, siblingIndex + 1);

        $('#member_container').append(template);

        // Move cursor to last div
        let newDiv = $('#member_container .member-item').last();
        newDiv.find('input, select').first().focus();
        newDiv.find('.select2').select2();

        siblingIndex++;
    });

    $(document).on('click', '.removeSiblingBtn', function() {
        let totalItems = $('#member_container .member-item').length;
        if (totalItems > 1) {
            $(this).closest('.member-item').remove();
            resetSiblingIndexes();
        } else {
            alert("Atleast one member required");
        }

    });

    function resetSiblingIndexes() {
        $('#member_container .member-item').each(function(i) {
            $(this).attr('data-index', i);
        });
        siblingIndex--;
    }
</script>
@endsection
