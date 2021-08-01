@if($group->shouldShowHeading())
    <li class="nav-section">
        <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
        </span>
        <h4 class="text-section">{{ $group->getName() }}</h4>
    </li>
@endif

@foreach($items as $item)
    {!! $item !!}
@endforeach
