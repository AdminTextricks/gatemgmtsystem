@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard',
])

@section('content')
    <style>
        /* Custom style for file input */
        .form-group input[type="file"] {
            opacity: 1;
            position: relative;
        }

        .item-card {
            position: relative;
            cursor: pointer;
        }

        .item-card .btn-list.onhover {
            position: absolute;
            top: 1%;
            right: -28%;
            transition: all 0.5s ease;
            opacity: 0;
            visibility: hidden;

        }

        .item-card:hover .btn-list.onhover {
            right: 2%;
            opacity: 1;
            visibility: visible;
        }

        .card .btn-list.onhover a.viewIcon {
            display: block;
            width: 30px;
            background: white;

        }

        .viewIcon {
            padding: 4px;
            font-size: 12px;
            color: #30afa3;
            display: inline-block;
            text-align: center;
            border-radius: 3px;
            border: none;
            background: white;
        }
    </style>
    {{-- <div class="content"> --}}
    <div class="container-fluid">
        @php
            use Carbon\Carbon;
            $user = auth()->user();
            $sessions_asc = getSessions();
            $sessions = array_reverse($sessions_asc);
            $today = Carbon::today();
            $year = $today->year;
            $currentSession = $year . '-' . ($year + 1);
        @endphp

        <div class="form-group row align-items-center p-2 mt-3">
            <div class="col-md-8 col-sm-12 d-flex align-items-center mb-2 mb-md-0">
                <h6 class="card-title mb-0">
                    <i class="nc-icon nc-tile-56"></i> Parent Dashboard
                </h6>
            </div>

            <div class="col-md-4 col-sm-12 d-flex align-items-center justify-content-md-end">
                <label for="session" class="mb-0 mr-2 font-weight-bold text-nowrap">SESSION:</label>
                {{-- @foreach ($sessions as $session)
                        <option value="{{ $session }}" {{ old('session') }}>
                            {{ $session }} </option>
                    @endforeach --}}
                {{-- <select class="form-control w-auto" id="session" name="session" >
                        <option value="{{ $currentSession }}" {{ old('session') }}>
                            {{ $currentSession }}
                        </option>
                    </select> --}}
                {{ $currentSession }}
                @error('session')
                    <span class="text-danger ml-2">{{ $message }}</span>
                @enderror
            </div>
        </div>


        {{-- Start New Dashboard --}}
        <hr>
        <div class="container row m-0 mt-4 ">
            @foreach ($students as $student)
                <div class="col-lg-4 col-md-6 item-card" style="z-index: 1031;">
                    <a style="color: #51cbd1!important; border-radius:20px" class="card"
                        href="{{ route('studentdetailsbyid', ['id' => $student->id]) }}" target="_blank">
                        <div class="card card-primary" style="border-bottom: 3px solid #e50505; margin-bottom:0;">
                            @php
                                $timetablestatus = $student?->cur_class?->timetable?->status;
                                $timetable = null;
                                if ($timetablestatus != 0) {
                                    $timetable = $student?->cur_class?->timetable?->document;
                                }
                            @endphp
                            @if (!empty($timetable))
                                <div class="btn-list onhover d-flex justify-content-center  mt-4">
                                    <button class=" viewIcon text-info " data-toggle="tooltip" data-placement="bottom"
                                    id="viewDocumentBtn"  data-file="{{ asset('teacher_documents/' . $timetable) }}"   title="Time Table" target="_blank">
                                        <i class="fa-solid fa-calendar-days" style="font-size: 1rem;"></i>
                                    </button>&nbsp;
                                </div>
                            @endif
                            <img src="{{ asset('student_documents/' . (isset($student->student_documents->image) ? $student->student_documents->image : 'No_image.jpg')) }}"
                                class="card-img-top" alt="Card image cap"
                                style="width: 100%; height: 300px; object-fit: cover; padding:6px">
                            <h6 class="card-title text-center mt-2">
                                {{ $student->enroll_number }} - {{ $student->student_name }}
                            </h6>
                        </div>
                    </a>
                </div>
                {{-- </div> --}}
            @endforeach
        </div>
        {{-- End Start New Dashboard --}}
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('viewDocumentBtn');
        if (btn) {
            btn.addEventListener('click', function() {
                const fileUrl = this.getAttribute('data-file');
                if (fileUrl) {
                    window.open(fileUrl, '_blank'); 
                } else {
                    alert('Document not found.');
                }
            });
        }
    });
</script>
@endsection
