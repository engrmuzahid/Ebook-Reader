<ol class="dd-list">
    @foreach ($menuItems as $menuItem)
        <li class="dd-item " data-id="{{ $menuItem->id }}">
            
            @if (! $menuItem->is_root)
                <div class="menu-item-actions btn-group" role="group">
                    
                    <a href="{{ route('admin.menus.items.edit', [$menu->id, $menuItem->id]) }}" class="edit-menu-item">
                    <button type="button" class="btn btn-icon  btn-xs">
                       <i class="fas fa-pencil-alt"></i>
                    </button>
                    </a>

                    <button type="button" class="delete-menu-item btn btn-icon  btn-xs" data-action="{{ route('admin.menus.items.destroy', [$menu->id, $menuItem->id]) }}">
                       <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            @endif
            
            <div class="{{ $menuItem->is_root ? 'dd-handle-root' : 'dd-handle' }} {{ $menuItem->is_active ? 'menu-active' : 'menu-inactive' }}">{{ $menuItem->name }}</div>
            
            @if (count($menuItem->items) !== 0)
                @include('menu::admin.menus.form.menu_items_list', ['menuItems' => $menuItem->items])
            @endif
        </li>
    @endforeach
</ol>