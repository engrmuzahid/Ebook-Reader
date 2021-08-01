@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ clean($title) }}</h4>
                        
                        @if (isset($buttons, $name))
                            @foreach($buttons as $view)
                                @hasAccess("admin.{$resource}.{$view}")
                                    <a href="{{ route("admin.{$resource}.{$view}") }}" class="btn btn-primary ml-auto btn-actions btn-{{ $view }}">
                                        {{ clean(trans("admin::resource.{$view}", ['resource' => $name])) }}
                                    </a>
                                @endHasAccess
                            @endforeach
                        @else
                            {{ $buttons ?? '' }}
                        @endif
                    
                    </div>
                </div>
                <div class="card-body" id="{{ isset($resource) ? "{$resource}-table" : '' }}">
                    <div class="table-responsive">
                        @if (isset($thead))
                            <table class="display table table-striped table-hover {{ $class ?? '' }}" id="{{ $id ?? '' }}" >
                                <thead>{{ $thead }}</thead>

                                <tbody>{{ $slot }}</tbody>

                                @isset($tfoot)
                                    <tfoot>{{ $tfoot }}</tfoot>
                                @endisset
                            </table>
                        @else
                            {{ $slot }}
                        @endif
                    </div>
                </div>
            </div>
        
        </div>
    </div>
@endsection
@isset($name)
    @push('scripts')
        <script>
            @isset($resource)
            (function () {
                "use strict";
                DataTable.setRoutes('#{{ $resource }}-table .table', {
                    index: '{{ "admin.{$resource}.index" }}',
                    
                    @hasAccess("admin.{$resource}.edit")
                        @if (!isset($noedit))
                            edit: '{{ "admin.{$resource}.edit" }}',
                        @endif
                    @endHasAccess
                    @hasAccess("admin.{$resource}.destroy") 
                        destroy: '{{ "admin.{$resource}.destroy" }}',
                    @endHasAccess
                });
                
            })();   
            @endisset
        </script>
    @endpush
@endisset