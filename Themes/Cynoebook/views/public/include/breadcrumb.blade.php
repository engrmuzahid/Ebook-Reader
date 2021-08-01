@hasSection('breadcrumb')
    <div class="breadcrumb">
        <ul class="list-inline">
            <li><a href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>

            @yield('breadcrumb')
        </ul>
    </div>
@endif
