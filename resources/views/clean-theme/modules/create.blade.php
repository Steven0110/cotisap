	@extends('clean-theme.body')

@section('custom-styles')

  	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/preloader.css')}}">
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/css/material-bootstrap-wizard.css')}}" rel="stylesheet" />
 	<link rel="stylesheet" href="{{ asset('assets/css/sweetalert.css') }}">
	<style type="text/css">
		body > #body-container{
	      background-image: url("{{asset('assets/img/black-bg03.jpg')}}") !important;
	      background-size: cover;
	    }
		button.confirm{
			background-color: #1f3a4d !important;
		}
		.body-nav.body-nav-horizontal.body-nav-fixed{
			height: 90px !important;
		}
		.body-nav.body-nav-horizontal ul li{
			height: 90px !important;
		}
		.body-nav.body-nav-horizontal ul li a, .body-nav.body-nav-horizontal ul li button {
		  height: 90px !important;
		}
		.page.container{
			padding-top: 40px !important;
		}
	</style>
@endsection

@section('content')
    
    @include('clean-theme.menu', ['active' => 'create'])
    <section class="page container">
      
      @include('clean-theme.parts.create-fragment')
      @include('clean-theme.footer')

  </section>

@endsection

@section('scripts')
	
	<script type="text/javascript" src="{{asset('assets/js-plugins/preloader.js')}}"></script>
	<!--   Core JS Files   -->
    <script src="{{asset('assets/js-plugins/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/js-plugins/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/js-plugins/jquery.bootstrap.js')}}" type="text/javascript"></script>

    <script src="{{ asset('assets/js/ajaxSetup.js') }}" type="text/javascript"></script>
    
  	<script src="{{ asset('assets/js-plugins/sweetalert.min.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
	var no_img_route = "{{asset('assets/img/image-error.jpg')}}";
	var load_img_route = "{{asset('assets/img/loading3.gif')}}";
	var test_sap_route = "{{URL::route('testSAP')}}";
	var test_mysql_route = "{{URL::route('testMySQL')}}";
	var test_mysql_route = "{{URL::route('testMySQL')}}";
	var sql_route = "{{URL::route('getSQLFile')}}";
	var create_route = "{{URL::route('createCompany')}}";
	</script>
	<!--  Plugin for the Wizard -->
	<script src="{{asset('assets/js-plugins/material-bootstrap-wizard.js')}}"></script>

    <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="{{asset('assets/js-plugins/jquery.validate.min.js')}}"></script>


@endsection
