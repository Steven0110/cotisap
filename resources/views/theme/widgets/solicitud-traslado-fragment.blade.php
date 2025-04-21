@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-md-5">
  
    <div class="row">
  
      <div class="col-md-12">
          
        <div class="an-single-component with-shadow">
              <div class="an-component-header">

                <h6>Datos de la solicitud de translado</h6>
              </div>
              <div class="an-component-body padding20">
                <div class="row">
    
                  <div class="col-md-6">
                    <div class="an-input-group">
                      <label for="DocNum">N° de Documento:</label>
                      
                      <select id="Series" name="Series" style="width: 100%;">
                        @foreach($Series as $Serie)

                          <option value="{{ $Serie->Series }}">{{ $Serie->SeriesName }}</option>

                        @endforeach
                      </select>
                      <br>
                      <br>
                      <input id="DocNum" type="text" class="an-form-control" name="DocNum" placeholder="" 
                            value="{{ $DocNum[0]->DocNum + 1 }}" readonly="true">


                    </div>
                    

                    <div class="an-input-group">
                      <label for="CardCode">Socio de negocios:</label>
                      <input id="CardCode" type="text" class="an-form-control" name="CardCode" placeholder="">
                    </div>
    
                    <div class="an-input-group">
                      <label for="CardName">Nombre:</label>
                      <input id="CardName" type="text" class="an-form-control" name="CardName" placeholder="">
                    </div>

                    <div class="an-input-group">
                      <label for="DocDate">Fecha de contabilización:</label>
                      <input id="DocDate" type="text" class="an-form-control" value="{{ date('d-m-y') }}" autocomplete="off">
                    </div>
    
                    <div class="an-input-group">
                      <label for="DocDueDate">Fecha de vencimiento:</label>
                      <input id="DocDueDate" type="text" class="an-form-control" value="{{ date('d-m-y') }}" autocomplete="off">
                    </div>
    
                    <div class="an-input-group">
                      <label for="TaxDate">Fecha de documento:</label>
                      <input id="TaxDate" type="text" class="an-form-control" value="{{ date('d-m-y') }}" autocomplete="off">
                    </div>    

                  </div>
    
                  <div class="col-md-6">

                    <div class="an-input-group">
                      <label for="Name">Persona de contacto:</label>
                      <input id="Name" type="text" class="an-form-control no-edit" placeholder="" readonly>
                    </div>
                    
                    <div class="an-input-group">
                      <label for="ShipToCode">Destino:</label>
                      <input id="ShipToCode" type="text" class="an-form-control no-edit" placeholder="" readonly>
                    </div>

                    <div class="an-input-group">
                      <label for="BPLId">De sucursal:</label>
                      <input id="BPLId" type="text" class="an-form-control no-edit" placeholder="" readonly>
                    </div>

                    <div class="an-input-group">
                      <label for="fromAlmacen">De almacén:</label>

                      <select id="fromAlmacen"  style="width: 100%;">
                          <option ></option>
                        @foreach($Almacenes as $Almacen)
                          <option sucursal="{{ $Almacen->Sucursal }}" value="{{ $Almacen->WhsCode }}">{{ $Almacen->WhsCode }} | {{ $Almacen->WhsName }}</option>
                        @endforeach                        
                      </select>

                    </div>
                    <br>

                    <div class="an-input-group">
                      <label for="toAlmacen">Almacén destino:</label>

                      <select id="toAlmacen"  style="width: 100%;">
                          <option></option>
                        @foreach($Almacenes as $Almacen)
                          <option sucursal="{{ $Almacen->Sucursal }}" value="{{ $Almacen->WhsCode }}">{{ $Almacen->WhsCode }} | {{ $Almacen->WhsName }}</option>
                        @endforeach                        
                      </select>

                    </div>
                    <br>
    
                    <div class="an-input-group">
                      <label for="GroupNum">Lista de precios:</label>

                      <select id="GroupNum"  style="width: 100%;">
                        @foreach($GroupLists as $GroupList)
                          <option value="{{ $GroupList->ListNum }}">{{ $GroupList->ListName }}</option>
                        @endforeach                        
                      </select>

                    </div>

                  </div>

    
                </div>
              </div>
        </div>    
    
      </div>
    

    
    </div>
</div>   

<div class="col-md-6">
    
  <div class="an-single-component with-shadow">
        <div class="an-component-header">
          <h6>Acciones</h6>
        </div>
        <div class="an-component-body padding20">

          <div class="an-input-group">
            <input class="an-btn an-btn-success" type="button" id="search" value="Guardar" >
            <img id="cotizacionLg" hidden="hidden" height="18" src="http://localhost:8000/assets/img/loading.gif" style="display: none;">
          </div>      
          

        </div>
  </div>    


</div>

