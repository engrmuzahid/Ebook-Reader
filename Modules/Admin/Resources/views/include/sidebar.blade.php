<div class="sidebar sidebar-style-2" data-background-color="{{ setting('theme_sidebar_color','white') }}" >
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    @if(isset($currentUser->avatar->path))
                        <img src="{{ $currentUser->avatar->path }}" alt="..." class="avatar-img rounded-circle">
                    @else
                        <img src="{{ url('modules/admin/images/user-icon.png') }}" alt="..." class="avatar-img rounded-circle">
                    @endif
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <i class="fa fa-user-circle-o"></i><span>{{ clean($currentUser->full_name) }}</span>
                            <span class="user-level">{{ clean($currentUser->roles()->pluck('name')->implode(', ')) }}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('admin.profile.edit') }}">
                                    <span class="link-collapse">{{ clean(trans('user::users.profile')) }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.logout') }}">
                                    <span class="link-collapse">{{ clean(trans('user::auth.logout')) }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {!! clean($sidebar, array('Attr.EnableID' => true)) !!}
            
        </div>
    </div>
</div>
		