@extends('clean-theme.body')

@section('custom-styles')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/preloader.css')}}">
  <style type="text/css">
  	html, body {margin: 0; height: 100%; overflow: hidden}
    body > #body-container{
      background-image: url("{{asset('assets/img/black-bg03.jpg')}}") !important;
      background-size: cover;
    }
    .body-nav.body-nav-horizontal{
      border-bottom: none;
    }
  </style>
@endsection

@section('content')
    
    @include('clean-theme.menu')
    <section class="page container">
      
      @include('clean-theme.parts.page-container')
      @include('clean-theme.footer')

  </section>

@endsection

@section('scripts')
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
	<script type="text/javascript" src="{{asset('assets/js-plugins/preloader.js')}}"></script>
  	<script type="text/javascript">
  		particlesJS.load('body-container', "{{asset('assets/particles.json')}}", function() {
  			console.log('callback - particles.js config loaded');
		});
  	</script>

@endsection
