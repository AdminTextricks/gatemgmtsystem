@extends('layouts.app', [
'class' => '',
'elementActive' => 'disabilitylist'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class=" d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Disability List</h6>
                        <a href="{{route('disability_action',['action'=>'Add'])}}" class="btn btn-sm btn-outline-info pull-right"><i class="fa fa-plus"></i>&nbsp;Add Disability</a>

                    </div>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if(session('success'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <table class="table text-center table-bordered alltable" id="disability">
                            <thead class="text-primary">
                                <tr>
                                    <th>Disability ID</th>
                                    <th>Disability NAME</th>
                                    <th>Description</th>
                                    <th class="not-export">ACTION</th>
                                </tr>
                            </thead>
                            
                            <tbody>

                                @foreach($data as $disability)
                                <tr>
                                    <td>{{ $disability->disability_id ?? 'NA'}}</td>
                                    <td>{{ $disability->disability_name ?? 'NA' }}</td>
                                    <td>{{ $disability->description ?? 'NA' }}</td>
                                    <td class="not-export">
                                        <a href="{{ route('disability_action', ['action'=>'Edit','id'=>$disability->id]) }}" class="text-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>&nbsp;
                                        <a href="javascript:void(0)" class="text-danger" onclick="deletedisability('{{ route('disability.delete', $disability->id) }}')">
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
</div>


<script>
    function deletedisability(url) {
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