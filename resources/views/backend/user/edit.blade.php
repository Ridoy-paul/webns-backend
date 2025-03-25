@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Profile')}}</h5>
</div>


<form action="{{ route('users.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="title">{{translate('Name')}}</label>
                            <input type="text" placeholder="{{translate('Name')}}" value="{{optional($data)->name}}" name="name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>{{translate('Phone')}}</label>
                            <input type="text" placeholder="{{translate('Phone')}}" value="{{optional($data)->phone}}" name="phone" class="form-control" >
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="name">{{translate('Address')}}</label>
                            <textarea name="address" rows="3" class="form-control"> {{optional($data)->address}} </textarea>
                        </div>                
                        
                        <div class="form-group mb-3">
                            <label>{{translate('Picture')}}</label>
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="image" value="{{ optional($data)->image }}" class="selected-files">
                            </div>
                        
                            <div class="file-preview box sm">
                            </div>                        
                        </div>


                        <div class="form-group" id="brand">
                            <label class="col-from-label">{{translate('Gender')}}</label>
                            <select class="form-control aiz-selectpicker" name="gender" id="gender" data-live-search="true">
                                <option value="0">{{ translate('Select Gender') }}</option>                              
                                <option value="Male" {{ $data->gender == 'Male' ? 'selected' : '' }} >{{ translate('Male') }}</option>
                                <option value="Female" {{ $data->gender == 'Female' ? 'selected' : '' }}>{{ translate('Female') }}</option>
                            </select>
                        </div>
                          
                        
                        <div class="form-group mb-3 text-right">
                            <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                        </div>
                </div>
            </div>
        </div>
       
    </div>
</form>
@endsection
