<li class="nav-item {{ $active ? 'active' : '' }} {{ $item->getItemClass() ? $item->getItemClass() : '' }}"> 
    <a 
        @if($item->hasItems())
            data-toggle="collapse" href="#{{ preg_replace('/\s+/', '',$item->getName()) }}" 
        @else
            href="{{ $item->getUrl() }}" 
        @endif
        
        @if($item->getNewTab())target="_blank"@endif
        
    >
        <i class="{{ $item->getIcon() }}"></i>
        <span>{{ $item->getName() }}</span>
        
        @foreach ($badges as $badge)
            {!! clean($badge, array('Attr.EnableID' => true)) !!}
        @endforeach
        
        @if($item->hasItems())<span class="caret"></span>@endif
        
    </a>
    
    @foreach($appends as $append)
        {!! clean($append, array('Attr.EnableID' => true)) !!}
    @endforeach
    
    @if(count($items) > 0)
        <div class="collapse" id="{{ preg_replace('/\s+/', '',$item->getName()) }}">
            <ul class="nav nav-collapse">
                @foreach($items as $item)
                    {!! clean($item, array('Attr.EnableID' => true)) !!}
                @endforeach
            </ul>
        </div>
    @endif
    
</li>
