@extends('layouts.app', [
    'class' => 'login-page',
    'backgroundImagePath' => 'img/bg/fabio-mangione.jpg',
    'elementActive' => '',
])

@section('content')
    <div class="content col-md-12 ml-auto mr-auto">
        @if (session('success'))
            <div class="alert alert-info alert-dismissible fade show" role="alert" style="width:60%; margin:auto;">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show " role="alert" style="width:60%; margin:auto;">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="header py-5 pb-7 pt-lg-9">
            <div class="container col-md-10">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-12 pt-5 welcome_header">
                            <h1 class="@if (Auth::guest()) text-white @endif">
                                {{ __('Welcome to Gate Management System.') }}</h1>

                            <!-- <p class="@if (Auth::guest()) text-white @endif text-lead mt-3 mb-0">
                                        {{ __('Log in and see how you can save more than 90 hours of work with CRUDs for managing: #users, #roles, #items, #categories, #tags and more.') }}
                                    </p> -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();
        });
    </script>
@endpush
