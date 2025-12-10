@extends('layouts.app', [
    'class' => 'login-page',
    'backgroundImagePath' => 'img/bg/fabio-mangione.jpg',
    'elementActive' => '',
])

@section('content')
    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel"
        aria-hidden="true" style="max-width: 80%; margin:auto;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <form id="forgotPasswordForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Enter your registered email address. We’ll notify the admin to reset your password.</p>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" name="email" id="forgotEmail"
                                placeholder="Enter your email" required>
                        </div>
                        <div id="forgotMsg" class="mt-2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning sign_in_button">
                            <div class="spinner-border spinner-border-sm text-warning d-none " role="status">
                                {{-- <span class="sr-only">Loading...</span> --}}
                            </div>
                            <span class="btn-text">{{ __('Send') }}</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- End Forgot Password Modal --}}

    <div class="content" style="padding-top:6vh;">
        <div class="container d-flex justify-content-center">
            <div class=" welcome_header d-none text-center " style="font-size:.8rem; margin-top:20vh;">
                <h1 class="@if (Auth::guest()) text-white @endif">
                    {{ __('Welcome to Gate Management System.') }}</h1>
            </div>
            <div class="card  ml-auto mr-auto login_content col-lg-4 col-md-6 p-0">
                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class=" card-login" style="border-bottom: 3px solid #f5a601; border-top: 3px solid #f5a601">
                        <button type="button" class="close text-right p-1" data-dismiss="login_content" aria-label="Close"
                            style="position: absolute; right: 1px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="logo text-center mt-4 mb-2">
                            <a href="#" class="simple-text logo-mini">
                                <div class="logo-image-small">
                                    {{-- <label><strong>LOGIN</strong></label> --}}
                                    <img src="{{ asset('paper') }}/img/logo_gate.png" style="width: 20%;">

                                </div>
                            </a>
                        </div>
                        <div class="card-header p-0" style="margin-bottom: 1.5rem !important;">
                            <div class="card-header ">
                                <h6 class="header text-center m-0">{{ __('Sign In') }}</h6>
                            </div>
                        </div>
                        <div class="card-body ">
                            {{-- <label><strong>LOGIN AS</strong></label> --}}
                            <div class="form-group">
                                {{-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" id="roleAdmin"
                                        value="admin" required>
                                    <label class="form-check-label p-0" for="roleAdmin">Admin</label>
                                </div> --}}

                            </div>
                            <div class="input-group"  style="margin-bottom: 1.6rem;  border: .8px solid lightgray !important; border-radius: 6px">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="padding:8px !important">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input class="form-control" placeholder="{{ __('UserName') }}" type="text" name="login"
                                    value="{{ old('login') }}" required autofocus>

                                @if ($errors->has('login'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-group"
                                style="margin-bottom: 1.6rem;  border: .8px solid lightgray !important; border-radius: 6px">    
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="padding:8px !important">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input class="form-control" name="password" placeholder="{{ __('Password') }}"
                                    type="password" id="password" required>
                                <i class="fa fa-eye-slash" aria-hidden="true" id="showHidePassword"
                                    style="position: absolute; font-size:15px; right: 10px;
                                                    top: 30%; cursor: pointer; z-index:1032"></i>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group d-flex justify-content-between align-item-center">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="remember" type="checkbox" value=""
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <span class="form-check-sign"></span>
                                        {{ __('Remember me') }}
                                    </label>
                                </div>
                                <div class="forgetpass">
                                    <!-- Login Page -->
                                    <a href="#" data-toggle="modal" data-target="#forgotPasswordModal"
                                        style="font-size:.7rem;">Forgot
                                        Your Password?</a>

                                </div>
                            </div>
                            <div class="card-footer p-0">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-warning btn-round mb-1 sign_in_button ">
                                        <div class="spinner-border spinner-border-sm text-warning d-none " role="status">
                                        </div>
                                        <span class="btn-text">{{ __('Sign in') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
        </div>

    </div>




    {{-- <script src="{{ asset('paper') }}/js/core/jquery.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();
        });
    </script>
    <script>
        $(document).on("click", "[data-dismiss='login_content']", function() {
            $(".login_content").addClass('d-none');
            $(".welcome_header").removeClass('d-none');
        });

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
            var btn = $(this).find('.sign_in_button');
            btn.find('.spinner-border').removeClass('d-none');
            btn.find('.btn-text').text('Loading...');
        });
    </script>

    <script>
        $('#forgotPasswordForm').on('submit', function(e) {
            e.preventDefault();
            let email = $('#forgotEmail').val();
            $.ajax({
                url: "{{ route('forgot.send') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    email: email
                },
                success: function(response) {
                    $('#forgotMsg').html('<div class="alert alert-success">' + response.message +
                        '</div>');
                    $('#forgotPasswordForm')[0].reset();
                    var $btn = $('.sign_in_button');
                    $btn.find('.spinner-border').addClass('d-none');
                    $btn.find('.btn-text').text('Send');

                    setTimeout(function() {
                        $('#forgotMsg').fadeOut('slow', function() {
                            $(this).html('').show();
                        });
                    }, 5000);
                },
                error: function(xhr) {
                    $('#forgotMsg').html(
                        '<div class="alert alert-danger">Failed to send email. Please Check the mail or Try again later.</div>'
                    );
                }
            });
        });
    </script>
@endsection
