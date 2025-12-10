@extends('layouts.app', [
'class' => '',
'elementActive' => 'disability'
])

@section('content')
<div class="content">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('disabilitylist') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
                <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} Disability</p>
            </div>
            <hr>
            <form action="{{route('disability.action')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="disability_id">Disability ID</label>
                            <input type="text" class="form-control" id="disability_id" name="disability_id" placeholder="Disability ID"
                                value="{{isset($getdata->disability_id)?$getdata->disability_id:''}}" />
                            @error('disability_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="hidden" name="edit_id" id="edit_id" value="{{isset($getdata->id)?$getdata->id:''}}" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="disability_name">Disability Name</label>
                            <input type="text" class="form-control" id="disability_name" name="disability_name" placeholder="Disability Name"
                                value="{{isset($getdata->disability_name)?$getdata->disability_name:''}}" />
                            @error('disability_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" class="form-control"
                                value="{{isset($getdata->description)?$getdata->description:''}}" placeholder="Description">
                            @error('description')
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