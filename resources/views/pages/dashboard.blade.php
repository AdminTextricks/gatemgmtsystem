@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard',
])

@section('content')
    <style>
        .card-stats {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-stats:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
        }

        .icon-container {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fce4ec;
            border-radius: 50%;
            animation: fadeIn 0.8s ease-in-out;
        }

        .icon-container i {
            font-size: 28px;
            color: #e91e63;
        }

        .numbers p {
            margin: 0;
            font-weight: 600;
        }

        .card-footer {
            font-size: 14px;
            color: #555;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 0 0 12px 12px;
            padding: 10px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
    {{-- <div class="content"> --}}
    <div class="container-fluid">

        @php
            use Carbon\Carbon;
            $user = auth()->user();
            // $sessions_asc = getSessions();
            // $sessions = array_reverse($sessions_asc);
            $today = Carbon::today();
            // $year = $today->year;
            // $currentSession = $year . '-' . ($year + 1);
        @endphp


        {{-- Start New Dashboard --}}
        <hr>
        <div class="container row m-0 mt-4 ">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4  col-md-6">
                                <div class="icon-container">
                                    <i class="nc-icon nc-badge"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8 text-right">
                                <div class="numbers">
                                    <p class="card-category text-muted">Students</p>
                                    <p class="card-title text-lg font-bold">351</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <i class="fa fa-link"></i> Total Students
                    </div>
                </div>
            </div>

            {{-- @foreach ($classes as $class)
                <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                    <div class="card card-stats">
                        <div class="card-body student_card" style="cursor: pointer;">
                            <input type="hidden" value="{{ $class->id }}" class="student_class">
                            <div class="row">
                                <div class="col-5 col-md-4 p-2">
                                    <div class="icon-container">
                                        <i class="fa {{ $iconMap[$loop->index] ?? 'fa-child' }}"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8 p-2">
                                    <div class="numbers">
                                        <p class="card-title">{{ $class->students_count }}
                                        <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-category text-center student_cat">
                            <i class="fa fa-link"></i> {{ $class->class_name }}
                        </div>
                    </div>
                </div>
            @endforeach --}}

        </div>
    </div>

    <hr class="custom-shadow">


    {{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
    
    {{-- <script>
        $(document).ready(function() {
            $('.student_disability_card').on('click', function() {
                // var card = $(this).closest('.student_disability');
                var disability_id = $(this).find('.student_disability').val();
                window.location.href = '/studentlist/studentbytype/disability/' + disability_id;
            })
        });
    </script> --}}
@endsection
