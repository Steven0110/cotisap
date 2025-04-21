@extends('theme.body')

@section('company', 'Alianza Electrica')

@section('custom-styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.min.css') }}">
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
              <li><a href="#">{{ 'Cotizaciones' }}</a></li>
              <li class="active">{{ 'Nuevo artículo' }}</li>
            </ol>
          </div>

          <div class="an-body-topbar wow fadeIn">
            <div class="an-page-title">
              <h2>{{ 'Nuevo artículo' }}</h2>
            </div>
          </div>

          @include('theme.widgets.nuevo-articulo-fragment')

        </div>
      </div>

      @include('theme.widgets.footer')

    </div> 

@endsection

@section('scripts')
  <script src="{{ asset('assets/js/sweetalert2.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/js/validation.js') }}" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip({trigger: "manual"});
      $("input.not-null").on("focusout", checkInputEmptyness );
      $("#save").on("click", saveArticle );
    });
    function saveArticle(){
      if(validateForm()){
        $("#save img").show();
        $.ajax({
          url : "{{URL::route('articulos')}}",
          method : "POST",
          data : {
            "codigo" : $("#codArt").val(),
            "desc" : $("#descArt").val(),
            "clase" : "0",
            "grupo" : "0",
            "lista" : "0",
            "UMV" : $("#unidadMedida option:selected").text(),
            "precio" : $("#precioVenta").val(),
            "moneda" : $("#moneda option:selected").text(),
            "comm" : $("#comm").val()
          },
          success : function(response){
            if(response.status){
              swal({
                title : "Articulo agregado correctamente",
                text : "Puedes revisarlo en la sección de Artículos",
                type : "success"
              });
              $("#save img").hide();
              clearForm();
            }
          }
        });
      }
    }
    function clearForm(){
      $("#codArt").val("");
      $("#descArt").val("");
      $("#comm").val("");
      $("#precioVenta").val("");
    }

    function validateForm(){
      var valid_count = 0;
      $("input.not-null").each(function(){
        checkInputEmptyness( $(this) ) ? null : valid_count-- ;
      });
      var SELECT = $("#moneda").siblings("div");
      if($("select#moneda option:selected").val() == "0"){
        SELECT.attr("data-original-title", "Escoge una moneda");
        SELECT.attr("title", "Escoge una moneda");
        SELECT.tooltip("show");
        valid_count--;
      }else{
        SELECT.tooltip("hide");
      }
      SELECT = $("#unidadMedida").siblings("div");
      if($("select#unidadMedida option:selected").val() == "0"){
        SELECT.attr("data-original-title", "Escoge una unidad de medida");
        SELECT.attr("title", "Escoge una unidad de medida");
        SELECT.tooltip("show");
        valid_count--;
      }else{
        SELECT.tooltip("hide");
      }
      return valid_count >= 0;
    }
    
  </script>
@endsection