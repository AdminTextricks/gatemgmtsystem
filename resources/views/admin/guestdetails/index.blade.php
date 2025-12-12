@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'guestlist',
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Visitor List</h6>
                            <a href="{{ route('guest_action', ['action' => 'Add']) }}"
                                class="btn btn-sm btn-outline-info pull-right"><i class="fa fa-plus"></i>&nbsp;Add New
                                Visitor</a>

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
                                        <th>NAME</th>
                                        <th>E-MAIL</th>
                                        <th>MOBILE</th>
                                        <th>UNIQUE ID</th>
                                        <th>DATE</th>
                                        <th>DURATION</th>
                                        <th>ALLOW DAYS</th>
                                        <th>STATUS</th>
                                        <th class="not-export">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $getdata)
                                        <tr>
                                            <td>{{ $getdata->name ?? 'NA' }}</td>
                                            <td>{{ $getdata->email ?? 'NA' }}</td>
                                            <td>{{ $getdata->mobile  ?? 'NA' }}</td>
                                            <td>{{ $getdata->uid  ?? 'NA' }}</td>
                                            <td>{{ $getdata->date   ?? 'NA' }}</td>
                                            <td>{{ $getdata->duration   ?? 'NA' }}</td>
                                            <td>{{ $getdata->max_allow_days   ?? 'NA' }}</td>
                                            <td><button type="button"
                                                    class="btn btn-primary border-0 p-1 text-capitalize statusBtn"
                                                    data-toggle="modal" data-target="#myModal"
                                                    data-id="{{ $getdata->id }}" data-status="{{ $getdata->status }}">
                                                    {{ $getdata->status ? 'Active' : 'InActive' }}</button></td>
                                            <td class="not-export">
                                                <a href="{{ route('guest_action', ['action' => 'Edit', 'id' => $getdata->id]) }}"
                                                    class="text-primary">
                                                    <i class="fa fa-edit
                                            "></i>
                                                </a>&nbsp;

                                                <a href="javascript:void(0)" class="text-danger"
                                                    onclick="deleteVisitor('{{ route('guest.delete', $getdata->id) }}')">
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

        <script>
            function deleteVisitor(url) {
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
            let visitorId = null;
            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var status = button.data('status');
                visitorId = button.data('id');
                $(this).find('#status').val(status);

            });
            $(document).on('click', '.update_status', function() {
                let status = $('#status').val();
                $.ajax({
                    url: "{{ url('visitorlist/updatestatus') }}/" + teacherId,
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
