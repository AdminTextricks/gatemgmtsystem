@extends('layouts.app', [
'class' => '',
'elementActive' => 'studentFLY'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class=" d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Student List</h6>
                        <a href="{{route('student_action',['action'=>'Add'])}}" class="btn btn-sm btn-outline-info pull-right"><i class="fa fa-plus"></i>&nbsp;Add Student</a>

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
                                    <th>Photo</th>
                                    <th>Enroll Number</th>
                                    <th>Class Name</th>
                                    <th>Student Name</th>
                                    <th>Parent</th>
                                    <th>Mobile</th>
                                    <th>Disability</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($data as $studentmaster)
                                <tr>
                                    <td> 
                                        <img src="{{ asset('student_documents/' . (isset($studentmaster->student_documents->image) && $studentmaster->student_documents->image ? $studentmaster->student_documents->image : 'No_image.jpg')) }}" class="card-img-top" alt="Image" style="width: 50px; object-fit: cover;">
                                       
                                    </td>
                                    <td>{{ $studentmaster->enroll_number ?? 'NA'}}</td>
                                    <td>{{ $studentmaster->class->class_name ?? 'NA' }}</td>
                                    <td>{{ $studentmaster->student_name ?? 'NA' }}</td>
                                    <td>{{ $studentmaster->fathers_name ?? 'NA' }}</td>
                                    <td>{{ $studentmaster->mobile ?? 'NA' }}</td>
                                    <td>{{ $studentmaster->disability->disability_name ?? 'NA' }}</td>
                                    <td>
                                        <a href="{{ route('student_action', ['action'=>'Edit','id'=>$studentmaster->id]) }}" class="text-primary" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>&nbsp;
                                        <a href="{{ route('student_documents', ['action'=>'Edit','student_id'=>$studentmaster->id]) }}" class="text-primary" title="Documents">
                                            <i class="fa fa-file"></i>
                                        </a>&nbsp;
                                        <a href="javascript:void(0)" class="text-danger" onclick="deleteStudent('{{ route('student.delete', $studentmaster->id) }}')" title="Delete">
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


@endsection