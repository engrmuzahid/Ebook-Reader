@if ($categoryMenu->menus()->isNotEmpty() || $primaryMenu->menus()->isNotEmpty())
    <div class="megamenu-wrapper hidden-sm hidden-xs">
        <div class="container">
            <nav class="navbar navbar-default">
                @include('public.include.category_menu')
                @include('public.include.primary_menu')
            </nav>
        </div>
    </div>
@endif
