@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="align-items-center">
        <h1 class="h3">{{ translate('Edit Menu') }}</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('menu.update', $menu->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="title">{{ translate('Title') }}</label>
                        <input type="text" placeholder="{{ translate('Title') }}" name="title" class="form-control" value="{{ $menu->title }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="url">{{ translate('URL') }}</label>
                        <input type="text" placeholder="{{ translate('URL') }}" name="url" class="form-control" value="{{ $menu->url }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="serial">{{ translate('Serial') }}</label>
                        <input type="number" placeholder="{{ translate('Serial') }}" name="serial" class="form-control" value="{{ $menu->serial }}" required>
                    </div>
                    <div class="form-group" id="parent_menu">
                        <label class="col-from-label">{{ translate('Parent Menu') }}</label>
                        <select class="form-control aiz-selectpicker" name="parent_menusuper_id" id="parent_menusuper_id" data-live-search="true">
                            <option value="0">{{ translate('Select Parent Menu') }}</option>
                            @foreach ($parent_menu as $row)
                                <option value="{{ $row->id }}" @if($row->id == $menu->parent_menusuper_id) selected @endif>{{ $row->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
