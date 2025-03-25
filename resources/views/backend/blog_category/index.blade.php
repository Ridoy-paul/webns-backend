@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="align-items-center">
		<h1 class="h3">{{translate('Blog Category')}}</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-7">
		<div class="card">
		    <div class="card-body">
		        <table class="table  mb-0">
		            <thead>
		                <tr>
		                    <th>#</th>
		                    <th>{{translate('Name')}}</th>
							<th>{{translate('Status')}}</th>
		                    <th class="text-right">{{translate('Options')}}</th>
		                </tr>
		            </thead>
		            <tbody>
		                @foreach($data as $key => $row)
		                    <tr>
		                        <td>{{ ($key+1) + ($data->currentPage() - 1)*$data->perPage() }}</td>
		                        <td>{{ $row->name }}</td>
								<td>
									@if($row->is_active == 1)
									<span class="badge-pill badge-success">Active</span>
									@else
									<span class="badge badge-pill badge-warning">Inactive</span>
									@endif
								</td>
		                        <td class="text-right">
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('blog-categories.edit', $row->id) }}" title="{{ translate('Edit') }}">
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
                <h5 class="mb-0 h6">{{ translate('Add New Blog Category') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('blog-categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">{{translate('Name')}}</label>
                        <input type="text" placeholder="{{translate('Name')}}" name="name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">{{translate('Description')}}</label>
                        <textarea name="description" rows="5" class="form-control aiz-text-editor"></textarea>
                    </div>

					<div class="form-group" id="is_active">
                        <label class="col-from-label">{{translate('Is Active?')}} <i class="las la-language text-danger"></i></label>
                        <select class="form-control aiz-selectpicker" name="is_active" id="is_active" data-live-search="true" required>
                            <option value="1">{{ translate('Active') }}</option>                            
                            <option value="0">{{ translate('In active') }}</option>
                        </select>
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
