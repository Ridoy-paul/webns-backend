@extends('backend.layouts.app')

@section('content')
<?php 
    use Illuminate\Support\Facades\DB;

    $total_users = DB::table('users')->where('type', 'user')->count('id');
?>
<div>
    <div class="row">
        <div class="col-md-6">
            <x-report.visitor-report />
        </div>
        <div class="col-md-3">
            <div class="card p-1">
                <div class="card-body p-1">
                    <h5><b>Users Report</b></h5>
                    <p><b>Total Users: </b>{{ $total_users }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
