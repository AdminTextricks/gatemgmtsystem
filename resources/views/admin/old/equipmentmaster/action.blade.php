@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'equipmentlist',
])

@section('content')
    <style>
        .form-group input[type="file"] {
            opacity: 1;
            position: relative;
        }
    </style>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('equipmentlist') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} Equipment Master</p>
                </div>
                <hr>
                <form action="{{ route('equipment.action') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="equipment_id">Equipment ID</label>
                                <input type="text" class="form-control" id="equipment_id" name="equipment_id"
                                    placeholder="Equipment ID"
                                    value="{{old('equipment_id', $getdata->equipment_id??'')}}" />
                                @error('equipment_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="edit_id" id="edit_id"
                                    value="{{ isset($getdata->id) ? $getdata->id : '' }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Equipment Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Equipment Name"
                                    value="{{old('name', $getdata->name??'') }}" />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" class="form-control"
                                    value="{{old('description', $getdata->description??'') }}"
                                    placeholder="Description">
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date_of_purchase">Date Of Purchase</label>
                                <input type="date" name="date_of_purchase" id="date_of_purchase" class="form-control"
                                    value="{{ old('date_of_purchase', $getdata->date_of_purchase??'') }}"
                                    placeholder="Date Of Purchase">
                                @error('date_of_purchase')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="warranty_status">Warranty Status </label>
                                <input type="text" name="warranty_status" id="warranty_status" class="form-control"
                                    value="{{ old('warranty_status', $getdata->warranty_status??'') }}"
                                    placeholder="Warranty Status">
                                @error('warranty_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="service_status">Service Status</label>
                                <input type="text" name="service_status" id="service_status" class="form-control"
                                    value="{{old('service_status', $getdata->service_status??'')}}"
                                    placeholder="Service Status">
                                @error('service_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image"
                                    class="form-control @error('image') is-invalid @enderror" placeholder="Image" {{ $action != 'Edit' ? 'required' : '' }}>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @if (!empty($getdata->image))
                                <div class="col-md-6">
                                    <div class="form-groupp">
                                        <img src="{{ asset('images/' . ($getdata->image ? $getdata->image : '')) }}"
                                            class="card-img-top" alt="Image" style="width: 170px; object-fit: cover;">
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eqp_video">Video</label>
                                <input type="file" name="eqp_video" id="eqp_video"
                                    class="form-control @error('eqp_video') is-invalid @enderror" placeholder="Video"  {{ $action != 'Edit' ? 'required' : '' }}>
                                @error('eqp_video')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @if (!empty($getdata->eqp_video))
                                <div class="col-md-3">
                                    <div class="form-groupp">
                                        <video id="sample_courseVideoPreview" controls="" style="width: 300px; !important; max-height:150px !important;">
                                            <source id="sample_courseVideoSource"
                                                src="{{ asset('videos/' . ($getdata->eqp_video ? $getdata->eqp_video : '')) }}"
                                                type="video/mp4">Your browser does not
                                            support the video tag.
                                        </video>
                                    </div>
                                </div>
                            @endif
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
