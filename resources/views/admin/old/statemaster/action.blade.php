@extends('layouts.app', [
'class' => '',
'elementActive' => 'statelist'
])

@section('content')
<div class="content">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('statelist') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
                <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} State</p>
            </div>
            <hr>
            <form action="{{route('state.action')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="state_name">state Name</label>
                            <input type="text" class="form-control" id="state_name" name="state_name" placeholder="state Name"
                                value="{{isset($getdata->state_name)?$getdata->state_name:''}}" />
                            
                            @error('state_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror 
                            <input type="hidden" name="edit_id" id="edit_id" value="{{isset($getdata->id)?$getdata->id:''}}" />
                        </div>
                    </div>
                  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="own_state">Own state</label>
                            <!-- <input type="text" name="own_state" id="own_state" class="form-control"
                                value="{{isset($getdata->own_state)?$getdata->own_state:''}}" placeholder="Own state"> -->
                            <select class="form-control" id="own_state" name="own_state">
                                <option value="">Select Own state</option>
                                <option value="yes" @if(isset($getdata->own_state) && $getdata->own_state=='yes') selected @endif>Yes</option>
                                <option value="no" @if(isset($getdata->own_state) && $getdata->own_state=='no') selected @endif>No</option>
                            </select> 
                            @error('own_state')
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