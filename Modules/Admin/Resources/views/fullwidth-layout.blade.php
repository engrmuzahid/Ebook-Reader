<!DOCTYPE html>
<html lang="{{ locale() }}">
<head>
    <base href="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title> @yield('title') - Advanced Files & Users Management</title>
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
       <!-- Main Header -->
            @include('admin::include.header',['fullwidth'=>true])
		<!-- End Main Header -->
		
		<div class="main-panel">
			<div class="content">
                <div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            @yield('page-header')
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
                    <div class="row">
                        @include('admin::include.notification')
                    </div>
                    
                    @yield('content')
                    
                </div>
			</div>
             
			<footer class="footer">
				<div class="container-fluid">
                    @include('admin::include.footer')	
				</div>
			</footer>
		</div>
		
	</div>
	
    @foreach($assets->allJs() as $js)
        <script src="{{ v($js) }}"></script>
    @endforeach
    
    
    @stack('scripts')
    
</body>
</html>