<div class="col-md-12">
  
  <div class="row">
    
      <div class="col-md-12">
        <div class="an-single-component with-shadow">
              <div class="an-component-header">
                <h6>Articulos</h6>
              </div>
              <div class="an-component-body padding20">

                <table id="articulos" class="table">

                  <thead>
                    <tr>
                      <th> Número de artículo </th>
                      <th> Descripción del artículo</th>
                      <th> De almacén </th>
                      <th> Almacén destino </th>
                      <th> Cantidad </th>
                      <th> Total </th>
                      <th> Proyecto </th>
                      <th> Eliminar</th>
                    </tr>
                  </thead>

                  <tbody>
                                       
                    <tr id="editor">
                      <td>
                        <input type="text" name="" class="ItemCode">
                      </td>
                      <td>
                        <input type="text" name="" class="Dscription">
                      </td>
                      <td>
                        <select class="FromWhsCod"  style="width: 100%;">
                          <option ></option>
                          @foreach($Almacenes as $Almacen)
                            <option sucursal="{{ $Almacen->Sucursal }}" value="{{ $Almacen->WhsCode }}">{{ $Almacen->WhsCode }} | {{ $Almacen->WhsName }}</option>
                          @endforeach                        
                        </select>
                      </td>
                      <td>
                        <select class="WhsCode"  style="width: 100%;">
                          <option ></option>
                          @foreach($Almacenes as $Almacen)
                            <option sucursal="{{ $Almacen->Sucursal }}" value="{{ $Almacen->WhsCode }}">{{ $Almacen->WhsCode }} | {{ $Almacen->WhsName }}</option>
                          @endforeach                        
                        </select>
                      </td>
                      <td>
                        <input type="number" name="" class="Quantity" style="width: 50px;">
                      </td>
                      <td>
                        <input class="price" type="text" name="" class="d4">
                      </td>
                      <td>
                        <select class="PrjCode"  style="width: 100%;">
                          <option ></option>
                          @foreach($Proyectos as $Proyecto)
                            <option value="{{ $Proyecto->PrjCode }}">{{ $Proyecto->PrjCode }}</option>
                          @endforeach                        
                        </select>
                      </td>
                      <td>
                        
                      </td>
                    </tr>

                  </tbody>  
                
                </table>

                <br>
                <br>

                <input class="an-btn an-btn-success" type="button" id="add" value="Agregar" >

              </div>
        </div>                                           
      </div>
    
  </div>

</div> 

@section('scripts')

<style type="text/css">

  .no-edit{
    background-color: #ddd;
  }
  
  .an-input-group .an-form-control {
      height: 34px;
      font-size: 14px !important;
      padding: 6px 12px;
  }
  
  label {
      font-size: 13px;
  }
  
  li.ui-menu-item {
      font-size: 14px !important;
  }

  input#DocNum {
      background-color: #4CAF50;
      color: #ffffff;
      font-weight: 700;
  }

  .ui-autocomplete-loading { 
      background: url({{ asset('assets/img/loading.gif')}}) no-repeat;
      background-size: contain;
      background-position: center right;
  }

  input[type="text"] {
    width: 100%;
  }
  

</style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">


var art = 1;

$(document).ready(function() {

    $(".ItemCode").autocomplete({
          source:'{!!URL::route('FindAllProduct')!!}',
          minlength:4, 
          select: function (event, ui) {
              $(this).val(ui.item ? ui.item : " ");},     
          change: function (event, ui) {
              if (!ui.item) {
                  this.value = '';
              }
              else{
                ProductAjax(ui.item.id);
              }
          }   
    });

    $(".Dscription").autocomplete({
          source:'{!!URL::route('FindAllProductName')!!}',
          minlength:4, 
          select: function (event, ui) {
              $(this).val(ui.item ? ui.item : " ");},     
          change: function (event, ui) {
              if (!ui.item) {
                  this.value = '';
              }
              else{
                ProductAjax(ui.item.id);
              }
          }   
    });


    $( "#CardCode" ).autocomplete({
          source:'{!!URL::route('FindAllByCardCode')!!}',
          minlength:4, 
          select: function (event, ui) {
              $(this).val(ui.item ? ui.item : " ");},     
          change: function (event, ui) {
              if (!ui.item) {
                  this.value = '';
              }
              else{
                CardAjax(ui.item.id);
              }
          }   
    });

    $( "#CardName" ).autocomplete({
          source:'{!!URL::route('FindAllByCardName')!!}',
          minlength:4, 
          select: function (event, ui) {
              $(this).val(ui.item ? ui.item : " ");},     
          change: function (event, ui) {
              if (!ui.item) {
                  this.value = '';}
              else{
                CardAjax(ui.item.id);
              }
          }   
    });

    function CardAjax(id){

      $.ajax({
        type: 'GET',
        url: '{{ URL::route('FindAllInfo') }}',
        data: { id: id },
        success: function(result){
          $("#Name").val(result[0][0].Name);
          $("#ShipToCode").val(result[1][0].Address);
          $("#CardCode").val(result[2][0].CardCode);
          $("#CardName").val(result[2][0].CardName);
          
        }
      });

    }


    function ProductAjax(id){
      $.ajax({
        type: 'GET',
        url: '{{ URL::route('FindAllProductById') }}',
        data: { id:id },
        success: function(result){
          $("input.ItemCode").val(result[0].id);
          $("input.Dscription").val(result[0].value);
        }
      });
    }


    $("#add").click(function(){
      
      var tr = '';

      $("tr#editor").find('td input, td select').each(function(){
         tr += "<td>" + $(this).val() + "</td>";
      });

      $('#articulos tr:last').after("<tr>" + tr + "</tr>");

    });

    $('#Series').select2();
    $('#fromAlmacen').select2({
      placeholder: "Selecciona almacen"
    });
    $('#toAlmacen').select2({
      placeholder: "Selecciona almacen"
    });
    
    $('.FromWhsCod').select2({
      placeholder: "Selecciona almacen"
    });
    $('.WhsCode').select2({
      placeholder: "Selecciona almacen"
    });
    $('.PrjCode').select2({
      placeholder: "Selecciona almacen"
    });

    $('#GroupNum').select2();
    $( "#DocDate, #DocDueDate, #TaxDate" ).datepicker({ dateFormat: 'dd-mm-yy' });

    $('#fromAlmacen').on('select2:select', function (e) {
      $("#BPLId").val($(this).find('option:selected').attr('sucursal'));
    });


  });

</script>

@endsection
