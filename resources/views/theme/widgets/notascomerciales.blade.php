
<!-- Tabla de registros -->

        <div class="an-single-component with-shadow">
            <div class="an-component-header">
              <h6>{{ 'Notas comerciales' }}</h6>
              <div class="component-header-right">
                <div class="btn-space">
                    <button class="an-btn an-btn-success block-icon" data-toggle="modal" data-target="#addNotas"> <i class="ion-plus-round"></i>Agregar</button>
                </div>
              </div>
            </div>
            <div class="an-component-body padding20">
              <table id="notas">
                <thead>
                  <tr>
                    <th># {{ 'Nota' }}</th>
                    <th>{{ 'Nombre' }}</th>
                    <th>{{ 'Condiciones' }}</th>
                    <th>{{ 'Estatus' }}</th>
                    <th>{{ 'Editar' }}</th>
                    <th>{{ 'Eliminar' }}</th>
                  </tr>
                </thead>
              </table>
            </div> 
          </div> 


          <!-- Agregar nuevo registro -->
          <div class="modal fade primary" id="addNotas" tabindex="-1" role="dialog" aria-labelledby="addNotas">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 id="myModalLabel">{{ 'Agregar Nota comercial' }}</h4>
                  </div>
                  <div class="modal-body">
                    <p>
                      <form class="an-form" action="#">
                          
                          <p class="an-small-doc-blcok">Complete el siguiente formulario para poder agregar una nueva Nota comercial</p>

                          <label for="nomComercial">Nombre de la Nota comercial: </label>
                          <div class="an-input-group">
                              <div class="an-input-group-addon"><i class="ion-ios-note-outline"></i></div>
                              <input id="nomComercial" type="text" class="an-form-control"  placeholder="Nombre de la Nota comercial">
                          </div>

                          <div class="an-input-group">
                            <label for="condiciones">Estatus: </label>
                            <span class="an-custom-radiobox danger">
                              <input type="radio" name="status" id="status-1" checked="true" value="true">
                              <label for="radio-1">{{ 'Activo' }}</label>
                            </span>
                            <span class="an-custom-radiobox danger">
                              <input type="radio" name="status" id="status-2" value="false">
                              <label for="status-2">{{ 'Inactivo' }}</label>
                            </span>
                          </div>
                          <br>
                          <div class="an-input-group">
                            <label for="condiciones">Condiciones:</label>
                            <textarea id="condiciones" class="an-form-control" placeholder="Condiciones ..."></textarea>
                          </div>
                      </form>
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="an-btn an-btn-danger" data-dismiss="modal">{{ 'Cancelar' }}</button>
                    <button id="save-note" type="button" class="an-btn an-btn-success">{{ 'Guardar' }}</button>
                  </div>
              </div>
            </div>
          </div>


@section('scripts')

<!--

  * Cualquier cosa que escribas en esta parte va a aparecer despues de los scripts 
  *

-->

  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>

<!-- SCRIPTS FOR SECTION -->

  <script type="text/javascript">
   
    $(document).ready(function(){
    
    var table = $('#notas').DataTable({
        "aoColumnDefs": [
          {'bSortable': false, 'aTargets': [4 ,5] },
          {"className": "dt-center", "targets": "_all"}
        ],
        'ajax': {
          'url' : "{{ URL::route('notes.show', array('note'=> 'all')) }}",
          'type' : 'get'
        },
        'columns': [
            { 'data': 'id' },
            { 'data': 'name' },
            { 'data': 'condiciones' },
            { 'data': 'status' },
            { 'sortable': false,
              'render': function ( data, type, full, meta ) {
                     return '<button note-tag="' + full.id + '" type="button" class="an-btn an-btn-icon small update-btn"><i class="icon-setting"></i></button>';
              }
            },
            { 'sortable': false,
              'render': function ( data, type, full, meta ) {
                     return '<button note-tag="' + full.id + '" type="button" class="an-btn an-btn-icon small muted danger delete-btn"><i class="icon-trash"></i></button>';
              }
            }
        ]
     });

    $("#save-note").click(function(){
      $.ajax({
        url: '{{ URL::route("notes.store") }}',
        type: 'post',
        data: {
          name: $("#nomComercial").val(),
          condiciones: $("#condiciones").val(),
          status: 'true'
        },
        success: function(result){
          console.log(result);
          window.location.href = '{{ URL::route("general") }}' ;
        },
        error: function(result){
          console.log(result);
        }
      });
    });    


    });

  </script>

@endsection