
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('title')</title>
	<link rel="apple-touch-icon" sizes="57x57" href="ico/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="ico/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="ico/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="ico/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="ico/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="ico/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="ico/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="ico/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="ico/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="ico/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="ico/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="ico/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="ico/favicon-16x16.png">
<link rel="manifest" href="ico/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="ico/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/icons/icomoon/styles.min.css'); }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/bootstrap.min.css'); }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/bootstrap_limitless.min.css'); }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/layout.min.css'); }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/components.min.css'); }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/colors.min.css'); }}" rel="stylesheet" type="text/css">
	<script src="{{ asset('js/main/jquery.min.js') }}"></script>
	<script src="{{ asset('js/main/bootstrap.bundle.min.js'); }}"></script>
	<script src="{{ asset('js/main/validate.min.js'); }}"></script>
	<script src="{{ asset('js/js/login_validation.js') }}"></script>
</head>
<body class="bg-blue">
	<div class="page-content">
		<div class="content-wrapper">
			@yield('content')
		</div>
	</div>

    @stack('footscript')
</body>
</html>
