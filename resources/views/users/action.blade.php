@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'userlist',
])
@section('content')
    <style>
        .ck-editor__editable_inline {
            min-height: 100px;
        }
    </style>
    <div class="content">
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('userlist') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} User Details</p>
                </div>
                <hr>
                <form action="{{ route('user.action', ['action' => $action]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id">USER ID</label>
                                <input type="text" class="form-control" id="user_id" name="user_id"
                                    placeholder="USER ID"
                                    value="{{ old('user_id', isset($getdata->user_id) ? $getdata->user_id : '') }}"
                                    required />
                                @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="edit_id" id="edit_id"
                                    value="{{ isset($getdata->id) ? $getdata->id : '' }}" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">USER ROLE</label>
                                <select name="role" id="role" class="form-control" required>
                                    {{-- <option value="">
                                        Select Role
                                    </option> --}}
                                    {{-- <option value="admin"
                                        {{ old('', $getdata->role ?? '') == 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option> --}}
                                    {{-- <option value="teacher"
                                        {{ old('', $getdata->role ?? '') == 'teacher' ? 'selected' : '' }}>
                                        Teacher
                                    </option> --}}
                                    <option value="parent"
                                        {{ old('', $getdata->role ?? '') == 'parent' ? 'selected' : '' }}>
                                        Parent
                                    </option>
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 username">
                            <div class="form-group">
                                <label for="name">NAME</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="User Name"
                                    value="{{ old('name', isset($getdata->name) ? $getdata->name : '') }}" required />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 useremail">
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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">STATUS</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1"
                                        {{ old('status', $getdata->status ?? '') == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0"
                                        {{ old('status', $getdata->status ?? '') == 0 ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                                @error('document')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 studentids">
                            <div class="form-group">
                                <label for="student_id">Students</label>
                                <select name="student_id[]" id="student_id" class="form-control select2" multiple>
                                    <option value="">
                                        Select Student
                                    </option>
                                    @foreach ($students as $student)
                                        {
                                        <option value="{{ $student->id }}"
                                            {{ collect(old('student_id', $student_ids ?? []))->contains($student->id) ? 'selected' : '' }}>
                                            {{ $student->enroll_number }} - {{ $student->student_name }}
                                        </option>

                                        }
                                    @endforeach

                                </select>
                                @error('role')
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
    <script>
        $(document).off('closed.bs.alert');
        $(document).on('change', '#role', function() {
            var role = $(this).val();
            if (role === 'parent') {
                $('.username').addClass('d-none').find('input').prop('required', false);
                $('.useremail').addClass('d-none').find('input').prop('required', false);
                $('.studentids').removeClass('d-none').find('input').prop('required', true);

            }
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#student_id').select2({
                placeholder: "Select Students",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let student_ids = @json($student_ids);
            let user_role = @json($getdata ? $getdata->role : $role);

            if (student_ids.length > 0 || user_role === 'parent') {
                $('.studentids').removeClass('d-none');
            }
        });
    </script>
@endsection
