@extends('theme.body')

@section('company', 'Alianza Electrica')


@section('custom-styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.min.css') }}">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/multiple-select/multiple-select.css') }}">
@endsection

@section('content')

    <div class="main-wrapper">
      
      @include('theme.topheader')

      <div class="an-page-content">
        <div class="an-sidebar-nav js-sidebar-toggle-with-click">

          @include('theme.widgets.sidebar-widget')

          @include('theme.menu')
          
        </div>

        <div class="an-content-body home-body-content">
          
          <div class="an-breadcrumb wow fadeInUp">
            <ol class="breadcrumb">
              <li><a href="#">{{ 'Inicio' }}</a></li>
              <li><a href="#">{{ 'Articulos' }}</a></li>
              <li class="active">{{ 'Transferencia' }}</li>
            </ol>
          </div>

          <div class="an-body-topbar wow fadeIn">
            <div class="an-page-title">
              <h2>{{ 'Transferencia entre sucursales' }}</h2>
            </div>
          </div>

         
         @include('theme.widgets.create-transferencia-fragment')

        </div>
      </div>

      @include('theme.widgets.footer')

    </div> 

@endsection


@section('scripts')
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="{{ asset('assets/js/sweetalert.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/js/validation.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/js-plugins/multi-select.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
    
    });
  </script>
@endsection