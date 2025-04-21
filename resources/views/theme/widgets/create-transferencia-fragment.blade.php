@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="row">
  
  <div class="col-md-4">
      
    <div class="an-single-component with-shadow">
          <div class="an-component-header">
            <h6>Crear transferencia</h6>
          </div>
          <div class="an-component-body padding20">
            <form id="formBuscador">
              {{ csrf_field() }}
              <div class="row">
                
                <div class="col-md-6">
                  <label for="Series">{{ 'Serie' }}: </label>
                  <div class="an-input-group">
                    <div class="an-default-select-wrapper">
                      <select id="Series" name="Series" >
                        <option value="0">{{ 'Serie' }}</option>
                        @foreach($Series as $Serie)
                          <option value="{{ $Serie->Series }}">{{ $Serie->SeriesName }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="DocNum">{{ 'Número de documento' }}: </label>
                  <div class="an-input-group">
                    <input type="text" id="DocNum" class="an-form-control not-null" name="DocNum" />
                  </div>      
                </div>

                <div class="col-md-6">
                  <label for="CardCode">{{ 'Socios de negocio' }}: </label>
                  <div class="an-input-group">
                    <input type="text" id="CardCode" class="an-form-control not-null" name="CardCode" />
                  </div>      
                </div>

                <div class="col-md-6">
                  <label for="CardName">{{ 'Nombre' }}: </label>
                  <div class="an-input-group">
                    <input type="text" id="CardName" class="an-form-control not-null" name="CardName" />
                  </div>      
                </div>

              </div>

              <div class="row">
                
                <div class="col-md-6">
                  <label for="DocDate">{{ 'Fecha de contabilización' }}: </label>
                  <div class="an-input-group">
                    <input type="text" id="DocDate" class="an-form-control not-null" name="DocDate" />
                  </div>      
                </div>

                <div class="col-md-6">
                  <label for="DocDueDate">{{ 'Fecha de vencimiento' }}: </label>
                  <div class="an-input-group">
                    <input type="text" id="DocDueDate" class="an-form-control not-null" name="DocDueDate" />
                  </div>      
                </div>

                <div class="col-md-6">
                  <label for="TaxDate">{{ 'Fecha de documento' }}: </label>
                  <div class="an-input-group">
                    <input type="text" id="TaxDate" class="an-form-control not-null" name="TaxDate" />
                  </div>      
                </div>

                <div class="col-md-6">
                  <label for="BPLId">{{ 'De sucursal' }}: </label>
                  <div class="an-input-group">
                    <input type="text" id="BPLId" class="an-form-control not-null" name="BPLId" />
                  </div>      
                </div>

              </div>


              <div class="row">
                
                <div class="col-md-6">
                  <label for="Filler">{{ 'De almacén' }}: </label>
                  <div class="an-input-group">
                    <input type="text" id="Filler" class="an-form-control not-null" name="Filler" />
                  </div>      
                </div>

                <div class="col-md-6">
                  <label for="ToWhsCode">{{ 'Almacén destino' }}: </label>
                  <div class="an-input-group">
                    <input type="text" id="ToWhsCode" class="an-form-control not-null" name="ToWhsCode" />
                  </div>      
                </div>


              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="an-input-group">
                    <input class="an-btn an-btn-success " type="submit" id="search" value="Buscar">
                    <img id="cotizacionLg" hidden="hidden" height="18" src="http://localhost:8000/assets/img/loading.gif" style="display: none; padding-left: 10px;">
                  </div>
                </div>
              </div>

            </form>
          </div>

    </div>    

  </div>

  <div class="col-md-8">
      
    <div class="an-single-component with-shadow">
          <div class="an-component-header">
            <h6>Crear transferencia</h6>
          </div>
          <div class="an-component-body padding20">

            <table id="Buscar">
              <thead>
                <tr>
                  <th>Doc</th>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Creación</th>
                  <th>Total</th>
                  <th>Origen</th>
                  <th>Destino</th>
                  <th>Ver:</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>

          </div>
    </div>    


  </div>

</div>


@section('scripts')

<style type="text/css">
  
  .an-input-group .an-form-control {
    padding-left: 10px !important;
  }

</style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>

<script type="text/javascript">

  $(document).ready(function(){

    $('#Buscar').DataTable();

    function initDatable(){

        $('#Buscar').DataTable({
              "scrollX": true,
              "ajax" : {
                 "url" : "{{ URL::route('TransferSearchDocument') }}",
                 "type" : "POST",
                 "data" : {
                   DocNum : 11000244
                 }
              },
              "columns": [
                { "data": "DocNum" },
                { "data": "CardCode" },
                { "data": "CardName" },
                { "data": "DocDate" },
                { "data": "DocTotal" },
                { "data": "origen" },
                { "data": "destino" },
                { "data": "Ver" },
              ],
              "columnDefs": [
              {
                render: function ( data, type, row ){
                  return '<a target="_blank" href="/dashboard/cotizaciones/nueva-cotizacion/show/' + row["DocNum"] + '" class="an-btn an-btn-icon small update-btn"><i class="icon-search"></i></a>';
                },
                "targets": -1
              }]
        });      

    }

    $("#formBuscador").submit(function(e){

      e.preventDefault();

      $('#Buscar').dataTable().fnDestroy();
      
      initDatable();
    
    });

    

  });

</script>

@endsection
