@extends('theme.body')

@section('company', 'Alianza Electrica')


@section('custom-styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.min.css') }}">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/multiple-select/multiple-select.css') }}">
  <style type="text/css">
    th.slpname{
      background-color: #3d3e40;
      color: white;
    }
    span.slpname{
    }
  </style>
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
              <li><a href="#">{{ 'Pedidos' }}</a></li>
              <li class="active">{{ 'Buscar pedidos' }}</li>
            </ol>
          </div>

          <div class="an-body-topbar wow fadeIn">
            <div class="an-page-title">
              <h2>{{ 'Buscar pedidos' }}</h2>
            </div>

          </div>

         @include('theme.widgets.buscar-pedido-fragment')

        </div>
      </div>

      @include('theme.widgets.footer')

    </div> 

@endsection

@section('scripts')
  <script src="{{ asset('assets/js/sweetalert2.min.js') }}" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="//cdn.rawgit.com/ashl1/datatables-rowsgroup/v1.0.0/dataTables.rowsGroup.js"></script>
  <script src="{{ asset('assets/js-plugins/multi-select.js') }}"></script>
  <script src="{{ asset('assets/js/validation.js') }}"></script>
  <script type="text/javascript">
      var lang_ES_EN = {
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_ registros",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "Buscar:",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     "Siguiente",
              "sPrevious": "Anterior"
          },
          "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
      }
    $(document).ready(function(){
      loadSLP()
      $("#orders-table").DataTable({
        language: lang_ES_EN,
        //rowsGroup: [5],
        responsive : true,
        "order": [[ 1, "desc" ]],
        "ordering" : false,
        "columnDefs": [
            { "visible": false, "targets": 3 },
            {"className": "dt-center", "targets": "_all"},
            {"className": "slpname", "targets": 0},
            {"render" : function(data, type, row){
                    return "<span class='slpname'><strong>" + data + "</strong></span>";
              }, "targets" : 0 },
        ],
        rowsGroup: [4],
        "drawCallback": function ( settings ) {
              var api = this.api();
              var rows = api.rows( {page:'current'} ).nodes();
              var last=null;
   
              api.column(3, {page:'current'} ).data().each( function ( group, i ) {
                  if ( last !== group ) {
                      $(rows).eq( i ).before(
                          '<tr class="group"><td colspan="6"><strong>'+group+'</strong></td></tr>'
                      );
   
                      last = group;
                  }
              } );
          }
      });
      $("#orders-button").on("click", generateOrdersReport);
      $("#total-table").DataTable({
        language: lang_ES_EN
      });
    });
    function loadSLP(){
        $.ajax({
            method : "GET",
            url : "{{URL::route('getAllSLP')}}",
            success : function( response ){
                response.actives.forEach(function(e){
                    var OPTION = $("<option></option>");
                    OPTION.val( e.id );
                    OPTION.text( e.text );
                    $("[label='activos']").append( OPTION );
                });
                response.inactives.forEach(function(e){
                    var OPTION = $("<option></option>");
                    OPTION.val( e.id );
                    OPTION.text( e.text );
                    $("[label='inactivos']").append( OPTION );
                });
                $("#slp").multipleSelect({
                    placeholder : "Vendedores..."
                });
                $("#slp-container").show();
                $("#slp-loader").hide();
                $("#orders-button").removeAttr("disabled");
            }
        });
    }
    function generateOrdersReport(){
      var table = $("#orders-table").DataTable();
      var t_table = $("#total-table").DataTable();
      table.clear();
      table.draw();
      t_table.clear();
      t_table.draw();
      $("#table-loader").show();
      $.ajax({
        method : "POST",
        url : "{{URL::route('getOrdersInfo')}}",
        data : {"slp" : $("#slp").val() },
        success : function(response){
          $("#table-loader").hide();
          response.orders.forEach(function(e){
            table.row.add([
              e.SlpName,
              e.NumAtCard,
              e.DocDate.substr(0, 10),
              e.Cliente,
              formatCurrency(sliceNumber(getGroupTotal(response.orders, e.Cliente, e.DocDate), 2)),
              formatCurrency(sliceNumber(e.DocTotal, 2))
            ]);
          });
          table.draw();

          $("#slp option:selected").each(function(i, e){
            //console.log( e );
            t_table.row.add([
              $(e).text(),
              formatCurrency(sliceNumber(getSLPTotal(response.orders, $(e).text()), 2))
            ]);
          });
          t_table.draw();
          //setTDSlpNameClass();
        }
      });
    }
    function setTDSlpNameClass(){
      var slp_span = $(".slpname");
      $.each(slp_span, function(i, e){
        $(e).parents("td").addClass("slpname");
      });
    }
    function getGroupTotal(orders, client, date){
      var total = 0;
      orders.forEach(function(e){
        if(e.Cliente === client && e.DocDate === date)
          total += Number(e.DocTotal);
      });
      return total;
    }
    function getSLPTotal(orders, slpname){
      var total = 0;
      orders.forEach(function(e){
        if(e.SlpName === slpname)
          total += Number(e.DocTotal);
      });
      return total; 
    }
  </script>
@endsection

