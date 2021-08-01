<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="{{ setting('theme_logo_header_color','blue') }}">
        
        <a href="{{ route('admin.dashboard.index') }}" class="logo">
            <h2 class="navbar-brand title">{{ setting('site_name') ? setting('site_name') : '' }}</h2>
        </a>
        @if(!$fullwidth)
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        @endif
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        
        @if(!$fullwidth)
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
        @endif
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="{{ setting('theme_navbar_header_color','blue2') }}">
        
        <div class="container-fluid">
            
            <ul class="navbar-nav topbar-nav align-items-center">
                
            </ul>
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item hidden-caret">
                    <a class="nav-link" href="{{ route('home') }}" role="button" data-toggle="tooltip" data-placement="bottom" title="{{ clean(trans('admin::admin.visit_frontend')) }}">
                         <i class="fas fa-home"></i>  
                        
                    </a>
                </li>
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="localeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ strtoupper(locale()) }}
                    </a>
                    <ul class="dropdown-menu animated fadeIn" aria-labelledby="localeDropdown">
                        <div class="scrollbar-outer">
                            <li>
                                @foreach (supported_locales() as $locale => $language)
                                    
                                    <a class="dropdown-item" href="{{ localized_url($locale) }}">{{ clean($language['name']) }}</a>
                                    
                                @endforeach
                                
                            </li>
                        </div>
                    </ul>
                </li>
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            @if(isset($currentUser->avatar->path))
                                <img src="{{ $currentUser->avatar->path }}" alt="..." class="avatar-img rounded-circle">
                            @else
                                <img src="{{ url('modules/admin/images/user-icon.png') }}" alt="..." class="avatar-img rounded-circle">
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                        @if(Auth::check())
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                    @if(isset($currentUser->avatar->path))
                                        <img src="{{ $currentUser->avatar->path }}" alt="image profile" class="avatar-img rounded">
                                    @else
                                        <img src="{{ url('modules/admin/images/user-icon.png') }}" alt="image profile" class="avatar-img rounded">
                                    @endif
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ clean($currentUser->full_name) }}</h4>
                                        <p class="text-muted">{{ clean($currentUser->email) }}</p><a href="{{ route('admin.profile.edit') }}" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">{{ clean(trans('user::users.profile')) }}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}">{{ clean(trans('user::auth.logout')) }}</a>
                            </li>
                        @else
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin.login') }}">{{ clean(trans('user::auth.sign_in')) }}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin.register') }}">{{ clean(trans('user::auth.sign_up')) }}</a>
                            </li>    
                        @endif
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>		
