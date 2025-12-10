@extends('layouts.app', [
'class' => '',
'elementActive' => 'citylist'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class=" d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> City List</h6>
                        <a href="{{route('city_action',['action'=>'Add'])}}" class="btn btn-sm btn-outline-info pull-right"><i class="fa fa-plus"></i>&nbsp;Add City List</a>

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
                        <table class="table text-center table-bordered alltable" id="example">
                            <thead class="text-primary">
                                <tr>
                                    <th>City Name</th>
                                    <th>State</th>
                                    <th>Own City</th>
                                    <th class="not-export">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($data as $citymaster)
                                <tr>
                                    <td>{{ $citymaster->city_name ?? 'NA'}}</td>
                                    <td>{{ $citymaster->state->state_name ?? 'NA' }}</td>
                                    <td>{{ $citymaster->own_city ?? 'NA' }}</td>
                                    <td class="not-export">
                                        <a href="{{ route('city_action', ['action'=>'Edit','id'=>$citymaster->id]) }}" class="text-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>&nbsp;
                                        <a href="javascript:void(0)" class="text-danger" onclick="deleteCity('{{ route('city.delete', $citymaster->id) }}')">
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
    function deleteCity(url) {
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