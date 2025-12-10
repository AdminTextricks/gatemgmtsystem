@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'teacherlist',
])
@section('content')
    <style>
        .ck-editor__editable_inline {
            min-height: 100px;
        }
    </style>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('teacherlist') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} Teacher Master</p>
                </div>
                <hr>
                <form action="{{ route('teacher.action', ['action' => $action]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="teacher_id">TEACHER ID</label>                                
                                <input type="text" class="form-control" id="teacher_id" name="teacher_id"
                                    placeholder="Teacher ID"
                                    value="{{ old('teacher_id', isset($getdata->teacher_id) ? $getdata->teacher_id : '') }}"
                                    {{($action==='Edit')?'readonly':'required'}} />
                                @error('teacher_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="edit_id" id="edit_id"
                                    value="{{ isset($getdata->id) ? $getdata->id : '' }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">NAME</label>
                                <input type="text" class="form-control" id="teacher_name" name="teacher_name"
                                    placeholder="Teacher Name"
                                    value="{{ old('teacher_name', isset($getdata->teacher_name) ? $getdata->teacher_name : '') }}"
                                    required />
                                @error('teacher_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">MOBILE</label>
                                <input type="tel" class="form-control" id="mobile" name="mobile"
                                    placeholder="Mobile"
                                    value="{{ old('mobile', isset($getdata->mobile) ? $getdata->mobile : '') }}" required />
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">E-MAIL</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="E-MAIL"
                                    value="{{ old('email', isset($getdata->email) ? $getdata->email : '') }}" required />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- @if ($action != 'Edit') --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">PASSWORD</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="password" value="" autocomplete="new-password" />
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">CONFIRM PASSWORD</label>
                                <input type="text" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm Password" value="" />
                                @error('confirm_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- @endif --}}

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="class_id">CLASS ASSIGNED</label>
                                <select class="form-control" id="class_id" name="class_id" required>
                                    <option value="">Select Class</option>
                                    @foreach ($class as $class)
                                        {{-- <option value="{{$class->id}}"  @if (optional($getdata->class)->id == $class->id) selected @endif>{{$class->class_name}}</option> --}}
                                        <option value="{{ $class->id }}"
                                            {{ isset($getdata['class']['id']) && $getdata['class']['id'] == $class->id ? 'selected' : '' }}>
                                            {{ $class->class_name }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('class_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_of_joining">DATE OF JOINING</label>
                                <input type="date" class="form-control" id="date_of_joining" name="date_of_joining"
                                    value="{{ old('date_of_joining', isset($getdata->date_of_joining) ? \Carbon\Carbon::parse($getdata->date_of_joining)->format('Y-m-d') : '') }}" />
                                @error('date_of_joining')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="proficiency">PROFICIENCY</label>
                                <input type="text" class="form-control" id="proficiency" name="proficiency"
                                    placeholder="Proficiency"
                                    value="{{ old('proficiency', isset($getdata->proficiency) ? $getdata->proficiency : '') }}" />
                                @error('proficiency')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rci_registration">RCI REGISTRATION</label>
                                <input type="text" class="form-control" id="rci_registration" name="rci_registration"
                                    placeholder="RCI Registration"
                                    value="{{ old('rci_registration', isset($getdata->rci_registration) ? $getdata->rci_registration : '') }}" />
                                @error('rci_registration')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="qualification">QUALIFICATION</label>
                                <input type="text" class="form-control" id="qualification" name="qualification"
                                    placeholder="Qualification"
                                    value="{{ old('qualification', isset($getdata->qualification) ? $getdata->qualification : '') }}" />
                                @error('qualification')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="classification">TEACHER CLASSIFICATION</label>
                                <input type="text" class="form-control" id="classification"
                                    name="classification" placeholder="Teacher Classification"
                                    value="{{ old('classification', isset($getdata->classification) ? $getdata->classification : '') }}" />
                                @error('classification')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="rci_expiration_date">RCI EXPIRATION DATE</label>
                                <input type="date" class="form-control" id="rci_expiration_date" name="rci_expiration_date"
                                    value="{{ old('rci_expiration_date', isset($getdata->rci_expiration_date) ? \Carbon\Carbon::parse($getdata->rci_expiration_date)->format('Y-m-d') : '') }}" />
                                @error('rci_expiration_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="document">UPLOAD DOCUMENT</label>
                                <input type="file" class="form-control" id="document" name="document"
                                    placeholder="upload" value="" style="opacity: 1; position: unset;" />
                                @if (!empty($getdata->document))
                                    <div>
                                        <a href="{{ asset($getdata->document) }}" target="_blank"
                                            style="font-size: .7rem; ">
                                            View Uploaded Document
                                        </a>
                                    </div>
                                @endif
                                @error('document')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">STATUS</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1"
                                        {{ old('status', $userdata->status ?? '') == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0"
                                        {{ old('status', $userdata->status ?? '') == 0 ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                                @error('document')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">ADDRESS</label>
                                <textarea class="form-control ckeditor" id="address"  name="address"
                                    placeholder="Enter your address">{{ old('address', $getdata->address ?? '') }}</textarea>
                                @error('address')
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
    <script src="{{ asset('js/ckeditor.js') }}"></script>
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
@endsection
