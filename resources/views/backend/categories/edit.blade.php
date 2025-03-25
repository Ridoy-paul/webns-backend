@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('FAQ Information')}}</h5>
</div>

<div class="col-lg-8 px-0">
    <div class="card">
        <div class="card-body p-0">
            <form class="p-4" action="{{ route('admin-categories.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-from-label" for="name">{{translate('Name')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                    <div class="col-sm-12">
                        <input type="text" placeholder="{{translate('Name')}}" id="title" name="name" value="{{ $data->name }}" class="form-control" required>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="title">{{translate('Serial')}}</label>
                    <input type="number" placeholder="{{translate('Searial')}}" value="{{ $data->serial }}" name="serial" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="name">{{translate('Description')}}</label>
                    <textarea name="descriptions" rows="5" class="form-control aiz-text-editor">{{$data->descriptions}}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>{{translate('Image')}}</label>
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="image" value="{{ $data->image }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm"></div>                        
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>{{translate('Icon')}}</label>
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="icon" value="{{ $data->icon }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm"></div>                        
                        </div>
                    </div>
                </div>

                <div class="form-group" id="is_active">
                    <label class="col-from-label">{{translate('Service Type')}} <i class="las la-language text-danger"></i></label>
                    <select class="form-control" name="is_active" id="is_active" data-live-search="false" required>
                        <option value="1" {{ $data->is_active == 1 ? 'selected' : '' }}>{{ translate('Active') }}</option>                            
                        <option value="0" {{ $data->is_active == 0 ? 'selected' : '' }} >{{ translate('In active') }}</option>
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