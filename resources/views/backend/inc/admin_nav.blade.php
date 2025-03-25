<div class="aiz-topbar px-15px px-lg-25px d-flex align-items-stretch justify-content-between">
    <div class="d-flex">
        <div class="aiz-topbar-nav-toggler d-flex align-items-center justify-content-start mr-2 mr-md-3 ml-0"
            data-toggle="aiz-mobile-nav">
            <button class="aiz-mobile-toggler">
                <span></span>
            </button>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-stretch flex-grow-xl-1">
        <div class="d-flex justify-content-around align-items-center align-items-stretch">
            <div class="d-flex justify-content-around align-items-center align-items-stretch">
                <div class="aiz-topbar-item">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-outlined-success border" href="{{ route('index') }}" target="_blank"
                            title="{{ translate('Browse Website') }}">
                            Browse Website
                        </a>
                    </div>
                </div>
            </div>
           
            <div class="d-flex justify-content-around align-items-center align-items-stretch ml-3">
                <div class="aiz-topbar-item">
                    <div class="d-flex align-items-center">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-around align-items-center align-items-stretch">

            <div class="aiz-topbar-item ml-2">
                <div class="align-items-stretch d-flex dropdown">
                    <a class="dropdown-toggle no-arrow text-dark" data-toggle="dropdown" href="javascript:void(0);"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <span class="avatar avatar-sm mr-md-2">
                                <img src="{{ static_asset('assets/img/avatar-place.png') }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                            </span>
                            <span class="d-none d-md-block">
                                {{-- <span class="d-block fw-500">{{ Auth::user()->name }}</span>
                                <span class="d-block small opacity-60">{{ Auth::user()->user_type }}</span> --}}
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-md">
                        <a href="{{ url('admin/users/'.Auth::user()->id.'/edit') }}" class="dropdown-item">
                            <i class="las la-user-circle"></i>
                            <span>{{ translate('Profile') }}</span>
                        </a>

                        <a href="{{ route('logout') }}" class="dropdown-item">
                            <i class="las la-sign-out-alt"></i>
                            <span>{{ translate('Logout') }}</span>
                        </a>
                    </div>
                </div>
            </div><!-- .aiz-topbar-item -->
        </div>
    </div>
</div><!-- .aiz-topbar -->
