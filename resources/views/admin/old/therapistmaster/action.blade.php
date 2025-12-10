@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'therapistlist',
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
                    <a href="{{ route('therapistlist') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} Therapist Master</p>
                </div>
                <hr>
                <form action="{{ route('therapist.action') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="therapist_id">THERAPIST ID</label>
                                <input type="text" class="form-control" id="therapist_id" name="therapist_id"
                                    placeholder="Therapist ID"
                                    value="{{ isset($getdata->therapist_id) ? $getdata->therapist_id : '' }}"  required/>
                                @error('therapist_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="edit_id" id="edit_id"
                                    value="{{ isset($getdata->id) ? $getdata->id : '' }}" />
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="therapist_name">THERAPIST NAME</label>
                                <input type="text" class="form-control" id="therapist_name" name="therapist_name"
                                    placeholder="Therapist Name"
                                    value="{{ isset($getdata->therapist_name) ? $getdata->therapist_name : '' }}" required/>
                                @error('therapist_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="therapy_name">THERAPY </label>
                                <input type="text" class="form-control" id="therapy_name"
                                    name="therapy_name" placeholder="Therapy Name"
                                    value="{{ old('therapy_name', isset($getdata->therapy_name) ? $getdata->therapy_name : '') }}" required/>
                                @error('therapy_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="qualification">QUALIFICATION</label>
                                <input type="text" class="form-control" id="qualification" name="qualification"
                                    placeholder="Qualification"
                                    value="{{ isset($getdata->qualification) ? $getdata->qualification : '' }}" />
                                @error('qualification')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">MOBILE</label>
                                <input type="tel" class="form-control" id="mobile" name="mobile"
                                    placeholder="Mobile" value="{{ isset($getdata->mobile) ? $getdata->mobile : '' }}" required />
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">E-MAIL</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="E-MAIL" value="{{ isset($getdata->email) ? $getdata->email : '' }}" required/>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_of_joining">DATE OF JOINING</label>
                                <input type="date" class="form-control" id="date_of_joining" name="date_of_joining"
                                    value="{{ isset($getdata->date_of_joining) ? \Carbon\Carbon::parse($getdata->date_of_joining)->format('Y-m-d') : '' }}" required/>
                                @error('date_of_joining')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="class_id">CLASS ASSIGNED</label>
                                <select class="form-control select2" id="class_id" name="class_id[]" multiple
                                    style="width: 100%;" required>
                                    <option value="">Select Class</option>
                                    @foreach ($class as $class)
                                        <option value="{{ $class->id }}"
                                            @if (isset($getdata->id) && $getdata->class->id == $class->id) selected @endif>{{ $class->class_name }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('class_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="proficiency">PROFICIENCY</label>
                                <input type="text" class="form-control" id="proficiency" name="proficiency"
                                    placeholder="Proficiency"
                                    value="{{ isset($getdata->proficiency) ? $getdata->proficiency : '' }}" />
                                @error('proficiency')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <label for="classification">THERAPIST CLASSIFICATION</label>
                                <input type="text" class="form-control" id="classification"
                                    name="classification" placeholder=" Classification"
                                    value="{{ old('classification', isset($getdata->classification) ? $getdata->classification : '') }}" />
                                @error('classification')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">ADDRESS</label>
                                <textarea class="form-control ckeditor" id="address" name="address" placeholder="Enter your address">{{ old('address', $getdata->address ?? '') }}</textarea>
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
    <script src="{{ asset('js/jquery.min.js') }}"></script>
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
    <script>
        $(document).ready(function() {
            $('#class_id').select2({
                placeholder: "Select Classes",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
