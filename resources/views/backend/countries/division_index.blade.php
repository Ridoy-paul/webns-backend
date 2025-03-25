
@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="align-items-center">
		<h1 class="h3">{{translate('Division List')}}</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-7">
		<div class="card">
		    <div class="card-body">
		        <table class="table  mb-0">
		            <thead>
		                <tr>
                            <th>{{translate('Division Name')}}</th>
                            <th>{{translate('Status')}}</th>
		                    <th class="text-right">{{translate('Options')}}</th>
		                </tr>
		            </thead>
		            <tbody>
		                @foreach($data['divisions'] as $key => $row)
		                    <tr>
                                <td>{{ $row->name }}</td>
                                <td>
									@if($row->is_active == 1)
									    <span class="badge-pill badge-success">Active</span>
									@else
									    <span class="badge badge-pill badge-danger px-4">Inactive</span>
									@endif
								</td>
		                        <td class="text-right">
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('division.edit', $row->id) }}" title="{{ translate('Edit') }}">
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
                <h5 class="mb-0 h6">{{ translate('Add New Division') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('division.store') }}" method="POST">
                    @csrf

                    <div class="form-group" id="country_id">
                        <label class="col-from-label">{{translate('Select Country')}} <i class="las la-language text-danger"></i></label>
                        <select class="form-control aiz-selectpicker" name="country_id" id="country_id" data-live-search="true" required>
                            @foreach($data['countries'] as $key => $row)
                                <option value="{{$row->id}}">{{$row->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group mb-3">
                        <label for="title">{{translate('Division Name')}}</label>
                        <input type="text" placeholder="{{translate('Name')}}" name="name" class="form-control" required>
                        @error('name')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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

