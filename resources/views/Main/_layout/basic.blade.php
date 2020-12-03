<!DOCTYPE html>
<html>
<head>
	
	@yield('title')

	<meta charset="utf-8">
	<meta http-equiv="Content-Language" content="{{ App::getLocale() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <meta name="google-site-verification" content="WoEFPm5mEA4IkWE-EDSpSDrG7zg1ETt3LppVMm5Y5Mg" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="robots" content="index, follow" />
	<meta name="googlebot" content="all"/>

	<link rel="icon" type="image/png" href="{{ asset('public/asset/picture-default/chs.png') }}" />
	
	<link rel="stylesheet" href="{{ asset('public/main/css/public.css') }}">
	<link rel="stylesheet" href="{{ asset('public/asset/font/_font.css') }}">
	@if(!route::is('main.home'))
	<link rel="stylesheet" type="text/css" href="{{ asset('public/main/css/public-sub.css') }}">
	@endif
	@yield("include_css")
	
	<script src="{{ asset('public/backend/vendors/jquery/dist/jquery.min.js') }}"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body>
	@include('Main._layout.navigasibar')
	@yield("body")
	@include('Main._layout.footer')
	@include('Main._layout.message')
	@yield("include_js")
	<script src="{{ asset('public/main/js/public.js') }}"></script>
</body>
</html>