@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'gateadminlist',
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
                    <a href="{{ route('gateadminlist') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} Gate Admin Details</p>
                </div>
                <hr>
                <form action="{{ route('gateadmin.action', ['action' => $action]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gate_admin_id">EMPLOYEE ID<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="name" name="gate_admin_id"
                                    placeholder="Employee Name"
                                    value="{{ old('gate_admin_id', isset($getdata->gate_admin_id) ? $getdata->gate_admin_id : '') }}" required />
                                @error('gate_admin_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="edit_id" id="edit_id"
                                    value="{{ isset($getdata->id) ? $getdata->id : '' }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">NAME<span style="color:red">*</span></label>
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
                                <label for="device_id">Device Id<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="device_id" name="device_id"
                                    placeholder="Device Id" required
                                    value="{{ old('device_id', isset($getdata->device_id) ? $getdata->device_id : '') }}"
                                     />
                                @error('device_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gate_no">Gate No</label>
                                <input type="text" class="form-control" id="gate_no" name="gate_no"
                                    placeholder="Gate No"
                                    value="{{ old('gate_no', isset($getdata->gate_no) ? $getdata->gate_no : '') }}"
                                     />
                                @error('gate_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shift">Shift</label>
                                <input type="text" class="form-control" id="shift" name="shift"
                                    placeholder="Enter Shift"
                                    value="{{ old('shift', isset($getdata->shift) ? $getdata->shift : '') }}"
                                     />
                                @error('gate_no')
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
                                @error('status')
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
