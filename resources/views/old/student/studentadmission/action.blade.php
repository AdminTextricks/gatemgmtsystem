@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'studentlist',
])

@section('content')
    <style>
        .ck-editor__editable_inline {
            min-height: 70px;
        }
    </style>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('studentlist') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} Student</p>
                </div>
                <hr>
                <form action="{{ route('student.action') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="enroll_number">Enroll No.</label>
                                <input type="text" class="form-control" id="enroll_number" name="enroll_number"
                                    placeholder="Enroll No."
                                    value="{{ old('enroll_number', $getdata->enroll_number ?? '') }}" required />
                                @error('enroll_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="edit_id" id="edit_id"
                                    value="{{ isset($getdata->id) ? $getdata->id : '' }}" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="admission_session">Current Session</label>
                                <select class="form-control" id="session" name="session" required>
                                    <option value="">Select Session</option>
                                    @foreach ($sessions as $session)
                                        <option value="{{ $session }}"
                                            {{ old('session', $getdata->session ?? '') == $session ? 'selected' : '' }}>
                                            {{ $session }} </option>
                                    @endforeach
                                </select>
                                @error('admission_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="admission_date">Admission Date</label>
                                <input type="date" class="form-control" id="admission_date" name="admission_date"
                                    placeholder="Admission Date"
                                    value="{{ old('admission_date', $getdata->admission_date ?? '') }}" required />
                                @error('admission_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="class_id">Admission Class</label>
                                <select class="form-control" id="adm_class_id" name="adm_class_id">
                                    <option value="">Select Class</option>
                                    @foreach ($classMaster as $class)
                                        <option value="{{ $class->id }}"
                                            @if ((isset($getdata->adm_class_id) && $getdata->adm_class_id == $class->id) || old('adm_class_id') == $class->id) selected @endif> {{ $class->class_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="class_id">Current Class</label>
                                <select class="form-control" id="cur_class_id" name="cur_class_id" required>
                                    <option value="">Select Class</option>
                                    @foreach ($classMaster as $class)
                                        <option value="{{ $class->id }}"
                                            @if ((isset($getdata->cur_class_id) && $getdata->cur_class_id == $class->id) || old('cur_class_id') == $class->id) selected @endif> {{ $class->class_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">Type</label>
                                <select class="form-control" id="type" name="type" required>
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
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student_name">Student Name</label>
                                <input type="text" class="form-control" id="student_name" name="student_name"
                                    placeholder="Student Name"
                                    value="{{ old('student_name', $getdata->student_name ?? '') }}" />
                                @error('student_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fathers_name">Father's Name</label>
                                <input type="text" class="form-control" id="fathers_name" name="fathers_name"
                                    placeholder="Father's Name"
                                    value="{{ old('fathers_name', $getdata->fathers_name ?? '') }}" />
                                @error('fathers_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mothers_name">Mother's Name</label>
                                <input type="text" class="form-control" id="mothers_name" name="mothers_name"
                                    placeholder="Mother's Name"
                                    value="{{ old('mothers_name', $getdata->mothers_name ?? '') }}" />
                                @error('mothers_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                    placeholder="Mobile" value="{{ old('mobile', $getdata->mobile ?? '') }}" />
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Correspondence Address</label>
                                <input type="text" class="form-control" id="c_address" name="c_address"
                                    placeholder="Correspondence Address"
                                    value="{{ old('c_address', $getdata->c_address ?? '') }}" />
                                @error('c_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Permanent Address</label>
                                <input type="text" class="form-control" id="p_address" name="p_address"
                                    placeholder="Permanent Address"
                                    value="{{ old('p_address', $getdata->p_address ?? '') }}" />
                                @error('p_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="state_id">State</label>
                                <select class="form-control select2" id="state_id" name="state_id" required>
                                    <option value="">Select State</option>

                                    @foreach ($stateMaster as $state)
                                        <option value="{{ $state->id }}"
                                            {{ ($getdata->state_id ?? '') == $state->id ? 'selected' : '' }}>
                                            {{ $state->state_name }} </option>
                                    @endforeach
                                </select>
                                @error('state_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="city_id">City</label>
                                <select class="form-control" id="city_id" name="city_id" required>
                                    <option value="">--Select City--</option>
                                    @if (!empty($studentCity))
                                        <option value="{{ $studentCity->id }}" selected>{{ $studentCity->city_name }}
                                        </option>
                                    @endif
                                    {{-- value using ajax --}}
                                </select>
                                @error('city_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sex">Gender</label>
                                <select class="form-control" id="sex" name="sex">
                                    <option value="">Select Gender</option>
                                    <option value="Male" @if ((isset($getdata->sex) && $getdata->sex == 'Male') || old('sex') == 'Male') selected @endif>Male</option>
                                    <option value="Female" @if ((isset($getdata->sex) && $getdata->sex == 'Female') || old('sex') == 'Female') selected @endif>Female
                                    </option>
                                </select>
                                @error('sex')
                                    <span class="text-danger">The gender field is required.</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="dob">DOB</label>
                                <input type="date" class="form-control" id="dob" name="dob"
                                    placeholder="DOB" value="{{ old('dob', $getdata->dob ?? '') }}" />
                                @error('dob')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="text" class="form-control" id="age" name="age"
                                    placeholder="Age" value="{{ old('age', $getdata->age ?? '') }}" />
                                @error('age')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="disability_id">Unique Disability</label>
                                <select class="form-control select2" id="disability_id" name="disability_id[]" multiple
                                    style="width: 100%;">
                                    <option value="">Select Disability</option>
                                    @foreach ($disabilityMatser as $disability)
                                        <option value="{{ $disability->id }}" {{-- {{ old('disability_id', in_array($disability->id, $disabilities ?? [])) ? 'selected' : '' }}>
                                            {{ $disability->disability_name }} --}}
                                            {{ collect(old('disability_id', $disabilities ?? []))->contains($disability->id) ? 'selected' : '' }}>
                                            {{ $disability->disability_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('disability_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="unique_identity_no">Unique Identity No.</label>
                                <input type="text" class="form-control" id="unique_identity_no"
                                    name="unique_identity_no" placeholder="Unique Identity No."
                                    value="{{ old('unique_identity_no', $getdata->unique_identity_no ?? '') }}" />
                                @error('unique_identity_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="aadhar_no">Aadhar No.</label>
                                <input type="text" class="form-control" id="aadhar_no" name="aadhar_no"
                                    placeholder="Unique Identity No."
                                    value="{{ old('aadhar_no', $getdata->aadhar_no ?? '') }}" />
                                @error('aadhar_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">Active</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" @if ((isset($getdata->status) && $getdata->status == '1') || old('status') == '1') selected @endif>Yes</option>
                                    <option value="0" @if ((isset($getdata->status) && $getdata->status == '0') || old('status') == '0') selected @endif>No</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">Pedigree Status</label>
                                <select class="form-control" id="pedigree_status" name="pedigree_status">
                                    <option value="0" @if ((isset($getdata->pedigree_status) && $getdata->pedigree_status == '0') || old('status') == '0') selected @endif>No</option>
                                    <option value="1" @if ((isset($getdata->pedigree_status) && $getdata->pedigree_status == '1') || old('status') == '1') selected @endif>Yes</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Curriculum</label>
                                <textarea class="form-control" id="curriculum" name="curriculum" placeholder="Enter Curriculum">{{ old('curriculum', $getdata->curriculum ?? '') }}</textarea>
                                @error('curriculum')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 text-right ">
                            <div class="form-group" style="margin:20px;">
                                <label for="status">QR Code</label>
                                <img src="{{ asset(isset($getdata->qrcode) && $getdata->qrcode ? $getdata->qrcode : 'qrcodes/No_image.jpg') }}"
                                    class="card-img-top" alt="qrcode" style="width: 100px; object-fit: cover;">
                            </div>
                        </div>



                        <div class="col-md-12">
                            <p class="h6 p-1">Individual Educational Plan</p>
                            <hr>
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
                                $domainRuteArr = [
                                    'motorCode',
                                    'personalCode',
                                    'socialCode',
                                    'languageCode',
                                    'numberTimeMoneyMeasurementCode',
                                    'environmentalScienceCode',
                                    'occupationalVocationalCode',
                                    'coCurricularCode',
                                    'parentalInvolvementPlanCode',
                                ];
                            @endphp
                            <div class=" domain-container row d-flex justify-content-betwen align-item-center">
                                @foreach ($domainArr as $index => $domain)
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label for="domain_description" class="ml-2"
                                                id="domain_name_{{ $index }}"><strong>{{ $index + 1 }}.
                                                    {{ $domain }}</strong></label>
                                            <span style="float:right;"><a href="{{ route($domainRuteArr[$index].'.list') }}" target="_blank"> Code Details</a></span>
                                            <input type="hidden" name="domain_name[{{ $index }}]"
                                                value="{{ $domain }}">
                                            <textarea class="form-control ckeditor" id="domain_description_{{ $index }}"
                                                name="domain_description[{{ $index }}]" placeholder="" rows="5">{{ old('domain_description.' . $index, $domainMap[$domain]->description ?? '') }}</textarea>
                                        </div>
                                        @error('domain_name{{ $index }}')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                            <hr class="p-1">
                        </div>


                        <div class="col-md-12 ">
                            <p class="h6 p-1">Therapy Details</p>
                            <hr>
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
                            <div class=" therapy-container row d-flex justify-content-betwen align-item-center ">
                                @foreach ($therapyArr as $index => $therapy)
                                    <div class="col-md-6 mt-2 ">
                                        <div class="form-group">
                                            <label for="therapy_name" class="ml-2"
                                                id="therapy_name_{{ $index }}"><strong>{{ $index + 1 }}.
                                                    {{ $therapy }}</strong></label>
                                            <input type="hidden" name="therapy_name[{{ $index }}]"
                                                value="{{ $therapy }}">
                                            <textarea class="form-control ckeditor" id="therapy_description_{{ $index }}"
                                                name="therapy_description[{{ $index }}]" placeholder="">{{ old('therapy_description.' . $index, $therapiesMap[$therapy]->description ?? '') }}</textarea>
                                        </div>
                                        @error('domain_name{{ $index }}')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                            <hr class="p-1">
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="therapy">Therapy</label>
                                <textarea type="text" class="form-control" id="therapy" name="therapy" placeholder="Therapy">{{ isset($getdata->therapy) ? $getdata->therapy : '' }}{{ old('therapy') }}</textarea>

                                @error('therapy')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="individual_educational_plan">Individual Educational Plan</label>
                                <textarea type="text" class="form-control" id="individual_educational_plan" name="individual_educational_plan"
                                    placeholder="Individual Educational Plan">{{ isset($getdata->individual_educational_plan) ? $getdata->individual_educational_plan : '' }}{{ old('individual_educational_plan') }}</textarea>

                                @error('individual_educational_plan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="col-md-12 ">
                            <p class="h6 p-1">Extracurricular Activities</p>
                            <hr>
                            <div class="extracurricular-container row d-flex justify-content-betwen align-item-center ">

                                <div class="col-md-6 mt-2 ">
                                    <div class="form-group">
                                        <label for="vocational_and_skill_training" class="ml-2"><strong>1.
                                                Vocational & Skill Training</strong></label>
                                        <textarea type="text" class="form-control ckeditor" id="vocational_and_skill_training"
                                            name="vocational_and_skill_training" placeholder="">{{ old('vocational_and_skill_training', $getdata->vocational_and_skill_training ?? '') }}</textarea>
                                    </div>
                                    @error('vocational_and_skill_training')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-2 ">
                                    <div class="form-group">
                                        <label for="special_achievements" class="ml-2"><strong>2.
                                                Special Achievements</strong></label>
                                        <textarea type="text" class="form-control ckeditor" id="special_achievements" name="special_achievements"
                                            placeholder="">{{ old('special_achievements', $getdata->special_achievements ?? '') }}</textarea>
                                    </div>
                                    @error('special_achievements')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <hr class="p-1">
                        </div>

                        <div class="col-md-12 ">
                            <p class="h6 p-1">Other Information</p>
                            <hr>
                            <div class="extracurricular-container row d-flex justify-content-betwen align-item-center ">

                                <div class="col-md-6 mt-2 ">
                                    <div class="form-group">
                                        <label for="allergies" class="ml-2"><strong>1.
                                                Allergies</strong></label>
                                        <textarea type="text" class="form-control ckeditor" id="allergies" name="allergies" placeholder="">{{ old('allergies', $getdata->allergies ?? '') }}</textarea>
                                    </div>
                                    @error('allergies')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-2 ">
                                    <div class="form-group">
                                        <label for="additional_info" class="ml-2"><strong>2.
                                                Additional Information</strong></label>
                                        <textarea type="text" class="form-control ckeditor" id="additional_info" name="additional_info" placeholder="">{{ old('additional_info', $getdata->additional_info ?? '') }}</textarea>
                                    </div>
                                    @error('additional_info')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <hr class="p-1">
                        </div>

                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            @if ($action == 'Edit')
                                <a
                                    href="{{ route('student_family', ['action' => 'Edit', 'student_id' => $getdata->id]) }}"><button
                                        type="button" class="btn btn-primary">Update Family Details</button></a>
                                <a
                                    href="{{ route('student_documents', ['action' => 'Edit', 'student_id' => $getdata->id]) }}"><button
                                        type="button" class="btn btn-primary">Update Documents</button></a>
                            @endif
                            @if (isset($getdata->qrcode) && $getdata->qrcode == '')
                                <a
                                    href="{{ route('student_family', ['action' => 'Add', 'student_id' => $getdata->id]) }}"><button
                                        type="button" class="btn btn-primary">Update Family Details</button></a>
                                <a
                                    href="{{ route('student_documents', ['action' => 'Add', 'student_id' => $getdata->id]) }}"><button
                                        type="button" class="btn btn-primary">Update Documents</button></a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#state_id').on('change', function() {
                let stateId = $(this).val();
                $('#city_id').html('<option value="">-- Loading... --</option>');
                if (stateId) {
                    $.ajax({
                        url: "{{ url('studentlist/get-cities') }}/" + stateId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                var data = response.data;
                                $('#city_id').empty().append(
                                    '<option value="">-- Select City --</option>');
                                $.each(data, function(key, city) {
                                    $('#city_id').append('<option value="' + city.id +
                                        '">' + city.city_name + '</option>');
                                });
                            }

                        },
                        error: function() {
                            alert('Error loading cities');
                        }
                    });
                } else {
                    $('#city_id').html('<option value="">-- Select City --</option>');
                }
            });
        });

        @if ($action == 'Edit')
            $('#cur_class_id').on('change', function() {
                let personId = @json($getdata->id);
                let classId = $(this).val();
                var main_url = "{{ route('get_domains_therapies', ['id' => '_id_', 'class' => '_class_']) }}";
                var url = main_url.replace('_id_', personId).replace('_class_', classId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            var domains = response.domains;
                            var therapies = response.therapies;
                            let html_therapy = '';
                            let html_domain = '';
                            domains.forEach((domain, index) => {
                                html_domain += `
                        <div class="col-md-6 mt-2 " >
                            <div class="form-group">
                            <label for="domain_name" class="ml-2" ><strong>${index + 1 }. ${domain.domain_name}</strong></label>
                             <input type="hidden" name="domain_name[${index }]"  value="${domain.domain_name}"/> 
                             <input type="text" class="form-control"  name="domain_description[${index}]" value="${domains[index].description ?? ''}" />   
                         </div>    
                        </div>  `;
                            });

                            therapies.forEach((therapy, index) => {
                                html_therapy += `
                        <div class="col-md-6 mt-2 " >
                            <div class="form-group">
                            <label for="therapy_name" class="ml-2" ><strong>${index + 1 }. ${therapy.therapy_name}</strong></label>
                             <input type="hidden" name="therapy_name[${index }]"  value="${therapy.therapy_name}"/> 
                             <input type="text" class="form-control"  name="therapy_description[${index}]" value="${therapies[index].description ?? ''}" />   
                         </div>    
                        </div>  `;
                            });
                            $('.therapy-container').html(html_therapy);
                            $('.domain-container').html(html_domain);

                        } else {
                            $('.therapy-container').html('');
                            $('.domain-container').html('');
                        }
                    },
                    error: function() {
                        alert('Error loading cities');
                    }
                });

            });
        @endif
    </script>

    <script>
        $('#dob').on('change', function() {
            let dob = $(this).val();
            let age = calculateAge(dob);
            $('#age').val(age)
        });

        function calculateAge(dob) {
            if (!dob) return "";

            let birthDate = new Date(dob);
            let today = new Date();

            let age = today.getFullYear() - birthDate.getFullYear();
            let monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            return age;
        }
    </script>
    {{-- <script src="{{ asset('js/ckeditor.js') }}"></script> --}}
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
        $(document).ready(function() {
            $('#disability_id').select2({
                placeholder: "Select Disabilities",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
