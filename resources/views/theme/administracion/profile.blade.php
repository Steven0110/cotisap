@extends('theme.body')

@section('company', 'Alianza Electrica')

@section('custom-styles')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
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
              <li class="active">{{ 'General' }}</li>
            </ol>
          </div>

          <div class="an-body-topbar wow fadeIn">
            <div class="an-page-title">
              <h2>{{ 'Datos de la cuenta' }}</h2>
            </div>
          </div>

          @include('theme.widgets.profile-fragment')

        </div>
      </div>

      @include('theme.widgets.footer')

    </div> 

@endsection

@section('scripts')
  <script type="text/javascript">
    $.ajax({
      url : "{{ URL::route('getInfo') }}",
      data : { "email" : "{{Auth::user()->email}}"},
      method : "GET",
      success : function( response ){
        console.log( response );
        $("#info-loader").slideUp();
        $("#slpname").val( response.general_info[0].SlpName);
        $("#slpcode").val( response.general_info[0].SlpCode);
        $("#email").val( response.general_info[0].Email);
        $("#phone").val( response.general_info[0].Telephone);
        $("#manager").val( response.general_info[0].Gerente);
      }
    });
  </script>


@endsection