<div class="row">	

	<div class="col-md-3">
    <div class="row">
      <di class="col-md-12">
      <div class="an-single-component">
        <div class="an-component-header">
          <h6>{{ 'Buscar por cotizaci&oacute;n' }}</h6>
        </div>
        <div class="an-component-body">
          <div class="an-helper-block">
            <div class="row">
              <div class="col-md-12">
                <label for="tipoBuscar">Buscar por:</label>
                          <div class="an-input-group">
                            <span class="an-custom-radiobox">
                              <input type="radio" name="tipoBuscar" id="tipoBuscarCo"  value="tipoBuscarCo" checked="checked">
                              <label for="tipoBuscarCo"># Cotización</label>
                            </span>
                            <span class="an-custom-radiobox">
                              <input type="radio" name="tipoBuscar" id="tipoBuscarCl" value="tipoBuscarCl" >
                              <label for="tipoBuscarCl">Cliente</label>
                            </span>
                            <span class="an-custom-radiobox">
                              <input type="radio" name="tipoBuscar" id="tipoBuscarVe" value="tipoBuscarVe">
                              <label for="tipoBuscarVe">Vendedor</label>
                            </span>
                          </div>
                          <div id="whenCo">
                  <label for="numCuenta">{{ 'Ingresar palabra clave' }}:</label>
                  <div class="an-input-group">
                    <select id="numCuenta" class="an-form-control"></select>
                  </div>
                </div>
                <div id="whenVe" class="d-none">
                  <label for="numVendedor">{{ 'N&uacute;mero de Vendedor' }}:</label>
                  <div class="an-input-group">
                    <select id="numVendedor" class="an-form-control" multiple>
                      @foreach($vendedores as $vendedor)
                      
                       <option value="{{ $vendedor->email }}">{{ $vendedor->name }}</option> 
                      
                      @endforeach
                    </select>
                  </div>
                </div>
                <br/>
                <div id="whenClVe" class="d-none">
                  <label for="numPedido">Periodo:</label>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="an-daterange-picker">
                                <div id="reportrange">
                                  <i class="icon-calendar"></i>&nbsp;
                                    <span></span>
                                    <span class="hidden"></span>
                                </div>
                            </div>
                    </div>
                  </div>                  
                </div>
                <br/>
                <div class="an-input-group">
                  <input class="an-btn an-btn-success disabled" type="button" id="search" value="Buscar" >
                  <img id="cotizacionLg" hidden="hidden" height="18" src="http://localhost:8000/assets/img/loading.gif" style="display: none;">
                </div>              
              </div>
            </div>
          </div>
        </div>
      </div>        
      </di>
    </div>
		
    <div class="row">
      <div class="col-md-12">
        <div class="an-single-component">
          <div class="an-component-header">
            <h6>{{ 'Todas las cotizaci&oacute;nes' }}</h6>
          </div>
          <div class="an-component-body">
            <div class="an-helper-block">

              <div class="row">
                <div class="col-md-12">
                  <label for="numPedido">Periodo:</label>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="an-daterange-picker">
                          <div id="calendario">
                            <i class="icon-calendar"></i>&nbsp;
                              <span></span>
                            <span class="hidden"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                  <div class="an-input-group">
                    <input class="an-btn an-btn-success" type="button" id="searchTodo" value="Buscar" >
                    <img id="cotizacionLgTodo" hidden="hidden" height="18" src="http://localhost:8000/assets/img/loading.gif" style="display: none;">
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div>	   
      </div>
    </div>

  </div>


	<div class="col-md-9">
			<div class="an-single-component">
				<div class="an-component-header">
					<h6>{{ 'Cotizaci&oacute;n' }}</h6>
				</div>
				<div class="an-component-body">
					<div class="an-helper-block">
						<div class="row">
							<div class="col-md-12">

								<table id="cotizaciones" class="display" cellspacing="0" width="100%">
								        <thead>
								            <tr>
								                <th>trigger</th>
								                <th># Cotización: </th>
								                <th>Cliente: </th>
								                <th>Creada el: </th>
								                <th>Estatus: </th>
								                <th>Importe Total: </th>
								                <th>Ver cotización: </th>
								            </tr>
								        </thead>
								        <tfoot>
								            <tr>
								                <th>trigger</th>
								                <th># Cotización: </th>
								                <th>Cliente: </th>
								                <th>Creada el: </th>
								                <th>Estatus: </th>
								                <th>Importe Total: </th>
								                <th>Ver cotización: </th>
								            </tr>
								        </tfoot>
								        <tbody>

								        </tbody>
								    </table>

								<div id="contenerdor-products">
										
								</div>					
							</div>
						</div>
					</div>
				</div>
			</div>			
	</div>

