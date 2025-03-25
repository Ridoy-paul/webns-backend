
@extends('backend.layouts.app')

@section('content')
<?php 
    $total_current_month = 0;
    $total_next_month = 0;
    $total_next_next_month = 0;
?>

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="align-items-center">
		<h1 class="h3">{{translate('District List')}}</h1>
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
                            <th>{{translate('District Name')}}</th>
                            <th>{{translate('Property Qty')}}</th>
                            <th>{{translate('Status')}}</th>
		                    <th class="text-right">{{translate('Options')}}</th>
		                </tr>
		            </thead>
		            <tbody>
		                @foreach($data['district'] as $key => $row)
                            <?php 
                                $total_current_month += $row->current_month_property_qty;
                                $total_next_month += $row->next_month_property_qty;
                                $total_next_next_month += $row->next_next_month_property_qty;
                            ?>
		                    <tr>
		                        <td>{{ $row->division_info->name ?? '' }}</td>
                                <td>{{ $row->name }}</td>
                                <td>

                                    <span>
                                        <b>{{ $data['currentMonthName'] }}: </b>{{ $row->current_month_property_qty }}
                                        <br>
                                        <b>{{ $data['nextMonthName'] }}: </b>{{ $row->next_month_property_qty }}
                                        <br>
                                        <b>{{ $data['nextNextMonthName'] }}: </b>{{ $row->next_next_month_property_qty }}
                                    </span>
                                </td>
                                <td>
									@if($row->is_active == 1)
									    <span class="badge-pill badge-success">Active</span>
									@else
									    <span class="badge badge-pill badge-danger px-4">Inactive</span>
									@endif
								</td>
		                        <td class="text-right">
                                    {{-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('district.edit', $row->id) }}" title="{{ translate('Edit') }}">
                                        <i class="las la-edit"></i>
                                    </a> --}}
		                        </td>
		                    </tr>
		                @endforeach
		            </tbody>
		        </table>
                <div class="shadow">
                    <h4>Total {{ $data['currentMonthName'] }} Property: {{ $total_current_month }}</h4>
                    <h4>Total {{ $data['nextMonthName'] }} Property: {{ $total_next_month }}</h4>
                    <h4>Total {{ $data['nextNextMonthName'] }} Property: {{ $total_next_next_month }}</h4>
                </div>
		    </div>
		</div>
	</div>
	
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Add New District') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('district.store') }}" method="POST">
                    @csrf

                    <div class="form-group" id="division_id">
                        <label class="col-from-label">{{translate('Select Division')}} <i class="las la-language text-danger"></i></label>
                        <select class="form-control aiz-selectpicker" name="division_id" id="division_id" data-live-search="true" required>
                            @foreach($data['divisions'] as $key => $row)
                                <option value="{{$row->id}}">{{$row->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group mb-3">
                        <label for="title">{{translate('Name')}}</label>
                        <input type="text" placeholder="{{translate('Name')}}" name="name" class="form-control" required>
                        @error('name')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3 text-right d-none">
                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

