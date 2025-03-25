@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Blog Information')}}</h5>
</div>

<div class="col-lg-12 px-0">
    <div class="card">
        <div class="card-body p-0">
            <form class="p-4" action="{{ route('blogs.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
                @csrf
                
                <div class="row">
                    <div class="form-group col-md-8 mb-3">
                        <label for="title">{{translate('Title')}}</label>
                        <input type="text" placeholder="{{translate('Title')}}" name="title" value="{{$data->title}}" class="form-control" required>
                    </div>

                    <div class="form-group col-md-4 mb-3">
                        <label>{{translate('Thumbnail')}}</label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="thumbnail" value="{{$data->thumbnail}}" class="selected-files">
                        </div>
                    
                        <div class="file-preview box sm">
                        </div>                        
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="name">{{translate('Short Description')}}</label>
                    <textarea name="others_info" rows="5" class="form-control" required>{{$data->additional_info}}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="name">{{translate('Description')}}</label>
                    <textarea name="description" rows="5" class="form-control aiz-text-editor">{{$data->description}}</textarea>
                </div>

                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        <label>{{translate('Date')}}</label>
                        <input type="date" placeholder="{{translate('Date')}}" value="{{$data->date}}" name="date" class="form-control" >
                    </div>

                    <div class="form-group mb-3 col-md-4">
                        <label>{{translate('Author')}}</label>
                        <input type="text" name="created_by" value="{{$data->created_by}}" class="form-control" >
                    </div>
                
                    <div class="form-group col-md-4" id="is_active">
                        <label class="col-from-label">{{translate('Is Active?')}} <i class="las la-language text-danger"></i></label>
                        <select class="form-control aiz-selectpicker" name="is_active" id="is_active" data-live-search="true" required>
                            <option value="1" @if($data->is_active == "1") selected @endif>{{ translate('Active') }}</option>                            
                            <option value="0" @if($data->is_active == "0") selected @endif>{{ translate('In active') }}</option>
                        </select>
                    </div>
                </div>

                <x-meta-information :metainfo="$data" />
                
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
