@extends('public.layout')

@section('breadcrumb')
    @if (request()->routeIs('account.dashboard.index'))
        <li><a href="{{ route('account.dashboard.index') }}">{{ clean(trans('cynoebook::account.links.my_account')) }}</a></li>
        <li class="active">{{ clean(trans('cynoebook::account.links.my_ebook')) }}</li>
        
    @else
        <li><a href="{{ route('account.dashboard.index') }}">{{ clean(trans('cynoebook::account.links.my_account')) }}</a></li>
    @endif

    @yield('account_breadcrumb')
@endsection

@section('content')
    @if (setting('cynoebook_ad1_section_enabled'))
       @include('public.home.sections.advertisement',['ad'=>setting('cynoebook_ad_1')])
    @endif 
    <div class="row">
        <div class="my-account clearfix">
            <div class="col-md-3">
                <div class="sidebar-menu">
                    <ul class="list-inline">
                        <li class="{{ request()->routeIs('account.dashboard.index') ? 'active' : '' }}">
                            <a href="{{ route('account.dashboard.index') }}">
                                <i class="fa fa-book" aria-hidden="true"></i>
                                {{ clean(trans('cynoebook::account.links.my_ebook')) }}
                            </a>
                        </li>
                        @if(setting('enable_ebook_upload'))
                        <li class="{{ request()->routeIs('ebooks.upload') ? 'active' : '' }}">
                            <a href="{{ route('ebooks.upload') }}">
                                <i class="fa fa-upload" aria-hidden="true"></i>
                                {{ clean(trans('cynoebook::account.links.upload_ebook')) }}
                            </a>
                        </li>
                        <li class="{{ ( request()->routeIs('account.authors.index' ) || request()->routeIs('account.authors.create' ) || request()->routeIs('account.authors.edit' )  ) ? 'active' : '' }}">
                            <a href="{{ route('account.authors.index') }}">
                                <i class="fa fa-address-book" aria-hidden="true"></i>
                                {{ clean(trans('cynoebook::account.links.my_authors')) }}
                            </a>
                        </li>
                        @endif
                        
                        <li class="{{ request()->routeIs('account.favorite.index') ? 'active' : '' }}">
                            <a href="{{ route('account.favorite.index') }}">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                {{ clean(trans('cynoebook::account.links.my_favorite')) }}
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('account.reviews.index') ? 'active' : '' }}">
                            <a href="{{ route('account.reviews.index') }}">
                                <i class="fa fa-comment" aria-hidden="true"></i>
                                {{ clean(trans('cynoebook::account.links.my_reviews')) }}
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('user.profile.show') ? 'active' : '' }}">
                            <a target="_blank" href="{{ route('user.profile.show',auth()->user()->username) }}">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                {{ clean(trans('cynoebook::account.links.my_profile')) }}
                            </a>
                        </li>
                        
                        <li class="{{ request()->routeIs('account.profile.edit') ? 'active' : '' }}">
                            <a href="{{ route('account.profile.edit') }}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                {{ clean(trans('cynoebook::account.links.edit_profile')) }}
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                {{ clean(trans('cynoebook::account.links.logout')) }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                <div class="clearfix"></div>

                <div class="content-right clearfix">
                    @yield('content_right')
                </div>
            </div>
            
            
            
        </div>
    </div>
    @if (setting('cynoebook_ad2_section_enabled'))
       @include('public.home.sections.advertisement',['ad'=>setting('cynoebook_ad_2')])
    @endif
@endsection
