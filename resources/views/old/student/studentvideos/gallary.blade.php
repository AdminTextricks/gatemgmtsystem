@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'therapyvideos',
])
@section('content')
    <style>
        .tooltip-inner {
            /* max-width: 420px; */
            white-space: normal;
            word-wrap: break-word;
            background-color: #2c3e50 !important;
        }

        .video_card {
            transition: all 0.6s ease;
            background: #fff;
            padding: 20px 15px;
            padding-bottom: 2px;
            border: 1px solid #d9d9d982;
            position: relative;
            width: 23.2%;
            height:23.2%;
            border-bottom: 3px solid #e50505;
            border-radius: 20px
        }

        .video_card:hover {
            transform: scale(1.1);
            box-shadow: 0px 10px 40px 0px rgb(0 0 0 / 12%);
            border: none;
            z-index: 99;
            cursor: pointer;
        }
    </style>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Child Therapy Video Gallary</h6>
                        </div>
                        <hr>
                    </div>

                    <div class="card-body">
                        @if (!empty($data))
                            @foreach ($data as $index => $getdata)
                                @php
                                    // $student = $getdata->first()->students;
                                    // dd($getdata->student_videos);
                                @endphp
                                <div class="card-header">
                                    <div class=" d-flex justify-content-between align-items-center">
                                        <h6 class="card-title mb-0"><i class="nc-icon nc-single-02"></i>
                                           {{ $getdata->student_name ?? '' }}</h6>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Video Gallery Grid -->
                                <div class="container mt-4">
                                    <!-- If no videos found -->
                                    @if ($getdata->student_videos->isEmpty())
                                        <div class="text-center text-muted mt-4">
                                            <p>No videos available.</p>
                                        </div>
                                    @else
                                        <div class="row" style="gap: 20px; margin:auto;">
                                            @foreach ($getdata->student_videos as $videos)
                                                <div class=" mb-4 video_card" style="">
                                                    <p class="card-subtitle mb-2 text-muted"
                                                        style=" text-transform: uppercase; font-size: 11px; ">
                                                        <i
                                                            class="fa-solid fa-video text-danger"></i>&nbsp;&nbsp;{{ $videos->therapy_name ?? 'Therapy Name' }}
                                                    </p>
                                                    {{-- <div class="card shadow-sm h-100"> --}}
                                                    <video controls class="card-img-top"
                                                        style="max-height: 200px; object-fit: cover;">
                                                        <source src="{{ asset('videos/student_video/' . $videos->video) }}"
                                                            type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                    @php
                                                        $description = Str::limit($videos->description ?? '', 120);
                                                    @endphp

                                                    <div class="card-body " style="padding-bottom:0px; font-size: 12px"
                                                        id="video_description" data-toggle="tooltip" data-placement="right"
                                                        title="{{ strip_tags($videos->description) }}">

                                                        <p class="card-text">
                                                            {!! $description ?? 'Description text to describe the video' !!}
                                                        </p>
                                                    </div>
                                                    {{-- </div> --}}
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                {{-- end gallary --}}
                            @endforeach
                        @else
                            <p>no student available</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>



    <script>
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });
    </script>
@endsection
