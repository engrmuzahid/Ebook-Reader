<ul>
    @foreach ($subMenus as $subMenu)
        <li class="submenu">
            <a href="{{ $subMenu->url() }}">{{ $subMenu->name() }}</a>

            @if ($subMenu->hasItems())
                @include('public.include.nested_sidebar', ['subMenus' => $subMenu->items()])
            @endif
        </li>
    @endforeach
</ul>
