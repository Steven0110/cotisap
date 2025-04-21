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
              <li class="active">{{ 'Buscar artículo' }}</li>
            </ol>
          </div>

          <div class="an-body-topbar wow fadeIn">
            <div class="an-page-title">
              <h2>{{ 'Buscar articulos' }}</h2>
            </div>
          </div>

         
         @include('theme.widgets.ver-articulo-fragment')

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
      $("#article").select2({
        ajax: {
          url: "{{URL::route('getArticles')}}",
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
        placeholder: 'Introduzca un nombre o código de articulo ...',
        minimumInputLength: 3,
        language: 'es'
      });
      $("#article").on("select2:select", showArticleInfo);
      $("#search-button").on("click", showArticleInfo );

      var url = new URL( window.location.href );
      var id =  url.searchParams.get("id");
      if( id != null ){
        console.log( id );
        $("#article").append( $("<option value='" + id + "'>" + id + "</option>"));
        $("#article").val( id ).trigger("change.select2");
        $("#search-button").click();
      }
    });
    function showArticleInfo(){
      $("#data-loader").show();
      $.ajax({
        method : "GET",
        url : "{{URL::route('getArticleInfo')}}",
        data : {"code" : $("#article").val()},
        success : function(response){
          console.log(response);
          $("#data-loader").hide();
          $("#code").text(response.codigo);
          setValue("desc", response.descripcion);
          setValue("class", response.clase);
          setValue("umv", response.UMV);
          setValue("price", response.precio);
          setValue("group", response.grupo);
          setValue("list", response.lista);
          setValue("currency", response.moneda);
          if(response.status == 1){
            $("#status").addClass("read");
            $("#status").removeClass("spam");
            $("#status").text("ACTIVO");
          }else{
            $("#status").addClass("spam");
            $("#status").removeClass("read");
            $("#status").text("INACTIVO");            
          }
        }
      });
    }
    function setValue(id, value){
      if(value == "" || value == null)
        $("#" + id).val( "N/A");
      else
        $("#" + id).val(value);
    }
  </script>
@endsection