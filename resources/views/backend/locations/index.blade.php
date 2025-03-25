@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="align-items-center">
		<h1 class="h3">{{translate('Locations')}}</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-7">
		<div class="card">
		    <div class="card-body">
		        <table class="table mb-0">
		            <thead>
		                <tr>
		                    <th>#</th> 
		                    <th>{{translate('Name')}}</th>
		                    <th class="text-right">{{translate('Options')}}</th>
		                </tr>
		            </thead>
		            <tbody>
		                @foreach($data as $key => $item)
		                    <tr>
		                        <td>{{ ($key+1) + ($data->currentPage() - 1)*$data->perPage() }}</td>
		                        <td>{{ $item->name }}</td>
		                        <td class="text-right">
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('locations.edit', $item->id) }}" title="{{ translate('Edit') }}">
                                        <i class="las la-edit"></i>
                                    </a>
		                        </td>
		                    </tr>
		                @endforeach
		            </tbody>
		        </table>
		        <div class="aiz-pagination">
                	{{ $data->appends(request()->input())->links() }}
            	</div>
		    </div>
		</div>
	</div>
	
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Add New Location') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('locations.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">{{translate('Location Name')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                        <input type="text" placeholder="{{translate('Ex. Dhaka')}}" name="name" class="form-control" required>
                    </div>

                    <div class="form-group" id="brand">
                        <label class="col-from-label">{{translate('Parent Location')}}</label>
                        <select class="form-control aiz-selectpicker" name="parent_location" id="parent_location" data-live-search="true">
                            <option value="0">{{ translate('Select Parent Location [ for sub Location ]') }}</option>
                            @foreach ($locations as $locationItem)
                            <option value="{{ $locationItem->id }}">{{ $locationItem->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="name">{{translate('Description')}}</label>
                        <textarea name="descriptions" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">{{translate('Google Map Script')}}</label>
                        <textarea name="google_map_script" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">{{translate('Latitude')}}</label>
                        <input type="text" placeholder="{{translate('Latitude')}}" name="latitude" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">{{translate('Longitude')}}</label>
                        <input type="text" placeholder="{{translate('Longitude')}}" name="longitude" class="form-control">
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

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
<script type="text/javascript">
    function sort_brands(el){
        $('#sort_brands').submit();
    }
</script>
@endsection
