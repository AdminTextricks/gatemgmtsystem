@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'teacherlist',
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> TeacherList</h6>
                            <a href="{{ route('teacher_action', ['action' => 'Add']) }}"
                                class="btn btn-sm btn-outline-info pull-right"><i class="fa fa-plus"></i>&nbsp;Add
                                TeacherList</a>

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
                                        <th>TEACHER ID</th>
                                        <th> NAME</th>
                                        <th>CLASS</th>
                                        <th>MOBILE</th>
                                        <th>E-MAIL</th>
                                        <th>QUA.</th>
                                        <th>RCI REG</th>
                                        <th>DOCUMENT </th>
                                        <th>STATUS</th>
                                        <th class="not-export">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $getdata)
                                        <tr>
                                            <td>{{ $getdata->teacher_id ?? 'NA' }} </td>
                                            <td>{{ $getdata->teacher_name ?? 'NA' }}</td>
                                            <td>{{ $getdata->class->class_name ?? 'NA' }}</td>
                                            {{-- <td>{!! $getdata->address ?? 'NA' !!}</td> --}}
                                            <td>{{ $getdata->mobile ?? 'NA' }}</td>
                                            <td>{{ $getdata->email ?? 'NA' }}</td>
                                            @php
                                                $qualificationArray = explode(',', $getdata->qualification ?? '');
                                            @endphp
                                            <td>
                                                @foreach ($qualificationArray as $qualification)
                                                    {{ $qualification ?? '' }}<br>
                                                @endforeach
                                            </td>
                                            <td>{{ $getdata->rci_registration ?? 'NA' }}</td>
                                            <td class="not-export">
                                                <a class="text-primary teacher_doc" title="View" data-toggle="modal"
                                                    data-target="#PhotoModal"
                                                    data-src="{{ asset($getdata->document? $getdata->document :'teacher_documents/'.'No_image.jpg') }}">
                                                    <img src="{{ asset($getdata->document? $getdata->document :'teacher_documents/'.'No_image.jpg') }}"
                                                        class="card-img-top" alt="Image"
                                                        style="width: 50px; object-fit: cover; cursor: pointer;">
                                                </a>

                                            </td>
                                            <td><button type="button"
                                                    class="btn btn-primary border-0 p-1 text-capitalize statusBtn"
                                                    data-toggle="modal" data-target="#myModal"
                                                    data-id="{{ $getdata->id }}" data-status="{{ $getdata->status }}">
                                                    {{ $getdata->status ? 'Active' : 'InActive' }}</button></td>
                                            <td class="not-export">
                                                <a href="{{ route('teacher_action', ['action' => 'Edit', 'id' => $getdata->id]) }}"
                                                    class="text-primary">
                                                    <i class="fa fa-edit
                                            "></i>
                                                </a>&nbsp;

                                                <a href="javascript:void(0)" class="text-danger"
                                                    onclick="deleteClass('{{ route('teacher.delete', $getdata->id) }}')">
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

        <!-- Status Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Update Status</h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form>
                            @csrf
                            <select name="status" id="status" class="form-control p-2">
                                <option value="1" {{ ($userdata->status ?? '') == 1 ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="0" {{ ($userdata->status ?? '') == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary update_status">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
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

    <script>
        $('.teacher_doc').on('click', function(e) {
            var photoUrl = $(this).data('src');
            var photoImg = document.getElementById('StudentImage');
            photoImg.src = photoUrl;

        });
    </script>

        <script>
            function deleteClass(url) {
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
        {{-- <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> --}}
        <script>
            let teacherId = null;
            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var status = button.data('status');
                teacherId = button.data('id');
                $(this).find('#status').val(status);

            });
            $(document).on('click', '.update_status', function() {
                let status = $('#status').val();
                $.ajax({
                    url: "{{ url('teacherlist/updatestatus') }}/" + teacherId,
                    type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status,
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function() {
                        alert('Something went wrong');
                    }
                })
            });
        </script>
    @endsection
