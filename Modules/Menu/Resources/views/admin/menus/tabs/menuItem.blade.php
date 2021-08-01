@hasAccess('admin.menu_items.index')
    <div class="col-md-12 clearfix">
        @hasAccess('admin.menu_items.create')
            <div class="btn-group pull-right ">
                <a href="{{ route('admin.menus.items.create', $menu) }}" class="btn btn-primary">
                    {{ clean(trans('admin::resource.create', ['resource' => trans('menu::menu_items.menu_item')])) }}
                </a>
            </div>
    </div>
    <div class="col-md-12">
        @endHasAccess
        @if ($menu->exists)
            @hasAccess('admin.menu_items.edit')
                <div class="dd">
                    @include('menu::admin.menus.form.menu_items_list')
                </div>
            @endHasAccess
        @else
            <div class="alert alert-danger">
                {{ clean(trans('menu::menus.form.please_save_the_menu_first')) }}
            </div>
        @endif
    </div>
@endHasAccess
    

