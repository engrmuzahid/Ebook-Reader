<ul class="dropdown-menu">
    <li>
        <div class="fluid-menu-content">
            @foreach ($menu->subMenus()->chunk(3) as $chunk)
                <div class="row">
                    @foreach ($chunk as $subMenu)
                        <div class="col-sm-4">
                            <a href="{{ $subMenu->url() }}" class="title" target="{{ $subMenu->target() }}">
                                {{ $subMenu->name() }}
                            </a>

                            <ul class="list-inline">
                                @foreach ($subMenu->items() as $item)
                                    <li>
                                        <a href="{{ $item->url() }}" target="{{ $subMenu->target() }}">
                                            {{ $item->name() }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </li>
</ul>
