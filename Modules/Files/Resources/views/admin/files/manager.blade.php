<!DOCTYPE html>
<html lang="{{ locale() }}">
<head>
    <meta charset="UTF-8">

    <title>{{ clean(trans('files::files.files_manager')) }}</title>

    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    
    <!-- Fonts and icons -->
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900&display=swap" rel="stylesheet">

    @foreach ($assets->allCss() as $css)
        <link media="all" type="text/css" rel="stylesheet" href="{{ v($css) }}">
    @endforeach

    @include('admin::include.general')
</head>
<body data-background-color="bg3">
    <div class="wrapper overlay-sidebar">
        <div class="main-panel">
			<div class="">
                <div class="page-inner">
                    @include('files::admin.files.include.uploader')
                    @include('files::admin.files.include.table')
                </div>
            </div>
        </div>
    </div>
    @foreach($assets->allJs() as $js)
        <script src="{{ v($js) }}"></script>
    @endforeach
   
    <script>
        
        (function () {
            "use strict";
            DataTable.setRoutes('#files-table .table', {
                index: {
                    name: 'admin.files.index',
                    params: { type: '{{ $type }}',extension: '{{ $extension }}' }
                },
                
                @hasAccess("admin.files.edit")
                    
                    edit: '{{ "admin.files.edit" }}',
                    
                @endHasAccess
                @hasAccess("admin.files.destroy") 
                    destroy: '{{ "admin.files.destroy" }}',
                @endHasAccess
            });
            new DataTable('#files-table .table', {
                columns: [
                    { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                    { data: 'thumbnail', orderable: false, searchable: false, width: '10%' },
                    { data: 'filename', name: 'filename' },
                    { data: 'size', name: 'size', orderable: false,searchable: false,},
                    { data: 'extension', name: 'extension' },
                    { data: 'created', name: 'created_at' },
                    { data: 'action', name: 'action',orderable: false, searchable: false,className:"noclickable" },
                ],
            });
            
        })();   
        
    </script>
    
</body>
</html>