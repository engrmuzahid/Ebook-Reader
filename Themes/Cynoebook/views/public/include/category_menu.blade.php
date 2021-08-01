<div class="category-menu-wrapper pull-left hidden-sm {{ $shouldExpandCategoryMenu ? 'visible' : '' }}">
    <div class="category-menu-dropdown dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bars" aria-hidden="true"></i>
        {{ setting('cynoebook_category_menu_title') }}
    </div>

    <ul class="dropdown-menu vertical-mega-menu">
        @each('public.include.mega_menu.menu', $categoryMenu->menus(), 'menu')
    </ul>
</div>
