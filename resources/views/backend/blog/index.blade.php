@extends('backend.layouts.app')

@section('content')

<x-data-table-script />

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="align-items-center">
		<h1 class="h3">{{translate('Blogs')}}</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="card">
		    <div class="card-body">
		        <table class="table table-bordered data-table">
		            <thead>
		                <tr>		                    
		                    <th width="50%">{{translate('Title')}}</th>
							<th>{{translate('Status')}}</th>
		                    <th>{{translate('Options')}}</th>
		                </tr>
		            </thead>
		            <tbody>		              
		            </tbody>
		        </table>
		    </div>
		</div>
	</div>
</div>


<script type="text/javascript">
    jQuery(function ($) {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('blogs.index') }}",
            columns: [
                {data: 'title', name: 'title'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "scrollY": "50vh",
            "pageLength": 25,
            "ordering": false,
        });
    });
</script>

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
