@extends('layouts.app', [
'class' => '',
'elementActive' => 'notifications',
])

@section('content')
<style>
    .form-group input[type="file"] {
        opacity: 1;
        position: relative;
    }

    .select2-container .select2-selection--single {
        height: 38px !important;
        line-height: 38px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #dddddd !important;
    }

    .select2-container--default .select2-selection--single:hover {
        border: 1px solid #dee2e6 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #66615b !important;
    }
</style>
<div class="content">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('notificationlist') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
                <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp; Create Notification</p>
            </div>
            <hr>
            <form action="{{ route('notification.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Subject</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Enter Notification Subject"
                                value="{{ old('title', $getdata->title ?? '') }}" />
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="hidden" name="edit_id" id="edit_id"
                                value="{{ isset($getdata->id) ? $getdata->id : '' }}" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="user_type" class="form-control" required>
                                <option value="parent" {{ old('type', $getdata->type ?? '') == 1 ? 'selected' : '' }}>
                                    Parent
                                </option>
                                <option value="teacher" {{ old('type', $getdata->type ?? '') == 2 ? 'selected' : '' }}>
                                    Teacher
                                </option>
                            </select>
                            @error('document')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>
                    <div class="col-md-6" id="recipient_parent">
                        <div class="form-group">
                            <label for="recipient_ids">Recipients</label>
                            <select name="recipient_ids[]" class="form-control2 select2 recipient_ids" multiple>
                                <option value="1">All Parents</option>
                                @foreach ($parents as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('recipient_ids', $getdata->recipient_ids ?? '') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}({{ $user->user_id }})
                                </option>
                                @endforeach
                            </select>
                            @error('recipient_ids')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 d-none" id="recipient_teacher">
                        <div class="form-group">
                            <label for="recipient_ids">Recipients</label>
                            <select name="recipient_ids[]" class="form-control2 select2 recipient_ids" multiple>
                                <option value="1">All Teachers</option>
                                @foreach ($teachers as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('recipient_ids', $getdata->recipient_ids ?? '') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}({{ $user->user_id }})
                                </option>
                                @endforeach
                            </select>

                            @error('recipient_ids')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-groupp">
                            <label for="attachment">Attachment</label>
                            <input type="file" class="form-control" id="attachment" name="attachment"
                                placeholder="Attachment" value="" autocomplete="new-password" />
                            @error('attachment')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 reason">
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control ckeditor" id="description" name="message" placeholder="Enter Notification Message">{{ old('message', $getdata->message ?? '') }}</textarea>
                            @error('message')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>
            </form>
        </div>

    </div>

</div>

<script>
    $(document).ready(function() {
        $('.recipient_ids').select2({
            placeholder: "Select Recipient",
            allowClear: true,
            width: '100%'
        });
    });
</script>

<script>
    window.ckeditors = window.ckeditors || {};

    document.querySelectorAll('.ckeditor').forEach(function(el) {
        ClassicEditor.create(el, {
                toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'undo', 'redo', 'blockQuote', 'insertTable']
            })
            .then(editor => {
                window.ckeditors[el.id] = editor;
            })
            .catch(error => console.error(error));
    });

    $(document).on('change', '.recipient_ids', function() {
        let values = $(this).val();
        if (values && values.includes('1')) {
            $(this).attr('name', 'send_to_all');
        } else {
            $(this).attr('name', 'recipient_ids[]');
        }
    });

    const form = document.querySelector('form');
    form.addEventListener('submit', function() {
        const editor = window.ckeditors['description'];
        if (editor) {
            document.getElementById('description').value = editor.getData(); 
        }
    });
</script>


<script>
    $(document).on('change', '#user_type', function() {
        let userType = $('#user_type').val();
        if (userType && userType == 'parent') {
            $('#recipient_parent').removeClass('d-none')
            $('#recipient_teacher').addClass('d-none')

        } else if (userType && userType == 'teacher') {
            $('#recipient_parent').addClass('d-none')
            $('#recipient_teacher').removeClass('d-none')
        }

    });
</script>

@endsection