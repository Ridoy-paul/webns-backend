<div class="aiz-sidebar-wrap">
    <div class="aiz-sidebar left c-scrollbar">
        <div class="aiz-side-nav-logo-wrap">
            <a href="{{ route('admin.dashboard') }}" class="d-block text-left">
                @if(get_setting('system_logo_white') != null)
                    <img class="mw-100" src="{{ uploaded_asset(get_setting('system_logo_white')) }}" class="brand-icon" alt="{{ get_setting('site_name') }}">
                @else
                    <h4 class="mb-o" style="color: aliceblue !important;"><b>Super Admin</b></h4>
                    {{-- <img class="mw-100" src="{{ static_asset('assets/img/logo.png') }}" class="brand-icon" alt="{{ get_setting('site_name') }}"> --}}
                @endif
            </a>
        </div>
        <div class="aiz-side-nav-wrap"> 
            
            <ul class="aiz-side-nav-list" id="search-menu">
            </ul>
            <ul class="aiz-side-nav-list" id="main-menu" data-toggle="aiz-side-menu">
                
                <li class="aiz-side-nav-item">
                    <a href="{{route('admin.dashboard')}}" class="aiz-side-nav-link">
                        <i class="las la-home aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{translate('Dashboard')}}</span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-dharmachakra aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Settings & Others</span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <!--Submenu-->
                    <ul class="aiz-side-nav-list level-2 mm-collapse">
                        
                        <li class="aiz-side-nav-item">
                            <a href="{{ route('admin.settings') }}" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">{{translate('Settings')}}</span>
                            </a>
                        </li>

                        

                        <li class="aiz-side-nav-item">
                            <a href="{{ route('countries.index') }}" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">{{translate('Countries')}}</span>
                            </a>
                        </li>

                        <li class="aiz-side-nav-item">
                            <a href="{{ route('division.index') }}" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">{{translate('Division')}}</span>
                            </a>
                        </li>

                        <li class="aiz-side-nav-item">
                            <a href="{{ route('district.index') }}" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">{{translate('District')}}</span>
                            </a>
                        </li>

                        {{-- <li class="aiz-side-nav-item">
                            <a href="#" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">{{translate('Thana / Area')}}</span>
                            </a>
                        </li>

                        <li class="aiz-side-nav-item">
                            <a href="#" class="aiz-side-nav-link">                                
                                <span class="aiz-side-nav-text">{{translate('Sub Area')}}</span>
                            </a>
                        </li>

                        <li class="aiz-side-nav-item">
                            <a href="{{ route('pages.index') }}" class="aiz-side-nav-link">                                
                                <span class="aiz-side-nav-text">{{translate('Dynamic Pages')}}</span>
                            </a>
                        </li>

                        <li class="aiz-side-nav-item">
                            <a href="{{ route('admin-categories.index') }}" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">{{translate('Categories')}}</span>
                            </a>
                        </li> --}}

                    </ul>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-dharmachakra aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Blog & News</span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <!--Submenu-->
                    <ul class="aiz-side-nav-list level-2 mm-collapse">
                        
                        <li class="aiz-side-nav-item">
                            <a href="{{ route('blogs.create') }}" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">{{translate('Add Blog')}}</span>
                            </a>
                        </li>

                        <li class="aiz-side-nav-item">
                            <a href="{{ route('blogs.index') }}" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">{{translate('List of Blog')}}</span>
                            </a>
                        </li> 
                    </ul>
                </li>

                
                {{-- Uploads Files --}}
                <li class="aiz-side-nav-item">
                    <a href="{{ route('uploaded-files.index') }}" class="aiz-side-nav-link">
                        <i class="las la-folder-open aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{ translate('Uploaded Files') }}</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="aiz-sidebar-overlay"></div>
</div>
