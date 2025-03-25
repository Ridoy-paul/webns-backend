@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Location Information')}}</h5>
</div>

<div class="col-lg-8 px-0">
    <div class="card">
        <div class="card-body p-0">
            <form class="p-4" action="{{ route('locations.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">{{translate('Location Name')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" value="{{ $data->name }}" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row" id="parent_location">
                    <label class="col-from-label col-sm-3">{{translate('Parent Location')}}</label>
                    <div class="col-sm-9">
                        <select class="form-control aiz-selectpicker" name="parent_location" id="parent_location" data-live-search="true">
                            <option value="0">{{ translate('Select Parent Location [ for sub Location ]') }}</option>
                            @foreach ($locations as $locationItem)
                                <option {{ $data->parent_location == $locationItem->id ? 'selected' : '' }} value="{{ $locationItem->id }}">{{ $locationItem->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label">{{translate('Description')}}</label>
                    <div class="col-sm-9">
                        <textarea name="descriptions" rows="3" class="form-control">{{ $data->descriptions }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label">{{translate('Google Map Script')}}</label>
                    <div class="col-sm-9">
                        <textarea name="google_map_script" rows="3" class="form-control">{{ $data->google_map_script }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">{{translate('Longitude')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Longitude')}}" id="longitude" name="longitude" value="{{ $data->longitude }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">{{translate('Latitude')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Latitude')}}" id="latitude" name="latitude" value="{{ $data->latitude }}" class="form-control">
                    </div>
                </div>

                <x-meta-information :updatemetaid="optional($data)->meta_info" />
                
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
