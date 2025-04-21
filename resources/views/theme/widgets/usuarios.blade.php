<div class="row">

  <div class="col-md-5">
        <div class="an-single-component with-shadow">
          <div class="an-component-header">
            <h6>Roles</h6>
          </div>
          <div class="an-component-body">
            <div class="an-helper-block">
              <table id="rolesTable">
                <thead>
                  <tr>
                    <th>Clave</th>
                    <th>Rol</th>
                    <th>Editar</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($roles as $rol)
                  <tr>
                    <td>{{ $rol->id }}</td>
                    <td>{{ $rol->rol }}</td>
                    <td><button id="role{{ $rol->id }}" class="btnRol" data-id="{{ $rol->id }}" data-toggle="modal" data-target="#editRole"> <i class="ion-plus-round"></i> Editar</button></td>
                  </tr>
                  @endforeach                                                     
                </tbody>
              </table>
            </div>
          </div>
        </div>    
  </div>  

  <div class="col-md-7">       
       <div class="an-single-component with-shadow">
          <div class="an-component-header">
            <h6>Usuarios</h6>
          </div>
          <div class="an-component-body">
            <div class="an-helper-block">
                <div class="row">
                  <div class="col-md-12">
                    <table id="usuariosTable">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Usuario</th>
                          <th>Rol</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($usuarios as $user)
                          <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @if( !empty($user->U_admin) )
                              <td>{{ $user->U_admin }}</td>
                            @else
                              <td>V</td>
                            @endif
                          </tr>                          
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>      
            </div>
          </div>
        </div>
  </div>

</div>

<!-- Editar roles de usuario -->


<div class="modal fade primary" id="editRole" tabindex="-1" role="dialog" aria-labelledby="editRole">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 id="myModalLabel">{{ 'Editar rol de Usuario' }}</h4>
        </div>
        <div class="modal-body">

        <div id="tree-rol">
            <ul>
                <li><input name="cotizacionesParent" type="checkbox"><span>Cotizaciones</span>
                    <ul>
                        <li><input name="nueva-cotizacion" type="checkbox"><span>Nueva cotización</span></li>
                        <li><input name="buscar-cotizacion" type="checkbox"><span>Buscar cotizaciones</span></li>
                        <li><input name="alta-cliente" type="checkbox"><span>Alta cliente</span></li>
                        <li><input name="articulos" type="checkbox"><span>Ver Artículos</span></li>
                        <li><input name="nuevo-articulo" type="checkbox"><span>Nuevo artículo</span></li>
                        <li><input name="refrencias-cruzadas" type="checkbox"><span>Referencias cruzadas</span></li>
                    </ul>
                </li>
                <li><input name="buscar-pedido" type="checkbox"><span>Pedidos</span></li>
                <li><input name="buscar-entrega" type="checkbox"><span>Entregas</span></li>
                <li><input name="buscar-facturas" type="checkbox"><span>Facturas</span></li>
                <li><input name="monitor-avance" type="checkbox"><span>Monitor de avance</span></li>
                <li><input name="reportesParent" type="checkbox"><span>Reportes</span>
                    <ul>
                        <li><input name="antiguedad-saldo" type="checkbox"><span>Antiguedad de saldos</span></li>
                        <li><input name="estados-cuenta" type="checkbox"><span>Estados de cuenta</span></li>
                        <li><input name="commissions" type="checkbox"><span>Comisiones</span></li>
                    </ul>
                </li>                
                <li><input name="solicitudesParent" type="checkbox"><span>Solicitudes</span>
                    <ul>
                        <li><input name="scliente" type="checkbox"><span>Alta cliente SAP</span></li>
                        <li><input name="scredito" type="checkbox"><span>Solicitud de crédito</span></li>
                    </ul>
                </li>
                <li><input name="biblioteca" type="checkbox"><span>Biblioteca</span></li>
                <li><input name="administracionParent" type="checkbox"><span>Adminitración</span>
                    <ul>
                        <li><input name="general" type="checkbox"><span>General</span></li>
                        <li><input name="herramientas.index" type="checkbox"><span>Herramientas</span></li>
                        <li><input name="usuarios" type="checkbox"><span>Usuarios</span></li>
                        <li><input name="capacitacion" type="checkbox"><span>Capacitación</span></li>
                        <li><input name="slider" type="checkbox"><span>Slider</span></li>
                        <li><input name="policy" type="checkbox"><span>Pólizas</span></li>
                        <li><input name="specs" type="checkbox"><span>Especificaciones</span></li>
                        <li><input name="customisation" type="checkbox"><span>Personalización</span></li>
                    </ul>
                </li>                 
            </ul>
        </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="an-btn an-btn-danger" data-dismiss="modal">{{ 'Cancelar' }}</button>
          <button id="save-role" data-id='0' type="button" class="an-btn an-btn-success">{{ 'Guardar' }}</button>
        </div>
    </div>
  </div>
</div>


@section('scripts')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>


<script type="text/javascript">


  var rolesConfig = new Array();

  @foreach($roles as $rol)         
    
    rolesConfig[{{ $rol->id }}] = JSON.parse('{!! json_decode($rol->dataConfig) !!}');

  @endforeach


  var tree;

  $(document).ready(function(){

    var roles = $("#rolesTable").DataTable();
    var usuarios = $("#usuariosTable").DataTable();

    tree = $('#tree-rol').tree({
      dnd: false,
      checkAll: true
    });


    /*********
    Crear Rol
    **********/

    $("#save-role").click(function(){

    var jsonRole = [];

    $("#tree-rol > ul > li").each(function(i, obj){
      
      var jsonChild = [];

      $(obj).find("ul > li > input").each(function(x, objx){
      
        jsonChild.push([{
          name: $(objx).attr("name"),
          status: $(objx).is(':checked')
        }]);

      });

      jsonRole.push([{
        name: $(obj).find('> input').attr("name"),
        status: $(obj).find('> input').is(':checked'),
        children: jsonChild
      }]);

    });

  $.ajax({
      url: "{{ URL::route('setRol') }}",
      type: 'post',
      data: {
        id : $("#save-role").attr('data-id'),
        dataConfig: JSON.stringify(jsonRole)
      }, 
      success: function(){
        location.reload();
      }
    });

    console.log(jsonRole);

   });


    /***************
      Actualizar Rol
    ****************/

    $(".btnRol").click(function(){
      
      var dataId = $(this).attr('data-id');
      
      $("#save-role").attr('data-id', dataId);
      
      $("#tree-rol input[type='checkbox']").prop('checked', false);

      $.each(rolesConfig[dataId], function(i, obj){

        if(obj[0].status){
          $("#tree-rol input[name='" + obj[0].name + "']").prop('checked', true);
        } 

        $.each(obj[0].children, function(ix, objx){
          
          if(objx[0].status){
            $("#tree-rol input[name='" + objx[0].name + "']").prop('checked', true);
          } 

        });

      });

    });

  });

</script>

@endsection