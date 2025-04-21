<!DOCTYPE html>
<html>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="utf-8">
    @include('clean-theme.head')
	@yield('custom-styles')
<body>

	@yield('content')

	@include('clean-theme.footer')
	@yield('scripts')

</body>
</html>