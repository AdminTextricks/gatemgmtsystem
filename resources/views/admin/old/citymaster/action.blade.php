@extends('layouts.app', [
'class' => '',
'elementActive' => 'citylist'
])

@section('content')
<div class="content">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('citylist') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
                <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $action }} City</p>
            </div>
            <hr>
            <form action="{{route('city.action')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="city_name">City Name</label>
                            <input type="text" class="form-control" id="city_name" name="city_name" placeholder="City Name"
                                value="{{isset($getdata->city_name)?$getdata->city_name:''}}" />
                            @error('city_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="hidden" name="edit_id" id="edit_id" value="{{isset($getdata->id)?$getdata->id:''}}" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="state_id">State</label>
                            <!-- <input type="text" class="form-control" id="state" name="state" placeholder="State"
                                value="{{isset($getdata->state)?$getdata->state:''}}" /> -->
                            <select class="form-control" id="state_id" name="state_id">
                                <option value="">Select State</option>
                                @foreach($states as $state)
                                <option value="{{$state->id}}" @if(isset($getdata->state_id) && $getdata->state_id==$state->id) selected @endif> {{$state->state_name}} </option>
                                @endforeach

                            </select>  
                            @error('state_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror  
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="own_city">Own City</label>
                            <!-- <input type="text" name="own_city" id="own_city" class="form-control"
                                value="{{isset($getdata->own_city)?$getdata->own_city:''}}" placeholder="Own City"> -->
                            <select class="form-control" id="own_city" name="own_city">
                                <option value="">Select Own City</option>
                                <option value="yes" @if(isset($getdata->own_city) && $getdata->own_city=='yes') selected @endif>Yes</option>
                                <option value="no" @if(isset($getdata->own_city) && $getdata->own_city=='no') selected @endif>No</option>
                            </select> 
                            @error('own_city')
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