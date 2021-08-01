<ul>
    @foreach ($subCategories as $subCategory)
        <li class="{{ request('category') === $subCategory->slug ? 'active' : '' }}">
            <a href="{{ request()->fullUrlWithQuery(['category' => $subCategory->slug, 'page' => 1]) }}">
                {{ $subCategory->name }}
            </a>

            @if ($subCategory->items->isNotEmpty())
                @include('public.ebooks.partials.sub_category_filter', ['subCategories' => $subCategory->items])
            @endif
        </li>
    @endforeach
</ul>
