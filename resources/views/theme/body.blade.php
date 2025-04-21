<!DOCTYPE html>
<html>
	<meta name="csrf-token" content="{{ csrf_token() }}">
    @include('theme.head')
	@yield('custom-styles')
<body>

	@yield('content')

	@include('theme.footer')
	@yield('scripts')

</body>
</html>