@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'timetablelist',
])
@section('content')
    <style>
        .ck-editor__editable_inline {
            min-height: 100px;
        }
    </style>
    <div class="content">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('timetablelist') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} Time Table Details</p>
                </div>
                <hr>
                <form action="{{ route('timetable.action') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student_id">Class</label>
                                <select id="class_masters_id " class="form-control" name="class_masters_id">
                                    <option value="">Select Class</option>
                                    @foreach ($classMaster as $class)
                                        <option value="{{ $class->id }}"
                                            {{ old('class_masters_id ', $getdata->class_masters_id ?? '') == $class->id ? 'selected' : '' }}>
                                            {{ $class->class_name ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('class_masters_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="edit_id" id="edit_id"
                                    value="{{ isset($getdata->id) ? $getdata->id : '' }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Short Description</label>
                                <input type="text" class="form-control" id="short_description" name="short_description"
                                    placeholder="Write Short Description" value="{{ old('short_description', $getdata->short_description ?? '') }}" />
                                @error('short_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">STATUS</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1"
                                        {{ old('status', $getdata->status ?? '') == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0"
                                        {{ old('status', $getdata->status ?? '') == 0 ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="col-md-6">
                            <div class="form-groupp">
                                <label for="attachment">Document</label>
                                <input type="file" class="form-control" id="document" name="document"
                                    placeholder="Document" value="" />
                                @error('document')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if (!empty($getdata->document))
                                    <div>
                                        <a href="{{ asset('teacher_documents/' . $getdata->document) }}" target="_blank"
                                            class="text-primary table_doc" title="View Doc">
                                            View Uploaded Doc
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>

    </div>
    <script>
        document.querySelectorAll('.ckeditor').forEach(function(el) {
            ClassicEditor.create(el, {
                    toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'undo',
                        'redo', 'blockQuote', 'insertTable',
                    ],

                })
                .catch(error => console.error(error));
        });
    </script>

    {{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
    <script>
        function resetenddate() {
            document.getElementById("end_date").value = '';
        }

        function calculateDays() {
            // Get input field values
            const start_date = document.getElementById("start_date").value;
            const end_date = document.getElementById("end_date").value;

            // Validation check
            if (!start_date || !end_date) {
                alert("Please select both start and end dates");
                document.getElementById("start_date").value = '';
                document.getElementById("end_date").value = '';
                return;
            }
            // Convert to Date objects
            const start = new Date(start_date);
            const end = new Date(end_date);

            // Calculate difference in milliseconds
            const diffInMs = end - start;

            // Convert milliseconds to days
            const diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24)) + 1;
            if (diffInDays <= 0) {
                alert("Start date must be less then end date.");
                document.getElementById("start_date").value = '';
                document.getElementById("end_date").value = '';
                return false;
            }
            // Show result
            document.getElementById("total_days").value = diffInDays;
        }
    </script>
@endsection
