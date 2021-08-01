@extends('public.layout')

@section('title')
    @if (request()->has('query'))
        {{ clean(trans('cynoebook::ebooks.search_results_for')) }}: "{{ request('query') }}"
    @else
        {{ clean(trans('cynoebook::ebooks.ebooks')) }}
    @endif
@endsection

@section('breadcrumb')
    @if (request()->has('query') || request()->has('category'))
        <li><a href="{{ route('ebooks.index') }}">{{ clean(trans('cynoebook::ebooks.ebooks')) }}</a></li>
        
        @if(request()->has('category'))
            @if(request()->has('query'))
                <li><a href="{{ route('ebooks.index', ['category' => request('category')]) }}">{{ request('category') }}</a></li>
            @else
                <li class="active">{{ request('category') }}</li>
            @endif
        @endif
        
        @if(request()->has('query'))
            <li class="active">{{clean(trans('cynoebook::ebooks.search_results_for')) }}:{{ request('query') }}</li>
        @endif
        
        
    @else
        <li class="active">{{ clean(trans('cynoebook::ebooks.ebooks')) }}</li>
    @endif
    
    
    
@endsection

@section('content')
    <section class="ebook-list">
        <div class="row">
            @include('public.ebooks.partials.filter')

            <div class="col-md-9 col-sm-12">
                @if (setting('cynoebook_ad1_section_enabled'))
                    @include('public.home.sections.advertisement',['ad'=>setting('cynoebook_ad_1')])
                @endif 
                <div class="ebook-list-header clearfix">
                    <div class="search-result-title pull-left">
                        @if (request()->has('query'))
                            <h3>{{ clean(trans('cynoebook::ebooks.search_results_for')) }}: "{{ request('query') }}"</h3>
                        @else
                            <h3>{{ clean(trans('cynoebook::ebooks.ebooks')) }}</h3>
                        @endif

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

                        <div class="form-group">
                            <select class="custom-select-black" onchange="location = this.value">
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" {{ ($sortOption = request()->query('sort')) === 'latest' ? 'selected' : '' }}>
                                    {{ clean(trans('cynoebook::ebooks.sort_options.latest')) }}
                                </option>

                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'alphabetic']) }}" {{ ($sortOption = request()->query('sort')) === 'alphabetic' ? 'selected' : '' }}>
                                    {{ clean(trans('cynoebook::ebooks.sort_options.alphabetic')) }}
                                </option>

                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'topRated']) }}" {{ $sortOption === 'topRated' ? 'selected' : '' }}>
                                    {{ clean(trans('cynoebook::ebooks.sort_options.top_rated')) }}
                                </option>

                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'relevance']) }}" {{ $sortOption === 'relevance' ? 'selected' : '' }}>
                                    {{ clean(trans('cynoebook::ebooks.sort_options.relevance')) }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="ebook-list-result clearfix">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane {{ ($viewMode = request('viewMode', setting('ebook_vide_mode','grid'))) === 'grid' ? 'active' : '' }}">
                            <div class="row">
                                <div class="grid-ebooks separator">
                                    @if ($viewMode === 'grid')
                                        @forelse ($ebooks as $ebook)
                                            @include('public.ebooks.partials.ebook_card')
                                        @empty
                                            <h3>{{ clean(trans('cynoebook::ebooks.no_ebooks_were_found')) }}</h3>
                                        @endforelse
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div id="list-view" class="tab-pane {{ $viewMode === 'list' ? 'active' : '' }}">
                            @if ($viewMode === 'list')
                                @forelse ($ebooks as $ebook)
                                    @include('public.ebooks.partials.list_view_ebook_card')
                                @empty
                                    <h3>{{ clean(trans('cynoebook::ebooks.no_ebooks_were_found')) }}</h3>
                                @endforelse
                            @endif
                        </div>
                    </div>
                </div>

                <div class="pull-right">
                    {{ $ebooks->links() }}
                </div>
                @if (setting('cynoebook_ad2_section_enabled'))
                    @include('public.home.sections.advertisement',['ad'=>setting('cynoebook_ad_2')])
                @endif 
            </div>
        </div>
    </section>
@endsection