</div>


<!--
  ______   _                                     _                                            _   _                 
 |  ____| | |                                   | |                                          | | | |                
 | |__    | |   ___   _ __ ___     ___   _ __   | |_    ___    ___      ___     ___   _   _  | | | |_    ___    ___ 
 |  __|   | |  / _ \ | '_ ` _ \   / _ \ | '_ \  | __|  / _ \  / __|    / _ \   / __| | | | | | | | __|  / _ \  / __|
 | |____  | | |  __/ | | | | | | |  __/ | | | | | |_  | (_) | \__ \   | (_) | | (__  | |_| | | | | |_  | (_) | \__ \
 |______| |_|  \___| |_| |_| |_|  \___| |_| |_|  \__|  \___/  |___/    \___/   \___|  \__,_| |_|  \__|  \___/  |___/
                                                                                                                    
                                                                                                                    
-->

<div class="d-none">


</div>

@section('scripts')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>

<style type="text/css">
  
  .select2-container{
    width: 100% !important;
  }

</style>

<script type="text/javascript">

	$(document).ready(function(){


		/*** Generar Tabla de cotizaciones ***/

    initTableCoti();

    function initTableCoti(){

    $("#cotizacionLg").css({
      display: 'inline-block',
      paddingLeft: '10px'
    });
      
    $('#cotizaciones').DataTable({
        "ajax" : {
          "url" : '{{ URL::route("getDataCotizacionReview") }}',
          "type" : "POST",
          "data" : {
            q : $("#numCuenta").val(),
            r : $("#numVendedor").val(),
            tipo : $('input[name="tipoBuscar"]:checked').val(),
            date : $("#reportrange").find("span:last").text().split('&')
          }
        }, 
          "columnDefs": [{
                  "className":"dt-center",
                  "orderable": false,
                    "targets": -1,
                    "data": function ( row, type, val, meta ) {
                      return '<a target="_blank" href="/dashboard/cotizaciones/nueva-cotizacion/show/' + row[1] + '" class="an-btn an-btn-icon small update-btn"><i class="icon-search"></i></a>';
                    }
                    
                 },
                  { 
                    "visible": false, 
                    "targets": 0 
          }],
          "order": [[ 0, 'asc' ]],
          "displayLength": 25,
          "drawCallback": function ( settings ) {
              var api = this.api();
              var rows = api.rows( {page:'current'} ).nodes();
  
              var last=null;
  
              var groupadmin = []; 
  
              api.column(0, {page:'current'} ).data().each( function ( group, i ) {
  
                  if ( last !== group ) {
    
                      $(rows).eq( i ).before(
                          '<tr class="group" id="'+i+'"><td colspan="6">'+group+'</td></tr>'
                      );
                      groupadmin.push(i);
                      last = group;
                  }
              } );
              
              for( var k=0; k < groupadmin.length; k++){  
                    $("#"+groupadmin[k]).nextUntil("#"+groupadmin[k+1]).addClass(' group_'+groupadmin[k]); 
                      $("#"+groupadmin[k]).click(function(){
                          var gid = $(this).attr("id");
                           $(".group_"+gid).slideToggle(100);
                      });
                   
              }
          },
          "initComplete": function(settings, json){
            $("#cotizacionLg").hide();
          }
        });
    }

    function initTableCotiTodo(){

    $("#cotizacionLgTodo").css({
      display: 'inline-block',
      paddingLeft: '10px'
    });
      
    $('#cotizaciones').DataTable({
        "ajax" : {
          "url" : '{{ URL::route("getDataCotizacionReviewAll") }}',
          "type" : "POST",
          "data" : {
            date : $("#calendario").find("span:last").text().split('&')
          }
        }, 
          "columnDefs": [{
                  "className":"dt-center",
                  "orderable": false,
                    "targets": -1,
                    "data": function ( row, type, val, meta ) {
                      return '<a target="_blank" href="/dashboard/cotizaciones/nueva-cotizacion/show/' + row[1] + '" class="an-btn an-btn-icon small update-btn"><i class="icon-search"></i></a>';
                    }
                    
                 },
                  { 
                    "visible": false, 
                    "targets": 0 
          }],
          "order": [[ 0, 'asc' ]],
          "displayLength": 25,
          "drawCallback": function ( settings ) {
              var api = this.api();
              var rows = api.rows( {page:'current'} ).nodes();
  
              var last=null;
  
              var groupadmin = []; 
  
              api.column(0, {page:'current'} ).data().each( function ( group, i ) {
  
                  if ( last !== group ) {
    
                      $(rows).eq( i ).before(
                          '<tr class="group" id="'+i+'"><td colspan="6">'+group+'</td></tr>'
                      );
                      groupadmin.push(i);
                      last = group;
                  }
              } );
              
              for( var k=0; k < groupadmin.length; k++){  
                    $("#"+groupadmin[k]).nextUntil("#"+groupadmin[k+1]).addClass(' group_'+groupadmin[k]); 
                      $("#"+groupadmin[k]).click(function(){
                          var gid = $(this).attr("id");
                           $(".group_"+gid).slideToggle(100);
                      });
                   
              }
          },
          "initComplete": function(settings, json){
            $("#cotizacionLgTodo").hide();
          }
        });
    }
    	/*** Iniciar Select de clientes y cotizaciones ***/

    	$('#numCuenta').select2({
	
    	  ajax: {
    	  	type: 'POST',
    	    url: "{{ URL::route('getAllCotizaciones') }}",
    	    dataType: 'json',
    	    delay: 250,
    	    data: function (params) {
    	      return {
    	        q: params.term,
    	        tipo: $('input[name="tipoBuscar"]:checked').val()
    	      };
    	    },
    	    processResults: function (data) {
    	      return {
    	        results: data
    	      };
    	    },
    	    cache: true
    	  },
    	  placeholder: 'Ingrese la información ...',
    	  minimumInputLength: 4,
    	  language: 'es'
	
    	});

      $('#numCuenta, #numVendedor').on('select2:select', function (e) {
        $("#search").removeClass("disabled");
      });

      $('#search').click(function(){
        if(!$(this).hasClass('disabled')){
          $('#cotizaciones').dataTable().fnDestroy();
          initTableCoti();
        }
      });

 		 /*** Iniciar select de Vendedor ***/

    	$('#numVendedor').select2({
    		placeholder: 'Seleccione el Vendedor'
    	});

    	/*** Eventos para controlar radio-button ***/
    		
    	$('input[name="tipoBuscar"]').change(function(){

    		switch ($(this).val()){
    			
    			case 'tipoBuscarCo':
    				$('#whenCo').removeClass('d-none');
    				$('#whenClVe, #whenVe').addClass('d-none');
    			break;
    			
    			case 'tipoBuscarCl':
    				$('#whenCo, #whenClVe').removeClass('d-none');
    				$('#whenVe').addClass('d-none');
    			break;
    			
    			case 'tipoBuscarVe':
    				$('#whenCo').addClass('d-none');
    				$('#whenClVe, #whenVe').removeClass('d-none');
    			break;
    		}

    	});



      $('#searchTodo').click(function(){
        if(!$(this).hasClass('disabled')){
          $('#cotizaciones').dataTable().fnDestroy();
          initTableCotiTodo();
        }
      });

	});



</script>

@endsection
