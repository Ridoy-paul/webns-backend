@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Youtube Video Information')}}</h5>
</div>

<div class="col-lg-8 px-0">
    <div class="card">
        <div class="card-body p-0">
            <form class="p-4" action="{{ route('youtube-videos.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
                @csrf
                <div class="form-group mb-3">
                    <label for="serial_no">{{translate('Serial No.')}}</label>
                    <input type="number" placeholder="{{translate('Serial No.')}}" name="serial_no" value="{{$data->serial_no}}" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="video_link">{{translate('Video Link')}}</label>
                    <input type="text" placeholder="{{translate('Video Link')}}" name="video_link" value="{{$data->video_link}}" class="form-control" required>
                </div>

                <div class="form-group" id="is_active">
                    <label class="col-from-label">{{translate('Is Active?')}} <i class="las la-language text-danger"></i></label>
                    <select class="form-control aiz-selectpicker" name="is_active" id="is_active" data-live-search="true" required>
                        <option value="1" @if($data->is_active == "1") selected @endif>{{ translate('Active') }}</option>                            
                        <option value="0" @if($data->is_active == "0") selected @endif>{{ translate('In active') }}</option>
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
