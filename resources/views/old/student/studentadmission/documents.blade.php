@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'studentlist',
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
            top: 2%;
            right: -28%;
            transition: all 0.5s ease;
            opacity: 0;
            visibility: hidden;
        }

        .item-card:hover .btn-list.onhover {
            right: 1%;
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
    <div class="content">
        @if (session('success'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} Documents</p>
                </div>
                <hr>
                <form action="{{ route('student.documents') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="enroll_number">Enroll No.</label>
                                <input type="text" class="form-control" id="enroll_number" name="enroll_number"
                                    placeholder="Enroll No."
                                    value="{{ isset($getdata->enroll_number) ? $getdata->enroll_number : '' }}" disabled />
                                @error('enroll_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <!-- <input type="hidden" name="edit_id" id="edit_id" value="{{ isset($getdata->id) ? $getdata->id : '' }}" /> -->
                                <input type="hidden" name="student_id" id="student_id"
                                    value="{{ isset($getdata->id) ? $getdata->id : '' }}" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student_name">Student Name</label>
                                <input type="text" class="form-control" id="student_name" name="student_name"
                                    placeholder="Admission Date"
                                    value="{{ isset($getdata->student_name) ? $getdata->student_name : '' }}" disabled />
                                @error('student_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="class_id">Class</label>
                                <select class="form-control" id="class_id" name="class_id" disabled>
                                    <option value="">Select Class</option>
                                    @foreach ($classMaster as $class)
                                        <option value="{{ $class->id }}"
                                            @if (isset($getdata->cur_class_id) && $getdata->cur_class_id == $class->id) selected @endif> {{ $class->class_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3 item-card">
                            <div class="card ">
                                @if (isset($documentData->image))
                                    <div class="btn-list onhover">
                                        <button type="button" class="viewIcon delete_student" data-toggle="tooltip"
                                            data-placement="top" style="color: #d52031;" title="Delete Student"
                                            data-column="image"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                @endif
                                <img src="{{ asset('student_documents/' . (isset($documentData->image) && $documentData->image ? $documentData->image : 'No_image.jpg')) }}"
                                    class="card-img-top" alt="Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image">Photo</label>
                                <input type="file" name="image" id="image"
                                    class="form-control @error('image') is-invalid @enderror" placeholder="Image">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 item-card">
                            <div class="card">
                                @if (isset($documentData->udid_certificate_image))
                                    <div class="btn-list onhover">
                                        <button type="button" class="viewIcon delete_student" data-toggle="tooltip"
                                            data-placement="top" style="color: #d52031;" title="Delete Student"
                                            data-column="udid_certificate_image"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                @endif
                                <img src="{{ asset('student_documents/' . (isset($documentData->udid_certificate_image) && $documentData->udid_certificate_image ? $documentData->udid_certificate_image : 'No_image.jpg')) }}"
                                    class="card-img-top" alt="Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="udid_certificate_image">UDID Certificate</label>
                                <input type="file" name="udid_certificate_image" id="udid_certificate_image"
                                    class="form-control @error('udid_certificate_image') is-invalid @enderror"
                                    placeholder="udid Certificate Image">
                                @error('udid_certificate_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 item-card">
                            <div class="card">
                                @if (isset($documentData->aadhar_image))
                                    <div class="btn-list onhover">
                                        <button type="button" class="viewIcon delete_student" data-toggle="tooltip"
                                            data-placement="top" style="color: #d52031;" title="Delete Student"
                                            data-column="aadhar_image"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                @endif
                                <img src="{{ asset('student_documents/' . (isset($documentData->aadhar_image) && $documentData->aadhar_image ? $documentData->aadhar_image : 'No_image.jpg')) }}"
                                    class="card-img-top" alt="Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="aadhar_image">Aadhar</label>
                                <input type="file" name="aadhar_image" id="aadhar_image"
                                    class="form-control @error('aadhar_image') is-invalid @enderror"
                                    placeholder="Aadhar Image">
                                @error('aadhar_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 item-card">
                            <div class="card">
                                @if (isset($documentData->birth_certificate_image))
                                    <div class="btn-list onhover">
                                        <button type="button" class="viewIcon delete_student" data-toggle="tooltip"
                                            data-placement="top" style="color: #d52031;" title="Delete Student"
                                            data-column="birth_certificate_image"><i
                                                class="far fa-trash-alt"></i></button>
                                    </div>
                                @endif
                                <img src="{{ asset('student_documents/' . (isset($documentData->birth_certificate_image) && $documentData->birth_certificate_image ? $documentData->birth_certificate_image : 'No_image.jpg')) }}"
                                    class="card-img-top" alt="Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="birth_certificate_image">Birth Certificate</label>
                                <input type="file" name="birth_certificate_image" id="birth_certificate_image"
                                    class="form-control @error('birth_certificate_image') is-invalid @enderror"
                                    placeholder="Birth Certificate Image">
                                @error('birth_certificate_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 item-card">
                            <div class="card">
                                @if (isset($documentData->disability_certificate_image))
                                    <div class="btn-list onhover">
                                        <button type="button" class="viewIcon delete_student" data-toggle="tooltip"
                                            data-placement="top" style="color: #d52031;" title="Delete Student"
                                            data-column="disability_certificate_image"><i
                                                class="far fa-trash-alt"></i></button>
                                    </div>
                                @endif
                                <img src="{{ asset('student_documents/' . (isset($documentData->disability_certificate_image) && $documentData->disability_certificate_image ? $documentData->disability_certificate_image : 'No_image.jpg')) }}"
                                    class="card-img-top" alt="Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="disability_certificate_image">Disability Certificate</label>
                                <input type="file" name="disability_certificate_image"
                                    id="disability_certificate_image"
                                    class="form-control @error('disability_certificate_image') is-invalid @enderror"
                                    placeholder="Disability Certificate Image">
                                @error('disability_certificate_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 item-card">
                            <div class="card">
                                @if (isset($documentData->medical_certificate_image))
                                    <div class="btn-list onhover">
                                        <button type="button" class="viewIcon delete_student" data-toggle="tooltip"
                                            data-placement="top" style="color: #d52031;" title="Delete Student"
                                            data-column="medical_certificate_image"><i
                                                class="far fa-trash-alt"></i></button>
                                    </div>
                                @endif
                                <img src="{{ asset('student_documents/' . (isset($documentData->medical_certificate_image) && $documentData->medical_certificate_image ? $documentData->medical_certificate_image : 'No_image.jpg')) }}"
                                    class="card-img-top" alt="Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="medical_certificate_image">CMO certificate</label>
                                <input type="file" name="medical_certificate_image" id="medical_certificate_image"
                                    class="form-control @error('medical_certificate_image') is-invalid @enderror"
                                    placeholder="CMO Certificate Image">
                                @error('medical_certificate_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 item-card">
                            <div class="card">
                                @if (isset($documentData->transfer_certificate_image))
                                    <div class="btn-list onhover">
                                        <button type="button" class="viewIcon delete_student" data-toggle="tooltip"
                                            data-placement="top" style="color: #d52031;" title="Delete Student"
                                            data-column="transfer_certificate_image"><i
                                                class="far fa-trash-alt"></i></button>
                                    </div>
                                @endif
                                <img src="{{ asset('student_documents/' . (isset($documentData->transfer_certificate_image) && $documentData->transfer_certificate_image ? $documentData->transfer_certificate_image : 'No_image.jpg')) }}"
                                    class="card-img-top" alt="Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="transfer_certificate_image">Transfer Certificate (TC)</label>
                                <input type="file" name="transfer_certificate_image" id="transfer_certificate_image"
                                    class="form-control @error('transfer_certificate_image') is-invalid @enderror"
                                    placeholder="Transfer Certificate Image">
                                @error('transfer_certificate_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 item-card">
                            <div class="card">
                                @if (isset($documentData->doc_prescription))
                                    <div class="btn-list onhover">
                                        <button type="button" class="viewIcon delete_student" data-toggle="tooltip"
                                            data-placement="top" style="color: #d52031;" title="Delete Student"
                                            data-column="doc_prescription"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                @endif
                                <img src="{{ asset('student_documents/' . (isset($documentData->doc_prescription) && $documentData->doc_prescription ? $documentData->doc_prescription : 'No_image.jpg')) }}"
                                    class="card-img-top" alt="Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="doc_prescription">Doctor Prescription</label>
                                <input type="file" name="doc_prescription" id="doc_prescription"
                                    class="form-control @error('doc_prescription') is-invalid @enderror"
                                    placeholder="Other Document Image">
                                @error('doc_prescription')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 item-card">
                            <div class="card">
                                @if (isset($documentData->other_document_1))
                                    <div class="btn-list onhover">
                                        <button type="button" class="viewIcon delete_student" data-toggle="tooltip"
                                            data-placement="top" style="color: #d52031;" title="Delete Student"
                                            data-column="other_document_1"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                @endif
                                <img src="{{ asset('student_documents/' . (isset($documentData->other_document_1) && $documentData->other_document_1 ? $documentData->other_document_1 : 'No_image.jpg')) }}"
                                    class="card-img-top" alt="Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="other_document_1">Other Document-1</label>
                                <input type="file" name="other_document_1" id="other_document_1"
                                    class="form-control @error('other_document_1') is-invalid @enderror"
                                    placeholder="Other Document Image">
                                @error('other_document_1')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 item-card">
                            <div class="card">
                                @if (isset($documentData->other_document_2))
                                    <div class="btn-list onhover">
                                        <button type="button" class="viewIcon delete_student" data-toggle="tooltip"
                                            data-placement="top" style="color: #d52031;" title="Delete Student"
                                            data-column="other_document_2"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                @endif
                                <img src="{{ asset('student_documents/' . (isset($documentData->other_document_2) && $documentData->other_document_2 ? $documentData->other_document_2 : 'No_image.jpg')) }}"
                                    class="card-img-top" alt="Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="other_document_2">Other Document-2</label>
                                <input type="file" name="other_document_2" id="other_document_2"
                                    class="form-control @error('other_document_2') is-invalid @enderror"
                                    placeholder="Other Document Image">
                                @error('other_document_2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 item-card">
                            <div class="card">
                                @if (isset($documentData->case_history))
                                    <div class="btn-list onhover">
                                        <button type="button" class="viewIcon delete_student" data-toggle="tooltip"
                                            data-placement="top" style="color: #d52031;" title="Delete Student"
                                            data-column="case_history"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                @endif
                                @php
                                    $case_history_arr = explode('.', $documentData->case_history ?? '');
                                    $case_ext = end($case_history_arr);
                                @endphp
                                @if ($case_ext != 'pdf')
                                    <img src="{{ asset('student_documents/' . (isset($documentData->case_history) && $documentData->case_history ? $documentData->case_history : 'No_image.jpg')) }}"
                                        class="card-img-top" alt="Image/pdf" style="height: 200px; object-fit: cover;">
                                @else
                                <div  class="card-img-top d-flex justify-content-center align-items-center" style="height: 200px; object-fit: cover;">
                                    <a href="{{ asset('student_documents/' . (isset($documentData->case_history) && $documentData->case_history ? $documentData->case_history : 'No_image.jpg')) }}"
                                        target="_blank" >
                                       <i class="fa-regular fa-file-pdf" style="font-size: 10rem; color:#d52031;" ></i>
                                    </a>
                                </div>
                                @endif
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="case_history">Case History</label>
                                <input type="file" name="case_history" id="case_history"
                                    class="form-control @error('case_history') is-invalid @enderror"
                                    placeholder="Case History">
                                @error('case_history')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var studentId = @json($getdata->id);
            $(document).on('click', '.delete_student', function() {
                var columnName = $(this).data('column');
                var btn = $(this);
                if (confirm('Are you sure you want to delete this student?')) {
                    $.ajax({
                        url: "{{ url('studentdocuments/delete') }}/" + columnName + '/' +
                            studentId,
                        type: 'DELETE',
                        success: function(response) {
                            window.location.reload('/');
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            alert('Something went wrong!');
                        }
                    });
                }
            });
        });
    </script>
@endsection
