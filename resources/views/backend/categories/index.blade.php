@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="align-items-center">
		<h1 class="h3">{{translate('Dynamic Categories')}}</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-7">
		<div class="card">
		    <div class="card-body">
		        <table class="table  mb-0">
		            <thead>
		                <tr>
                            <th>{{translate('SN.')}}</th>
		                    <th>{{translate('Name')}}</th>
                            <th>{{translate('Image')}}</th>
                            <th>{{translate('Icon')}}</th>
		                    <th class="text-right">{{translate('Options')}}</th>
		                </tr>
		            </thead>
		            <tbody>
		                @foreach($data as $key => $row)
		                    <tr>
                                <td>{{ $row->serial }}</td>
		                        <td>{{ $row->name }}</td>
                                <td><img src="{{ url(uploaded_asset($row->image))}}" alt="Image" class="size-50px img-fit shadow rounded border p-1"></td>
                                <td><img src="{{ url(uploaded_asset($row->icon))}}" alt="Image" class="size-50px img-fit shadow rounded border p-1"></td>
		                        <td class="text-right">
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('admin-categories.edit', $row->id) }}" title="{{ translate('Edit') }}">
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
                <h5 class="mb-0 h6">{{ translate('Add New Dynamic Category') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">{{translate('Name')}}</label>
                        <input type="text" placeholder="{{translate('Name')}}" name="name" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="title">{{translate('Serial')}}</label>
                        <input type="number" placeholder="{{translate('Searial')}}" name="serial" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">{{translate('Description')}}</label>
                        <textarea name="descriptions" rows="5" class="form-control aiz-text-editor"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>{{translate('Image')}}</label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="image" class="selected-files">
                        </div>
                        <div class="file-preview box sm"></div>                        
                    </div>

                    <div class="form-group mb-3">
                        <label>{{translate('Icon')}}</label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="icon" class="selected-files">
                        </div>
                        <div class="file-preview box sm"></div>                        
                    </div>
                    
                    <div class="form-group mb-3 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
