<ul class="dropdown-menu {{ $class ?? '' }}">
    @foreach ($subMenus as $subMenu)
        <li class="{{ $subMenu->hasItems() ? 'dropdown-submenu' : '' }}">
            <a href="{{ $subMenu->url() }}" class="{{ $subMenu->hasItems() ? 'dropdown-toggle' : '' }}" target="{{ $subMenu->target() }}">
                {{ $subMenu->name() }}
            </a>

            @if ($subMenu->hasItems())
                @include('public.include.mega_menu.dropdown', ['subMenus' => $subMenu->items()])
            @endif
        </li>
    @endforeach
</ul>
