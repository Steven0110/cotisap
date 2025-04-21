@extends('theme.body')

@section('company', 'Alianza Electrica')


@section('custom-styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.min.css') }}">
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
              <li><a href="{{ URL::route('dashboard') }}">Admin Panel</a></li>
              <li><a >Administraci&oacute;n</a></li>
              <li class="active">Personalización</li>
            </ol>
          </div> <!-- end AN-BREADCRUMB -->

          <div class="an-body-topbar wow fadeIn">
            <div class="an-page-title">
              <h2>Personalización de colores</h2>
            </div>
          </div> <!-- end AN-BODY-TOPBAR -->

          @include('theme.widgets.customize-fragment')

        </div>
      </div>

      @include('theme.widgets.footer')

    </div> 

@endsection

@section('scripts')
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    var route = "{{Request::url()}}";
  </script>
  <script src="{{ asset('assets/js/sweetalert.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/js/capacitacion.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/js/validation.js') }}" type="text/javascript"></script>

  <script type="text/javascript">
    $(document).ready(function(){

      $("input[type='color']").on("change", setColor);
      $("#save-styles").on("click", saveStyles );
      loadColors();

    });

    function setColor(e){
      e = $(e.currentTarget);

      var value = e.val();
      var prop = e.attr("data-prop");
      var isBtn = e.attr("data-btn") !== undefined;
      var data = e.attr("data");

      if(!isBtn){
        if(prop == 'color'){
          $(data).find('*').css(prop, value);
        }else{
          $(data).css(prop, value);
        }
      }else{
        $(data).css(prop, value);
        $(data).css('border-color', value);
      }
    }
    function saveStyles(){
      $("#loader").show();
      $.ajax({
        method: "POST",
        url: "{{URL::route('saveColors')}}",
        data: {
          'header_background': $("#header_background").val(),
          'header_color': $("#header_color").val(),
          'sidebar_background': $("#sidebar_background").val(),
          'sidebar_color': $("#sidebar_color").val(),
          'sidebar_kpi_background': $("#sidebar_kpi_background").val(),
          'searchbox_background': $("#searchbox_background").val(),
          'btn_primary': $("#btn_primary").val(),
          'btn_success': $("#btn_success").val(),
          'btn_info': $("#btn_info").val(),
          'btn_warning': $("#btn_warning").val(),
          'btn_danger': $("#btn_danger").val()
        },
        success: function(response){
          console.log(response);
          if(response.status){
            swal({
              title: "Ok!",
              text: "Colores actualizados exitosamente",
              type: "success",
            }, function(){
              $("#loader").hide();
              location.reload();
            });
          }
        }
      });
    }
    function loadColors(){
      $.ajax({
        method: "GET",
        url: "{{URL::route('loadColors')}}",
        success: function(response){
          if(response.status){
            $("#loader-data").hide();
            
            $("#header_background").val(response.colors[0].value);
            $("#sidebar_background").val(response.colors[1].value);
            $("#sidebar_kpi_background").val(response.colors[2].value);
            $("#sidebar_color").val(response.colors[3].value);
            $("#header_color").val(response.colors[4].value);
            $("#searchbox_background").val(response.colors[5].value);
            $("#btn_primary").val(response.colors[6].value);
            $("#btn_success").val(response.colors[7].value);
            $("#btn_info").val(response.colors[8].value);
            $("#btn_warning").val(response.colors[9].value);
            $("#btn_danger").val(response.colors[10].value);
          }else{
            swal("Error", "Hubo un problema al cargar los colores guardados", "error");
          }
        }
      });
    }
  </script>
@endsection