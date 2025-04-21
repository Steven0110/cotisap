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
              <li><a href="#">{{ 'Clientes' }}</a></li>
              <li class="active">{{ 'Buscar cliente' }}</li>
            </ol>
          </div>

          <div class="an-body-topbar wow fadeIn">
            <div class="an-page-title">
              <h2>{{ 'Buscar articulos' }}</h2>
            </div>
          </div>

         
         @include('theme.widgets.ver-cliente-fragment')

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
      $("#client").select2({
        ajax: {
          url: "{{URL::route('getCliente')}}",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              q: params.term
            };
          },
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        },
        placeholder: 'Introduzca un nombre o código de cliente ...',
        minimumInputLength: 3,
        language: 'es'
      });
      $("#client").on("select2:select", showClientInfo);
      $("#search-button").on("click", showClientInfo );
      var url = new URL( window.location.href );
      var id =  url.searchParams.get("id");
      if( id != null ){
        console.log( id );
        $("#client").append( $("<option value='" + id + "'>" + id + "</option>"));
        $("#client").val( id ).trigger("change.select2");
        $("#search-button").click();
      }
    });
    function showClientInfo(){
      $("#data-loader").show();
      $.ajax({
        method : "GET",
        url : "{{URL::route('getClienteData')}}",
        data : {"q" : $("#client").val()},
        success : function(response){
          console.log(response);
          $("#data-loader").hide();

          $("#code").text( response[0][0].CardCode );
          setValue("name", response[0][0].CardName);
          setValue("rfc", response[0][0].LicTradNum);
          setValue("phone", response[0][0].Phone1);
          setValue("email", response[0][0].E_Mail);
          setValue("website", response[0][0].IntrntSite);
          setValue("person", response[0][0].Person);

          setValue("cname", response[1][0].cpName);
          setValue("cphone", response[1][0].cpPhone);
          setValue("cemail", response[1][0].cpEmail);

          setValue("street", response[2][0].fStreet);
          setValue("city", response[2][0].fCity);
          setValue("suburb", response[2][0].fCol);
          setValue("del_mun", response[2][0].fCounty);
          setValue("state", response[2][0].fState);
          setValue("country", response[2][0].fCountry);
          setValue("cp", response[2][0].fZip);

          if(response[3].length > 0){
            setValue("sstreet", response[3][0].eStreet);
            setValue("scity", response[3][0].eCity);
            setValue("ssuburb", response[3][0].eCol);
            setValue("sdel_mun", response[3][0].eCounty);
            setValue("sstate", response[3][0].eState);
            setValue("scountry", response[3][0].eCountry);
            setValue("scp", response[3][0].eZip);
          }else{
            setValue("sstreet", "Sin información");
            setValue("scity", "Sin información");
            setValue("ssuburb", "Sin información");
            setValue("sdel_mun", "Sin información");
            setValue("sstate", "Sin información");
            setValue("scountry", "Sin información");
            setValue("scp", "Sin información");            
          }
        }
      });
    }
    function setValue(id, value){
      $("#" + id).val( value == null ? "Sin información" : utf8_decode( value) );
    }
    function utf8_decode(s) {
      return decodeURIComponent(escape(s));
    }
  </script>
@endsection