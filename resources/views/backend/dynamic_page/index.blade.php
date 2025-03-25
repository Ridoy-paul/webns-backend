@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="align-items-center">
		<h1 class="h3">{{translate('Dynamic Page')}}</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-7">
		<div class="card">
		    <div class="card-body">
		        <table class="table  mb-0">
		            <thead>
		                <tr>
		                    <th>{{translate('Name')}}</th>
                            <th>{{translate('Slug')}}</th>
		                    <th class="text-right">{{translate('Options')}}</th>
		                </tr>
		            </thead>
		            <tbody>
		                @foreach($data as $key => $row)
		                    <tr>
		                        <td>{{ $row->title }}</td>
                                <td>{{ $row->slug }}</td>
		                        <td class="text-right">
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('pages.edit', $row->id) }}" title="{{ translate('Edit') }}">
                                        <i class="las la-edit"></i>
                                    </a>
		                        </td>
		                    </tr>
		                @endforeach
		            </tbody>
		        </table>
		        
		    </div>
		</div>
	</div>
	
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Add New Dynamic Page') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pages.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">{{translate('Name')}}</label>
                        <input type="text" placeholder="{{translate('Name')}}" name="title" class="form-control" required>
                    </div>

                    <input type="hidden" name="type" value="page">

                    <div class="form-group mb-3">
                        <label for="name">{{translate('Description')}}</label>
                        <textarea name="page_description" rows="5" class="form-control aiz-text-editor"></textarea>
                    </div>

                    <div class="form-group" id="slug">
                        <label class="col-from-label">{{translate('Slug')}} <i class="las la-language text-danger"></i></label>
                        <select class="form-control aiz-selectpicker" name="slug" id="slug" data-live-search="true" required>
                            <option value="about_us">{{ translate('About Us') }}</option>                            
                            <option value="privacy_policy">{{ translate('Privacy & Policy') }}</option>
							<option value="terms_conditions">{{ translate('Terms & Conditions') }}</option>
                            <option value="refund_policy">{{ translate('Refund Policy') }}</option>
                            <option value="contact_us">{{ translate('Contact Us') }}</option>
                        </select>
                    </div>


                    <div class="form-group mb-3">
                        <label>{{translate('Thumbnail')}}</label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="thumbnail" class="selected-files">
                        </div>
                    
                        <div class="file-preview box sm">
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
