@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'equipmentlist',
])

@section('content')
    <style>
        .tooltip-inner {
            max-width: 420px;
            white-space: normal;
            word-wrap: break-word;
            background-color: #2c3e50 !important;
        }
    </style>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Equipment List</h6>
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('equipment_action', ['action' => 'Add']) }}"
                                    class="btn btn-sm btn-outline-info pull-right"><i class="fa fa-plus"></i>&nbsp;Add
                                    Equipment</a>
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
                                        <th>Equipment ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Date of Purchase</th>
                                        <th>Warranty Status</th>
                                        <th>Service Status</th>
                                        <th>Image</th>
                                        <th>Demo Video</th>
                                        @if (Auth::user()->role === 'admin')
                                            <th class="not-export">ACTION</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $equipment)
                                        <tr>
                                            <td>{{ $equipment->equipment_id ?? 'NA' }}</td>
                                            <td>{{ $equipment->name ?? 'NA' }}</td>
                                            <td data-toggle="tooltip" data-placement="top"
                                                title="{{ $equipment->description ?? 'NA' }}">{!! Str::limit($equipment->description ?? '', 60) ?? 'NA' !!}</td>
                                            <td>{{ $equipment->date_of_purchase ?? 'NA' }}</td>
                                            <td>{{ $equipment->warranty_status ?? 'NA' }}</td>
                                            <td>{{ $equipment->service_status ?? 'NA' }}</td>
                                            <td>
                                                <div class="card">
                                                    <a class="text-primary student_photo" title="View" data-toggle="modal"
                                                        data-target="#PhotoModal"
                                                        data-src="{{ asset('images/' . ($equipment->image??'')) }}">
                                                        <img src="{{ asset('images/' . ($equipment->image??'')) }}"
                                                            class="card-img-top" alt="Image"
                                                            style="width: 70px; object-fit: cover; cursor: pointer;">
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                @if (!empty($equipment->eqp_video))
                                                    <div class="card" style="max-width:80%; height:auto;">
                                                        <button type="button" class="btn btn-sm" id="video_btn"
                                                            style="background:#d30202;" data-toggle="modal"
                                                            data-target="#videoModal"
                                                            data-src="{{ asset('videos/' . $equipment->eqp_video ?? '') }}"
                                                            data-eqp_name="{{ $equipment->name ?? '' }}">

                                                            <i class="nc-icon nc-button-play"></i>
                                                        </button>
                                                    </div>
                                                @else
                                                    N/A
                                                @endif

                                            </td>
                                            @if (Auth::user()->role === 'admin')
                                                <td class="not-export">
                                                    <a href="{{ route('equipment_action', ['action' => 'Edit', 'id' => $equipment->id]) }}"
                                                        class="text-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>&nbsp;
                                                    <a href="javascript:void(0)" class="text-danger"
                                                        onclick="deleteEquipment('{{ route('equipment.delete', $equipment->id) }}')">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

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
                    <!-- Header with Close Button -->
                    <div class="modal-header">
                        <h6 class="modal-title">Uploaded Receipt Image</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body p-0">
                        <img id="StudentImage" src="#" controls autoplay />
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer justify-content-between">
                    <!-- <span> Photo student details.</span> -->

                </div>

            </div>
        </div>
    </div>
    {{-- end Photo modal --}}

    {{-- video modal --}}
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="width:500px !important; height:300px !important; margin:auto;">

                <!-- Header with Close Button -->
                <div class="modal-header">
                    <h6 class="modal-title" id="eqp_video_title">Equipment Video</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body p-0"
                    style="width:500px !important; height:300px !important; margin:auto; object-fit: contain !important;">
                    <video id="modalVideo" controls autoplay
                        style="width:100% !important; height:100% !important; object-fit: contain !important; background: #000;">
                        <source src="#" type="video/mp4">
                        Your browser does not support video.
                    </video>
                </div>

            </div>
        </div>
    </div>
    {{-- end video modal --}}
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
            var eqp_name = button.data('eqp_name');
            var video = document.getElementById('modalVideo');
            $('#eqp_video_title').text(eqp_name + ' Video');
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
        function deleteEquipment(url) {
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
@endsection
