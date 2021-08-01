<div class="sidebar">
    <ul class="sidebar-content clearfix">
        @foreach ($primaryMenu->menus() as $menu)
            <li>
                <a href="{{ $menu->url() }}">{{ $menu->name() }}</a>

                @if ($menu->hasSubMenus())
                    @include('public.include.nested_sidebar', ['subMenus' => $menu->subMenus()])
                @endif
            </li>
        @endforeach
    </ul>
    <h6 class="category_menu_title"> {{ setting('cynoebook_category_menu_title') }}</h6>
    <ul class="sidebar-content clearfix">
        @foreach ($categoryMenu->menus() as $menu)
            <li>
                <a href="{{ $menu->url() }}">{{ $menu->name() }}</a>

                @if ($menu->hasSubMenus())
                    @include('public.include.nested_sidebar', ['subMenus' => $menu->subMenus()])
                @endif
            </li>
        @endforeach
    </ul>
</div>
