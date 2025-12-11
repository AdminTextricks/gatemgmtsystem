@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'visitorlist',
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
                    <a href="{{ route('visitorlist') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} Visitor Details</p>
                </div>
                <hr>
                <form action="{{ route('visitor.action', ['action' => $action]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">NAME<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Member Name"
                                    value="{{ old('name', isset($getdata->name) ? $getdata->name : '') }}" required />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="edit_id" id="edit_id"
                                    value="{{ isset($getdata->id) ? $getdata->id : '' }}" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">E-MAIL<span style="color:red">*</span></label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="E-MAIL"
                                    value="{{ old('email', isset($getdata->email) ? $getdata->email : '') }}" required />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">MOBILE<span style="color:red">*</span></label>
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
                                <label for="class_id">Unique Id<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="uid" name="uid"
                                    placeholder="Unique Id"
                                    value="{{ old('uid', isset($getdata->uid) ? $getdata->uid : '') }}" required />
                                @error('uid')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">STATUS<span style="color:red">*</span></label>
                                <select name="status" id="status" class="form-control" required>
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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date"
                                    placeholder="Enter Visit Date"
                                    value="{{ old('date', isset($getdata->date) ? $getdata->date : '') }}" />
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="duration">Duration</label>
                                <input type="text" class="form-control" id="date_range" name="duration" 
                                    placeholder="Select Visit Duration"
                                    value="{{ old('duration', isset($getdata->duration) ? $getdata->duration : '') }}" />
                                @error('duration')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="duration">Maximum Allows Days</label>
                                <input type="number" class="form-control" id="max_allow_days" name="max_allow_days" 
                                    placeholder="Enter Maximum Allows Days" min="0"
                                    value="{{ old('max_allow_days', isset($getdata->max_allow_days) ? $getdata->max_allow_days : '') }}" />
                                @error('max_allow_days')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">ADDRESS</label>
                                <textarea class="form-control ckeditor" id="address" name="address" placeholder="Enter your address">{{ old('address', $getdata->address ?? '') }}</textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>

    </div>
    {{-- <script src="{{ asset('js/ckeditor.js') }}"></script> --}}
    {{-- <script>
        document.querySelectorAll('.ckeditor').forEach(function(el) {
            ClassicEditor.create(el, {
                    toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'undo',
                        'redo', 'blockQuote', 'insertTable',
                    ],

                })
                .catch(error => console.error(error));
        });
    </script> --}}
@endsection
