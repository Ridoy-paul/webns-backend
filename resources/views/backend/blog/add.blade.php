@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Add New Blog') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('blogs.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="form-group col-md-8 mb-3">
                            <label for="title">{{translate('Title')}}</label>
                            <input type="text" placeholder="{{translate('Title')}}" name="title" class="form-control" required>
                        </div>

                        <div class="form-group mb-3 col-md-4">
                            <label>{{translate('Thumbnail')}}</label>
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="thumbnail" class="selected-files">
                            </div>
                        
                            <div class="file-preview box sm"></div>                        
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">{{translate('Short Description')}}</label>
                        <textarea name="others_info" rows="5" class="form-control" required></textarea>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="name">{{translate('Description')}}</label>
                        <textarea name="description" rows="5" class="form-control aiz-text-editor"></textarea>
                    </div>

                    <div class="row">
                        <div class="form-group mb-3 col-md-4">
                            <label>{{translate('Date')}}</label>
                            <input type="date" placeholder="{{translate('Date')}}" name="date" class="form-control" >
                        </div>

                        <div class="form-group mb-3 col-md-4">
                            <label>{{translate('Author')}}</label>
                            <input type="text" name="created_by" value="Tolet BD" class="form-control" >
                        </div>

                        <div class="form-group col-md-4" id="is_active">
                            <label class="col-from-label">{{translate('Is Active?')}} <i class="las la-language text-danger"></i></label>
                            <select class="form-control aiz-selectpicker" name="is_active" id="is_active" data-live-search="true" required>
                                <option value="1">{{ translate('Active') }}</option>                            
                                <option value="0">{{ translate('In active') }}</option>
                            </select>
                        </div>
                    </div>

					<x-meta-information />

                    <div class="form-group mb-3 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection