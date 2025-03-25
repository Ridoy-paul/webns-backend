@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="align-items-center">
		<h1 class="h3">{{translate('Contacts')}}</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="card">
		    <div class="card-body">
		        <table class="table table-dark mb-0">
		            <thead>
		                <tr>
		                    <th>#</th>
		                    <th>{{translate('Name')}}</th>
                            <th>{{translate('Email')}}</th>
                            <th>{{translate('Phone')}}</th>
                            <th>{{translate('Message')}}</th>
		                    {{-- <th class="text-right">{{translate('Options')}}</th> --}}
		                </tr>
		            </thead>
		            <tbody>
		                @foreach($data as $key => $row)
		                    <tr>
		                        <td>{{ ($key+1) + ($data->currentPage() - 1)*$data->perPage() }}</td>
		                        <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone_number }}</td>
                                <td>{{ $row->message }}</td>
		                        {{-- <td class="text-right">
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href=".#" title="{{ translate('Edit') }}">
                                        <i class="las la-edit"></i>
                                    </a>
		                        </td> --}}
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
