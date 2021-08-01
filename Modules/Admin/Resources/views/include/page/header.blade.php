@section('title')
    @isset($subtitle)
        {{  "{$subtitle} - {$title}" }}
    @else
        {{ $title }}
    @endisset
@endsection

@section('page-header')
<h4 class="page-title">{{ $title }}</h4>
<ul class="breadcrumbs">
    <li class="nav-home">
        <a href="#">
            <i class="flaticon-home"></i>
        </a>
    </li>
    <li class="separator">
        <i class="flaticon-right-arrow"></i>
    </li>
    {{ $slot }}
</ul>
@endsection
