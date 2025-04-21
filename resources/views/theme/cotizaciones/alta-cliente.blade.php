@extends('theme.body')

@section('company', 'Alianza Electrica')


@section('custom-styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.min.css') }}"/>
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
              <li class="active">{{ 'Alta de cliente' }}</li>
            </ol>
          </div>

          <div class="an-body-topbar wow fadeIn">
            <div class="an-page-title">
              <h2>{{ 'Nuevo cliente' }}</h2>
            </div>
          </div>

          @include('theme.widgets.alta-cliente-fragment')

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
    $(".not-null").on("focusout", checkInputEmptyness );
    $("#registrar").on("click", registerClient)
  });
  function validateForm(){
    var valid_count = 0;
    $(".not-null").each(function(){
      checkInputEmptyness( $(this) ) ? null : valid_count-- ;
    });
    return valid_count >= 0;
  }
  function clearForm(){
    $("input").val('');
  }
  function registerClient(){
    if(validateForm()){
      $.ajax({
        method: "POST",
        data: {
          'name': $("#pContacto").val(),
          'tel': $("#telCliente").val(),
          'email': $("#emailCliente").val(),
          'razon': $("#razonCliente").val(),
          'limiteCredito': $("#limiteCredito").val()
        },
        url: "{{URL::route('cliente_nosap')}}",
        success: function(response){
          if(response.status){
            clearForm();
            swal("Bien!", "Cliente agregado correctamente", "success");
          }
        }
      });
    }
  }
</script>
@endsection