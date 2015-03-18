<!doctype html>
<html lang="{{ App::getLocale() }}">
	<head>
		<title>
			@yield('title')
		</title>
		
		@section('metatags')
			<meta charset="UTF-8">
			<meta name="csrf-token" content="{{csrf_token()}}">
		@show
		
		@section('scriptlibraries')
			{{--
				<script src="/js/libraries/jquery/2.1.1/jquery.min.js" ></script>
			--}}
		@show

		@section('styles')
				<link rel="stylesheet" href="{{asset('style/fonts/fonts.css')}}" />
				<link rel="stylesheet" href="{{asset('style/css/main.css')}}" />
		@show
		
	</head>
	
	<body class="scriptsdisabled">
		<div class="logo"></div>
		@yield('content')
		<div
			class="background"
			style="background-image: url('{{ (isset($bg) && !is_null($bg) ? asset('img'.$bg) : '') }}');"
		></div>
	</body>

	@section('scripts')
		{{-- <script src="/js/scripts/load.js"></script> --}}
	@show

</html>