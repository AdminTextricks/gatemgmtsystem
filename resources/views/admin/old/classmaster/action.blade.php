@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'classlist',
])

@section('content')
    <div class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('classlist') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} ClassMaster</p>
                </div>
                <hr>
                <form action="{{ route('classmaster.action') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="class_id">CLASS ID</label>
                                <input type="text" class="form-control" id="class_id" name="class_id"
                                    placeholder="Class ID"
                                    value="{{ isset($getdata->class_id) ? $getdata->class_id : '' }}" />
                                @error('class_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="edit_id" id="edit_id"
                                    value="{{ isset($getdata->id) ? $getdata->id : '' }}" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="class_name">CLASS NAME</label>
                                <input type="text" class="form-control" id="class_name" name="class_name"
                                    placeholder="Class Name"
                                    value="{{ isset($getdata->class_name) ? $getdata->class_name : '' }}" />
                                @error('class_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="class_order">ORDER</label>
                                <input type="text" name="class_order" id="class_order" class="form-control"
                                    value="{{ isset($getdata->class_order) ? $getdata->class_order : '' }}"
                                    placeholder="Order">
                                @error('class_order')
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
@endsection
