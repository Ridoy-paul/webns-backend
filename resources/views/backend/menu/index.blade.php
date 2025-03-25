@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="align-items-center">
        <h1 class="h3">{{ translate('Dynamic Menu') }}</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                @foreach($data as $key => $row)
                    <div class="menu-item card mb-3">
                        <div class="card-body">
                            <div class="menu-header d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">{{ $row->serial }} ) {{ $row->title }}</h5>
                                    <p class="card-text"><b>Url:</b> {{ $row->url }}</p>
                                </div>
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('menu.edit', $row->id) }}" title="{{ translate('Edit') }}"><i class="las la-edit"></i></a>
                            </div>
                            @if(count($row->submenu) > 0)
                                <ul class="submenu list-group mt-3">
                                    @foreach($row->submenu as $subMenu)
                                        <li class="list-group-item">
                                            <div class="submenu-header d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1">{{ $subMenu->serial }} ) {{ $subMenu->title }}</h6>
                                                    <p class="mb-1"><b>Url:</b> {{ $subMenu->url }}</p>
                                                </div>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('menu.edit', $subMenu->id) }}" title="{{ translate('Edit') }}"><i class="las la-edit"></i></a>
                                            </div>
                                            @if(count($subMenu->submenu) > 0)
                                                <ul class="sub-submenu sub-sub-menu list-group mt-2">
                                                    @foreach($subMenu->submenu as $subSubMenu)
                                                        <li class="list-group-item">
                                                            <div class="subsubmenu-header d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <h6 class="mb-1">{{ $subSubMenu->serial }} ) {{ $subSubMenu->title }}</h6>
                                                                    <p class="mb-1"><b>Url:</b> {{ $subSubMenu->url }}</p>
                                                                </div>
                                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('menu.edit', $subSubMenu->id) }}" title="{{ translate('Edit') }}"><i class="las la-edit"></i></a>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Add New Menu') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('menu.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">{{ translate('Title') }}</label>
                        <input type="text" placeholder="{{ translate('Title') }}" name="title" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="url">{{ translate('URL') }}</label>
                        <input type="text" placeholder="{{ translate('URL') }}" name="url" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="serial">{{ translate('Serial') }}</label>
                        <input type="number" placeholder="{{ translate('Serial') }}" name="serial" class="form-control" required>
                    </div>
                    <div class="form-group" id="parent_menu">
                        <label class="col-from-label">{{ translate('Parent Menu') }}</label>
                        <select class="form-control aiz-selectpicker" name="parent_menusuper_id" id="parent_menusuper_id" data-live-search="true">
                            <option value="0">{{ translate('Select Parent Menu') }}</option>
                            @foreach ($data as $row)
                                <option value="{{ $row->id }}">{{ $row->title }}</option>
                                @if(count($row->submenu) > 0)
                                    @foreach($row->submenu as $subMenuItem)
                                        <option value="{{ $subMenuItem->id }}">&nbsp;&nbsp;-- {{ $subMenuItem->title }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<style>
.menu-item {
    border: 1px solid #ddd;
    border-radius: 5px;
}
.submenu, .sub-submenu {
    list-style-type: none;
    padding-left: 20px;
    margin: 0;
}
.submenu > li, .sub-submenu > li {
    margin-bottom: 10px;
}
.submenu-header, .subsubmenu-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.submenu-header h6, .subsubmenu-header h6 {
    margin: 0;
}

.sub-sub-menu {
    margin-left: 20px;
}
</style>
