@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'therapyvideos',
])
@section('content')
    <style>
        .tooltip-inner {
            max-width: 420px;
            white-space: normal;
            word-wrap: break-word;
        }
    </style>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Student Therapy Video List</h6>
                            @if ($user->role != 'parent')
                                <a href="{{ route('therapyvideo.action', ['action' => 'Add']) }}"
                                    class="btn btn-sm btn-outline-info pull-right"><i class="fa fa-plus"></i>&nbsp;Add
                                    Video</a>
                            @endif

                        </div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if (session('success'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <table class="table text-center table-bordered alltable" id="example">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Student</th>
                                        <th>Class</th>
                                        <th>Therapy</th>
                                        {{-- <th>Domain</th> --}}
                                        <th>Video Description</th>
                                        <th>Video</th>
                                        <th class="not-export">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $getdata)
                                        <tr>
                                            <td>
                                                {{ Str::upper($getdata->students->student_name) ?? 'NA' }}
                                            </td>
                                            <td>{{ $getdata->students->cur_class->class_name ?? 'NA' }}</td>
                                            <td>{{ $getdata->therapy_name ?? 'NA' }}</td>
                                            <td id="video_description" data-toggle="tooltip" data-placement="top"
                                                title="{{ strip_tags($getdata->description) }}">
                                                {!! Str::limit($getdata->description ?? 'NA', 60) !!}
                                            </td>

                                            <td>
                                                @if (!empty($getdata->video))
                                                    <div class="card" style="margin:0px;">
                                                        <button type="button" class="btn btn-sm" id="video_btn"
                                                            style="background:#d30202; width:75%; margin:auto;"
                                                            data-toggle="modal" data-target="#videoModal"
                                                            data-src="{{ asset('videos/student_video/' . $getdata->video) }}">
                                                            <i class="nc-icon nc-button-play"></i>
                                                        </button>
                                                    </div>
                                                @else
                                                    N/A
                                                @endif

                                            </td>
                                            <td class="not-export">
                                                <a href="{{ route('therapyvideo.action', ['action' => 'Edit', 'id' => $getdata->id]) }}"
                                                    class="text-primary" title="Edit" data-toggle="tooltip"
                                                    data-placement="bottom">
                                                    <i class="fa fa-edit"></i>
                                                </a>&nbsp;

                                                <a href="javascript:void(0)" class="text-danger"
                                                    onclick="deleteStudent('{{ route('video.delete', $getdata->id) }}')"
                                                    title="Delete" data-toggle="tooltip" data-placement="top">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- PHOTO modal --}}
         <div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog">
            <div class="modal-dialog " role="document">
                <div class="modal-content">

                    <div class="qrcontainer" id="PhotoCode">
                        <div class="modal-header">
                            <h6 class="modal-title">Student Photo</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body p-0">
                            <img id="StudentImage" src="#" controls autoplay />
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">

                    </div>

                </div>
            </div>
        </div> 
        {{-- video modal --}}
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" style="width:500px !important; height:300px !important; margin:auto;">

                    <!-- Header with Close Button -->
                    <div class="modal-header">
                        <h6 class="modal-title">Video Player</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body p-0"
                    style="width:500px !important; height:300px !important; margin:auto; object-fit: contain !important;">
                        <video id="modalVideo" controls autoplay style="width:100% !important; height:100% !important; object-fit: contain !important; background: #000;">>
                            <source src="#" type="video/mp4">
                            Your browser does not support video.
                        </video>
                    </div>

                </div>
            </div>
        </div>
        {{-- end video modal --}}
    </div>

    <script>
        $('.student_photo').on('click', function(e) {
            var photoUrl = $(this).data('src');
            var photoImg = document.getElementById('StudentImage');
            photoImg.src = photoUrl;

        });
    </script>

    <script>
        $('#videoModal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var src = button.data('src');
            var video = document.getElementById('modalVideo');
            video.src = src;
            video.load();
            video.play();
        });

        var videoIcon = $('#video_btn');
        $('#videoModal').on('hidden.bs.modal', function() {
            var video = document.getElementById('modalVideo');
            video.pause();
            video.currentTime = 0;
            video.removeAttribute('src');
            videoIcon.css('background', '#d30202');
        });
    </script>

    <script>
        function deleteStudent(url) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire("Deleted!", "Your record has been deleted.", "success")
                                    .then(() => location.reload()); // Refresh page after success
                            } else {
                                Swal.fire("Error!", "Failed to delete the record.", "error");
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire("Error!", "Something went wrong.", "error");
                        });
                }
            });
        }
    </script>

    <script>
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });
    </script>
@endsection
