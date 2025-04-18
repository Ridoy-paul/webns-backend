@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Edit Division')}}</h5>
</div>

<div class="col-lg-8 px-0">
    <div class="card">
        <div class="card-body p-0">
            <form class="p-4" action="{{ route('division.update', $data['division']->id) }}" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
                @csrf

                <div class="form-group" id="country_id">
                    <label class="col-from-label">{{translate('Select Country')}} <i class="las la-language text-danger"></i></label>
                    <select class="form-control aiz-selectpicker" name="country_id" id="country_id" data-live-search="true" required>
                        @foreach($data['countries'] as $key => $row)
                            <option value="{{$row->id}}" @if($data['division']->country_id == $row->id) selected @endif>{{$row->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group mb-3">
                    <label for="title">{{translate('Name')}}</label>
                    <input type="text" placeholder="{{translate('Name')}}" name="name" value="{{$data['division']->name}}" class="form-control" required>
                    @error('name')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group" id="is_active">
                    <label class="col-from-label">{{translate('Status')}} <i class="las la-language text-danger"></i></label>
                    <select class="form-control aiz-selectpicker" name="is_active" id="is_active" data-live-search="true" required>
                        <option value="1" @if($data['division']->is_active == "1") selected @endif>{{ translate('Active') }}</option>                            
                        <option value="0" @if($data['division']->is_active == "0") selected @endif>{{ translate('In active') }}</option>
                    </select>
                </div>
                
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
