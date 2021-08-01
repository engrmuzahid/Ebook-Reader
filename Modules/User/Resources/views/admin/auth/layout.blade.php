<!DOCTYPE html>
<html lang="{{ locale() }}">
<head>
    <base href="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title> @yield('title') - eBook Admin</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	

	<!-- Fonts and icons -->
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900&display=swap" rel="stylesheet">
    
    @foreach ($assets->allCss() as $css)
            <link media="all" type="text/css" rel="stylesheet" href="{{ v($css) }}">
    @endforeach

	@include('admin::include.general')
    
</head>
<body class="login">
    <div class="wrapper wrapper-login">
        
        @yield('content')
    
    </div>
    @foreach($assets->allJs() as $js)
        <script src="{{ v($js) }}"></script>
    @endforeach
</body>
</html>
