@extends('public.layout')

@section('title')
    {{ clean(trans('author::authors.authors')) }}
@endsection

@section('breadcrumb')
    <li class="active">{{ clean(trans('author::authors.authors')) }} </li>
@endsection

@section('content')
    <section class="authors-list">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="ebook-list-header clearfix">
                    <div class="authors-result-title pull-left">
                           
                        <h3>{{ clean(trans('author::authors.authors')) }}</h3>
                        <span>{{ intl_number($authors->total()) }} {{ trans_choice('author::authors.authors_found', $authors->total()) }}</span>
                    </div>

                    <div class="authors-result-right pull-right">
                        <div class="form-group">
                            <select class="custom-select-black" onchange="location = this.value">
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest','page'=>1]) }}" {{ ($sortOption = request()->query('sort')) === 'latest' ? 'selected' : '' }}>
                                    {{ clean(trans('cynoebook::ebooks.sort_options.latest')) }}
                                </option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'oldest','page'=>1]) }}" {{ ($sortOption = request()->query('sort')) === 'oldest' ? 'selected' : '' }}>
                                    {{ clean(trans('author::authors.oldest')) }}
                                </option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'alphabetic','page'=>1]) }}" {{ ($sortOption = request()->query('sort')) === 'alphabetic' ? 'selected' : '' }}>
                                    {{ clean(trans('cynoebook::ebooks.sort_options.alphabetic')) }}
                                </option>

                                
                            </select>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="ebook-list-result m-t-10 clearfix">
                    <div class="row">
                        @forelse($authors as $author)
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="our-author">
                                    <div class="picture">
                                        @if ( ! $author->author_image->exists)
                                            {{ Theme::image('public/images/default-user-image.png') }}    
                                       
                                        @else
                                            <img class="img-fluid" src="{{ $author->author_image->path }}">
                                        @endif
                                    </div>
                                    <div class="author-content">
                                        <h4 class="name"><a href="{{ route('authors.show', $author->slug)}}" class="" aria-hidden="true">{{ $author->name }}</a></h4>
                                        <h5 class="total">
                                        {{ intl_number($author->ebooks_count) }} {{ trans_choice('author::authors.books_found', $author->ebooks_count) }}
                                        
                                        </h5>
                                    </div>
                                    <ul class="social">
                                        <li><a href="{{ route('authors.show', $author->slug)}}" class="" aria-hidden="true">{{ clean(trans('author::authors.view_details')) }}</a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12 text-center"><h3>{{ clean(trans('author::authors.no_authors_were_found')) }}</h3>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="pull-right">
                {{ $authors->links() }} 
            </div>
        </div>
        
    </section>
@endsection
