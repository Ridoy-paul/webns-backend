@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('FAQ Information')}}</h5>
</div>

<div class="col-lg-12 px-0">
    <div class="card">
        <div class="card-body p-0">
            <form class="p-4" action="{{ route('pages.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-from-label" for="name">{{translate('Name')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                    <div class="col-sm-12">
                        <input type="text" placeholder="{{translate('Name')}}" value="{{$data->title}}" id="title" name="title" value="{{ $data->title }}" class="form-control" required>
                    </div>
                </div>
               
                <div class="form-group mb-3">
                    <label for="name">{{translate('Description')}}</label>
                    <textarea name="page_description" rows="5" class="form-control aiz-text-editor">{{$data->page_description}}</textarea>
                </div>

                <div class="form-group mb-3">
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

                <x-meta-information :updatemetaid="optional($data)->meta_info" />
                
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection