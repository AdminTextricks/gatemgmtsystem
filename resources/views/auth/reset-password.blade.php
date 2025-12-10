@extends('layouts.app', [
    'class' => 'login-page',
    'backgroundImagePath' => 'img/bg/asha_school.png',
    'elementActive' => '',
])

@section('content')
    {{-- <div class="container mt-5" style="max-width: 400px;"> --}}
    <div class="content" style="padding-top:6vh;">
        <div class="container d-flex justify-content-center">
            {{-- <h3>Reset Password</h3>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group mt-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label>New Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3 w-100">Reset Password</button>
    </form> --}}


            <div class="card  ml-auto mr-auto login_content col-lg-4 col-md-6 p-0">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <div class=" card-login" style="border-bottom: 3px solid #f5a601; border-top: 3px solid #f5a601">
                        <button type="button" class="close text-right p-1" data-dismiss="login_content" aria-label="Close"
                            style="position: absolute; right: 1px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="logo text-center mt-2">
                            <a href="#" class="simple-text logo-mini">
                                <div class="logo-image-small">
                                    <img src="{{ asset('paper') }}/img/logo.png" style="width: 20%;">
                                </div>
                            </a>
                        </div>
                        <div class="card-header p-0 ">
                            <div class="card-header ">
                                <h6 class="header text-center m-0">{{ __('Reset Password') }}</h6>
                            </div>
                        </div>
                        <div class="card-body ">
                            <input type="hidden" name="token" value="{{ $token }}">

                            <label>Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <label>New Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input class="form-control" name="password" placeholder="{{ __('Password') }}"
                                    type="password"  required>
                                {{-- <i class="fa fa-eye-slash" aria-hidden="true" id="showHidePassword"
                                    style="position: absolute; font-size:15px; right: 10px;
                                                    top: 30%; cursor: pointer; z-index:1032"></i> --}}
                            </div>
                            <label>Confirm Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input class="form-control" name="password_confirmation" placeholder="{{ __('Password') }}"
                                    type="password" id="password" required>
                                <i class="fa fa-eye-slash" aria-hidden="true" id="showHidePassword"
                                    style="position: absolute; font-size:15px; right: 10px;
                                                    top: 30%; cursor: pointer; z-index:1032"></i>
                            </div>

                            <div class="card-footer p-0">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-warning btn-round mb-1 reset_button ">
                                        <div class="spinner-border spinner-border-sm text-warning d-none " role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <span class="btn-text">{{ __('Reset Password') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();
        });
    </script>
    <script>
        // Toggle password using eye button
        $('#showHidePassword').on('click', function() {
            var userPassword = $('#password');
            var inputType = userPassword.attr('type');
            if (inputType === "password") {
                userPassword.attr('type', 'text');
            } else {
                userPassword.attr('type', 'password');
            }
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        })

         //Run Spinner loader on submit
        $(document).on('submit', 'form', function(e) {
            var $btn = $(this).find('.reset_button');
            $btn.find('.spinner-border').removeClass('d-none');
            $btn.find('.btn-text').text('Signing in...');
        });
    </script>
@endsection
