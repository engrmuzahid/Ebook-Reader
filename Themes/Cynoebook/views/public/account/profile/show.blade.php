@extends('public.layout')

@section('title')
        {{ $user->first_name }} {{ $user->last_name }}
@endsection

@section('breadcrumb')
    <li><a href="{{ route('users.index') }}">{{ clean(trans('user::users.users')) }}</a></li>
    <li class="active">{{ $user->first_name }} {{ $user->last_name }}</li>
@endsection

@section('content')
    <section class="ebook-list">
        <div class="row">
            
            <div class="col-md-4 col-sm-12">
                <div class="ebook-list-sidebar user-details clearfix">
                    <div class="user-details-section clearfix">
                        
                        @if ( ! $user->avatar->exists)
                            <div class="default-placeholder">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            </div>
                        @else
                            <div class="image-placeholder">
                                <img src="{{ $user->avatar->path }}">
                            </div>
                        @endif
                        
                        <h4>{{ $user->full_name }}</h4>
                        <span class="role" data-toggle="tooltip" title="{{ is_null($user->created_at) ? '' : $user->created_at->toFormattedDateString() }}">
                            ( {{ clean(trans('user::users.joined')) }}  {{ is_null($user->created_at) ? '&mdash;' : $user->created_at->diffForHumans() }} )
                        </span>
                        
                        <p class="details-section">
                            {{$user->about}}
                        </p>
                    </div>
                    <ul class="social-links list-inline"> 
                        @if ($user->facebook!='')
                            <li><a href="{{ $user->facebook }}"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                        @endif
                        @if ($user->twitter!='')
                            <li><a href="{{ $user->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        @endif
                        @if ($user->google!='')
                            <li><a href="{{ $user->google }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        @endif
                        @if ($user->instagram!='')
                            <li><a href="{{ $user->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        @endif
                        @if ($user->linkedin!='')
                            <li><a href="{{ $user->linkedin }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        @endif
                        @if ($user->youtube!='')
                            <li><a href="{{ $user->youtube }}"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>

            
            <div class="col-md-8 col-sm-12">
                <div class="ebook-list-header clearfix">
                    <div class="search-result-title pull-left">
                           
                        <h3>{{ clean(trans('cynoebook::ebooks.books_by')) }} {{ $user->full_name }}</h3>
                        <span>{{ intl_number($ebooks->total()) }} {{ trans_choice('cynoebook::ebooks.ebooks_found', $ebooks->total()) }}</span>
                    </div>

                    <div class="search-result-right pull-right">
                        <ul class="nav nav-tabs">
                            <li class="view-mode {{ ($viewMode = request('viewMode', setting('ebook_vide_mode','grid'))) === 'grid' ? 'active' : '' }}">
                                <a href="{{ $viewMode === 'grid' ? '#' : request()->fullUrlWithQuery(['viewMode' => 'grid']) }}" title="{{ clean(trans('cynoebook::ebooks.grid_view')) }}">
                                    <i class="fa fa-th-large" aria-hidden="true"></i>
                                </a>
                            </li>

                            <li class="view-mode {{ $viewMode === 'list' ? 'active' : '' }}">
                                <a href="{{ $viewMode === 'list' ? '#' : request()->fullUrlWithQuery(['viewMode' => 'list']) }}" title="{{ clean(trans('cynoebook::ebooks.list_view')) }}">
                                    <i class="fa fa-th-list" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="ebook-list-result clearfix">
                    <div class="tab-content">
                        @if ($viewMode === 'grid')
                            <div id="grid-view" class="tab-pane {{ ($viewMode = request('viewMode', setting('ebook_vide_mode','grid'))) === 'grid' ? 'active' : '' }}">
                                <div class="row">
                                    <div class="grid-ebooks separator">
                                        
                                            @forelse ($ebooks as $ebook)
                                                @include('public.ebooks.partials.ebook_card')
                                            @empty
                                                <h3>{{ clean(trans('cynoebook::ebooks.no_ebooks_were_found')) }}</h3>
                                            @endforelse
                                        
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($viewMode === 'list')
                        <div id="list-view" class="tab-pane {{ $viewMode === 'list' ? 'active' : '' }}">
                            
                                @forelse ($ebooks as $ebook)
                                    @include('public.ebooks.partials.list_view_ebook_card')
                                @empty
                                    <h3>{{ clean(trans('cynoebook::ebooks.no_ebooks_were_found')) }}</h3>
                                @endforelse
                            
                        </div>
                        @endif
                    </div>
                </div>

                <div class="pull-right">
                    {{ $ebooks->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
