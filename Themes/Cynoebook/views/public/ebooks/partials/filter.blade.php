<div class="col-md-3 col-sm-12">
    <div class="ebook-list-sidebar clearfix">
        @if ($categories->isNotEmpty())
            <div class="filter-section clearfix">
                <ul class="filter-category list-inline">
                    <h4>{{ clean(trans('cynoebook::ebooks.category')) }}</h4>
                    @foreach ($categories as $category)
                        <li class="{{ request('category') === $category->slug ? 'active' : '' }}">
                            <a href="{{ request()->fullUrlWithQuery(['category' => $category->slug, 'page' => 1]) }}">
                                {{ $category->name }}
                            </a>

                            @if ($category->items->isNotEmpty())
                                @include('public.ebooks.partials.sub_category_filter', ['subCategories' => $category->items])
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>    
</div>
