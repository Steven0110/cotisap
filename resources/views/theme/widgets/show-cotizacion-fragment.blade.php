<div class="row">
  <div class="col-md-3">
       <div class="an-single-component with-shadow">
          <div class="an-component-header">
            <h6>{{ 'Datos del cliente' }}</h6>
          </div>
          <div class="an-component-body">
            <div class="an-helper-block">
              
              <label for="clienteCodigo">{{ 'C&oacute;digo de cliente' }}: </label>
              <div class="an-input-group">
                <div class="an-input-group-addon"><i class="ion-ios-checkmark-outline"></i></div>
                <input type="text" class="an-form-control ok" id="clienteCodigo" name="clienteCodigo" value="{{ $cotizacion['Quotations'][0]->numCliente }}">
              </div>
              <label for="CardName2">{{ 'Nombre del cliente' }}: </label>
              <div class="an-input-group" >
                <div class="an-input-group-addon"><i class="ion-ios-checkmark-outline"></i></div>
                <input type="text" id="CardName2" class="an-form-control CardName ok" name="CardName2" value="{{ $cotizacion['Quotations'][0]->nombreCliente }}" readonly >
              </div>
            </div>
          </div>
        </div>
  </div>
  <div class="col-md-6">
        <div class="an-single-component with-shadow">
          <div class="an-component-header">
            <h6>{{ 'Operaciones de la cotizaci&oacute;n' }}</h6>
          </div>
          <div class="an-component-body">
            <div class="an-helper-block">
                <div class="row">
                    <div class="col-md-6">
                      <p>
                        {{ 'A continuaci&oacute;n puedes seleccionar el estatus de la cotizaci&oacute;n.' }}
                      </p>
                      <div class="an-input-group">
                        <label for="estatus">Estatus: </label><br>
                        <select name="estatus" id="estatus">
                          <option value="0">Cotizada</option>
                          <option value="1">Completada</option>
                          <option value="2">Pagada</option>
                          <option value="3">Cancelada</option>
                        </select>
                      </div>
                      <br>
                      {{ 'Programar cotizaci&oacute;n' }} :
                      <br>

                      <input type="text" name="quotationCron" id="quotationCron">
                      

                     </div>
                     <div class="col-md-6">
                       <div class="an-input-group">
                         <label for="coments">Comentarios:</label>
                         <textarea name="coments" id="coments" class="" cols="30" rows="3" style="resize: none;">{{ $cotizacion['Quotations'][0]->comentarios}}</textarea>
                       </div>
                      <br>
                        <div class="an-input-group">
                            <button id="update" class="an-btn btn-success block-icon"><i class="ion-check"></i> Actualizar</button>
                        </div>
                     </div>
                </div>
            </div>
          </div>
        </div>    
  </div>

  <div class="col-md-3">       
      <div class="an-single-component with-shadow totales">
         <div class="an-component-header">
           <h6>{{ 'Total de la cotizaci&oacute;n' }}</h6>
         </div>
         <div class="an-component-body">
           <div class="an-helper-block">

             <div class="row">
               <div class="col-md-12">
                 <h4 style="color: #E91E63;">{{ 'Total' }} : <span id="totalCoti"> {{ $cotizacion['Quotations'][0]->total}} </span> <i class="moneda"> {{ $cotizacion['Quotations'][0]->Moneda}}</i></h4>
                 <h5 style="color: #E91E63;">{{ 'Total de pagos' }} : <span id="totalpagos"></span></h5>
                 <h5 style="color: #E91E63;">{{ 'Restante' }} : <span id="restante"></span></h5>
               </div>
             </div>
            
             <div class="row">
               <div class="col-md-12">
                  <br>
                  <a target="_blank" href="{{ URL::route('pdfQuotation', $id) }}"><button class="an-btn an-btn-primary btn-block">Ver en PDF</button></a>
                  <br>
                  <button class="an-btn an-btn-success  btn-block ">Enviar e-mail</button>
                  <br>
                  <button id="makeSAP" class="an-btn an-btn-info disabled btn-block">Crear en SAP</button>
                  <br>
                  <button class="an-btn an-btn-danger disabled btn-block">Solicitar pedido</button>

               </div>
             </div>

           </div>
         </div>
       </div>
 </div>
</div>

<!-- Informacion de pago -->

<div class="row">
    <div class="col-md-12">
      <div class="an-single-component with-shadow">
        <div class="an-component-header">
          <h6>{{ 'Información de pago' }}</h6>
        </div>
        <div class="an-component-body">
          <div class="an-helper-block">
            <div class="row">
              <div class="col-md-2">
                Método de pago *
              </div>
              <div class="col-md-1">
                Monto *
              </div>
              <div class="col-md-1">
                Moneda *
              </div>
              <div class="col-md-2">
                Referencia *
              </div>
              <div class="col-md-2">
                Fecha de pago *
              </div>
              <div class="col-md-2">
                Comprobante
              </div>
              <div class="col-md-2">
                Status
              </div>    
            </div>
            
            <div id="container-pay" class="row">
              
              @foreach($getPayment as $payment)
  
                  <div id="save-pay[{{ $loop->iteration }}]" class="row item-pay save">
                    <div class="col-md-2">
                       <div class="an-input-group">
  
                        <select id='formPay[{{ $loop->iteration }}]' class="an-form-control formPay" disabled>
                          @if (!strcmp($payment->metodo, '01'))
                            <option value="01" selected="selected">Efectivo</option>
                            <option value="02">Cheque</option>
                            <option value="03">Transferencia electrónica</option>
                            <option value="04">Tarjeta de crédito</option>
                          @elseif (!strcmp($payment->metodo, '02'))
                            <option value="01">Efectivo</option>
                            <option value="02" selected="selected">Cheque</option>
                            <option value="03">Transferencia electrónica</option>
                            <option value="04">Tarjeta de crédito</option>
                          @elseif (!strcmp($payment->metodo, '03'))
                            <option value="01">Efectivo</option>
                            <option value="02">Cheque</option>
                            <option value="03" selected="selected">Transferencia electrónica</option>
                            <option value="04">Tarjeta de crédito</option>
                          @elseif (!strcmp($payment->metodo, '04'))
                            <option value="01">Efectivo</option>
                            <option value="02">Cheque</option>
                            <option value="03">Transferencia electrónica</option>
                            <option value="04" selected="selected">Tarjeta de crédito</option>
                          @endif
                        </select>
  
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="an-input-group">
                        <input id="formMonto[{{ $loop->iteration }}]" type="text" class="an-form-control" value="{{ $payment->monto }}" readonly>
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="an-input-group">
                        <input type="text" id="formCurrency[{{ $loop->iteration }}]" class="an-form-control formCurrency"  value="{{ $payment->moneda }}" readonly>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="an-input-group">
                        <input id="formRef[{{ $loop->iteration }}]" type="text" name="" class="an-form-control" value="{{ $payment->referencia }}" readonly>  
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="an-input-group">
                        <input id="formDate[{{ $loop->iteration }}]" type="date" name="" class="an-form-control" value="{{ $payment->date }}" readonly>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="an-input-group">
                        <input id="formFile[{{ $loop->iteration }}]" type="file" name="" class="an-form-control disabled" value="{{ $payment->comprobante }}" readonly>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="an-input-group">
                        <select id='statusPay[{{ $loop->iteration }}]' class="an-form-control statusPay">
                          
                          @if (!strcmp($payment->status, '01'))
                            <option value="01" selected="selected">Pagado</option>
                            <option value="02">En proceso</option>
                            <option value="03">No pago</option>
                          @elseif (!strcmp($payment->status, '02'))
                            <option value="01">Pagado</option>
                            <option value="02" selected="selected">En proceso</option>
                            <option value="03">No pago</option>
                          @elseif (!strcmp($payment->status, '03'))
                            <option value="01">Pagado</option>
                            <option value="02">En proceso</option>
                            <option value="03" selected="selected">No pago</option>
                          @endif                        
  
  
                        </select>  
                      </div>
                    </div>
                  </div>            
  
  

              @endforeach
  
  
  
            </div>
  
            <br>
            <div class="row">
              <div class="col-md-12 text-right">
                <button id="addPay" class="an-btn an-btn-success block-icon"><i class="ion-plus-round"></i> Agregar pago</button>
              </div>
              <div class="col-md-12">
                <p>&nbsp;</p>
              </div>
  
              <div class="col-md-12 text-right">
                @if (count($getPayment) > 0)
                  <button id="validarPay" class="an-btn an-btn-warning">Validar Pagos</button>
                @else
                  <button id="validarPay" class="an-btn an-btn-warning disabled">Validar Pagos</button>
                @endif     
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Operaciones sobre la cotizacion -->

<div class="col-md-12">
     <div class="an-single-component with-shadow">

<!--
  ______                          _                                _                 _            _             _   _         _           
 |  ____|                        | |                              | |               | |          | |           | | (_)       | |          
 | |__     _ __     ___    __ _  | |__     ___   ____   __ _    __| |   ___       __| |   ___    | |   __ _    | |  _   ___  | |_    __ _ 
 |  __|   | '_ \   / __|  / _` | | '_ \   / _ \ |_  /  / _` |  / _` |  / _ \     / _` |  / _ \   | |  / _` |   | | | | / __| | __|  / _` |
 | |____  | | | | | (__  | (_| | | |_) | |  __/  / /  | (_| | | (_| | | (_) |   | (_| | |  __/   | | | (_| |   | | | | \__ \ | |_  | (_| |
 |______| |_| |_|  \___|  \__,_| |_.__/   \___| /___|  \__,_|  \__,_|  \___/     \__,_|  \___|   |_|  \__,_|   |_| |_| |___/  \__|  \__,_|
-->                                                                                                                                          
                                                                                                                                   

        <div class="an-component-header">     
          <div class="col-md-8">
           <h6>{{ 'Productos cotizados' }}</h6> 
          </div>    
          <div class="col-md-4">
            <div class="an-input-group">
              <div class="col-md-7">
                
              </div>
              <div class="col-md-5">  
                <select id="modenaGeneral" class="an-form-control">
                  @foreach($monedas as $moneda)
                    @if(!strcmp($moneda->ISOCurrCod, $cotizacion['Quotations'][0]->Moneda))
                      <option value="{{ $moneda->Rate }}" selected="selected">{{ $moneda->ISOCurrCod }}</option>
                    @else
                      <option value="{{ $moneda->Rate }}">{{ $moneda->ISOCurrCod }}</option>
                    @endif
                  @endforeach
                </select>
                
                   
                
              </div>
            </div>            
          </div>
        </div>

        

<!--
  _        _         _                   _                                       _                  _                 
 | |      (_)       | |                 | |                                     | |                | |                
 | |       _   ___  | |_    __ _      __| |   ___     _ __    _ __    ___     __| |  _   _    ___  | |_    ___    ___ 
 | |      | | / __| | __|  / _` |    / _` |  / _ \   | '_ \  | '__|  / _ \   / _` | | | | |  / __| | __|  / _ \  / __|
 | |____  | | \__ \ | |_  | (_| |   | (_| | |  __/   | |_) | | |    | (_) | | (_| | | |_| | | (__  | |_  | (_) | \__ \
 |______| |_| |___/  \__|  \__,_|    \__,_|  \___|   | .__/  |_|     \___/   \__,_|  \__,_|  \___|  \__|  \___/  |___/
                                                     | |                                                              
                                                     |_|                                                              
-->

        <div class="an-component-body">
          <div class="an-helper-block">

              <div class="row menu-product">
                  <div class="col-md-5">
                    <span>{{ '# Art&iacute;culo *' }}<br><br></span>
                  </div>
                  <div class="col-md-1 ">
                    <span>{{ 'P. Lista *' }}<br></span>
                  </div>
                  <div class="col-md-1 ">
                    <span>{{ 'Moneda *' }}<br></span>
                  </div>
                  
                  <div class="col-md-1 ">
                    <span>{{ 'P.Venta' }}<br></span>
                  </div>
                  <div class="col-md-1 ">
                    <span>{{ 'Cantidad *' }}<br></span>
                  </div>
                  <div class="col-md-1 ">
                    <span>{{ 'IVA' }}<br></span>
                  </div>
                  <div class="col-md-1 ">
                    <span>{{ 'Importe' }}<br></span>
                  </div>                                                                      
                </div>

            <div id="contenerdor-products">
              

@foreach($cotizacion['ArtQuotation'] as $articulo)



    <div id="item-product[{{ $loop->iteration }}]" class="item-product row" data-product="{{ $articulo->id }}">
      <div class="row">  
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-1">
              <span class="item-id">{{ $loop->iteration }}</span>
            </div>
            <div class="col-md-4">
              <div class="an-input-group">
                <input type="text" 
                  id="itemCodigo[{{ $loop->iteration }}]" 
                  name="itemCodigo[{{ $loop->iteration }}]" 
                  class="itemCodigo an-form-control disabledA" 
                  value="{{ $articulo->codigoArt }}"
                  data-toggle="tooltip" data-placement="top" title="{{ $articulo->codigoArt }}"
                  readonly
                  >
              </div>
            </div>
            <div class="col-md-7">
              <div class="an-input-group">
                <input type="text" 
                  id="itemName[{{ $loop->iteration }}]" 
                  name="itemName[{{ $loop->iteration }}]" 
                  class="itemName an-form-control disabledA" 
                  value="{{ $articulo->nombreArt }}"
                  data-toggle="tooltip" data-placement="top" title="{{ $articulo->nombreArt }}"
                  readonly
                  >
              </div>
            </div>
          </div>
        </div>
  
        <div class="col-md-7">
          <div class="row">
            <div class="col-md-2">
              <div class="an-input-group">
                <input 
                  type="text" 
                  id="itemPlista[{{ $loop->iteration }}]" 
                  name="itemPlista[{{ $loop->iteration }}]" 
                  class="itemPlista an-form-control dinero"
                  value="{{ $articulo->precioLista }}"
                  >
              </div>
            </div>
            <div class="col-md-1">
              <div class="an-input-group">
                <span 
                  id="itemMoneda[{{ $loop->iteration }}]" 
                  name="itemMoneda[{{ $loop->iteration }}]" 
                  class="itemMoneda ">
                  {{ $articulo->moneda }}
                </span>
              </div>
            </div>
            
            <div class="col-md-2 text-center">
              <div class="an-input-group">
                <span 
                  id="itemPVenta[{{ $loop->iteration }}]" 
                  name="itemPVenta[{{ $loop->iteration }}]" 
                  class="itemPVenta dinero">
                  {{ $articulo->PrecioVenta }}
                </span>
              </div>
            </div>
            <div class="col-md-2">
              <div class="an-input-group">
                <input 
                  type="number" 
                  id="itemCantidad[{{ $loop->iteration }}]" 
                  name="itemCantidad[{{ $loop->iteration }}]" 
                  class="itemCantidad an-form-control"
                  value="{{ $articulo->cantidad }}"
                  >
              </div>
            </div>
            <div class="col-md-2">
              <div class="an-input-group">
                <select id="itemFactor[{{ $loop->iteration }}]" name="itemFactor[{{ $loop->iteration }}]"  class="itemFactor an-form-control">
                  
                  @if (!strcmp($articulo->factor, '16'))
                    <option value="0" >0</option>
                    <option value="16" selected >16</option>
                  @else
                    <option value="0" selected >0</option>
                    <option value="16">16</option>
                  @endif  
                  
                  
                </select>
              </div>
            </div>
            <div class="col-md-2 text-right">
              <div class="an-input-group">
                <span 
                  id="itemImporteS[{{ $loop->iteration }}]"
                  name="itemImporteS[{{ $loop->iteration }}]" 
                  class="itemImporteS">
                  {{ $articulo->importe }}
                </span><i class="moneda">{{ $articulo->moneda }}</i>
              </div>
            </div>
            <div class="col-md-1 itemClose">
              <span>
                <i data-id="{{ $articulo->id }}" id="itemClose[{{ $loop->iteration }}]" class="ion-android-close"></i>
              </span>
            </div>
          </div>
        </div> 
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-1 text-right">
              <label>UMV: </label>
            </div>
            <div class="col-md-2">
              <div class="an-input-group">
                <input 
                  id="itemUMV[{{ $loop->iteration }}]" 
                  name="itemUMV[{{ $loop->iteration }}]" 
                  class="itemUMV an-form-control disabledA"
                  value="{{ $articulo->UMV }}"  
                >
              </div>                      
            </div>
            <div class="col-md-2 text-right">
              <label>Entrega: </label>
            </div>
            <div class="col-md-3">
              <div class="an-input-group">
                <input 
                  type="text" 
                  id="itemEntrega[{{ $loop->iteration }}]" 
                  name="itemEntrega[{{ $loop->iteration }}]" 
                  class="itemEntrega an-form-control"
                  value="{{ $articulo->tiempoEntrega }}"  
                >
              </div>                     
            </div>
            <div class="col-md-4">
              <div class="an-input-group">
                <label>Marca: </label>
                <span id="itemMarca[{{ $loop->iteration }}]" name="itemMarca[{{ $loop->iteration }}]" >
                    {{ $articulo->marca }}
                </span>
              </div>                     
            </div>  
          </div>
        </div> 
        <div class="col-md-7">
          <div class="row">
            <div class="col-md-2 text-right">
              <label>Descuentos a otorgar [%]: </label>                    
            </div>
            <div class="col-md-2">
              <div class="an-input-group">
                <input 
                  type="number" 
                  id="itemDesc[{{ $loop->iteration }}]" 
                  name="itemDesc[{{ $loop->iteration }}]" 
                  class="itemDesc an-form-control"
                  value="{{ $articulo->desc }}"
                  >
              </div>                    
            </div>
            
            <div class="col-md-3 text-right">
                <span>Total sin IVA: </span>
            </div>
            <div class="col-md-2">
                <span id="itemPrecioC[{{ $loop->iteration }}]">
                    {{ $articulo->precioUnidad }}
                </span>
              </div>
            <div class="col-md-3">
              <div class="an-input-group">
                <label>Utilidad: </label>
                <span 
                  id="itemUtilidad[{{ $loop->iteration }}]" 
                  name="itemUtilidad[{{ $loop->iteration }}]" class="itemUtilidad">
                    {{ $articulo->utilidad }}
                </span>
              </div>                     
            </div>
          </div>
        </div>
        
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-4 text-right">
              <label>Comentario (250 Max.): </label>
            </div>
            <div class="col-md-8">
              <div class="an-input-group">
                <input 
                  type="text" 
                  id="itemComentario[{{ $loop->iteration }}]" 
                  name="itemComentario[{{ $loop->iteration }}]" 
                  class="itemComentario an-form-control"
                  value="{{ $articulo->observaciones }}"  
                >
              </div>                     
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="row">
            <div class="col-md-1 d-none">
              <span>Descuento otorgado: </span>
              <span id="itemDescOto[{{ $loop->iteration }}]"></span>
            </div>
            <div class="col-md-5">
                <div class="an-input-group">
                    <label>CostoPr: </label>
                  <span 
                    id="itemCosto[{{ $loop->iteration }}]" 
                    name="itemCosto[{{ $loop->iteration }}]" 
                    class="itemCosto"
                    >{{ $articulo->costo }}</span>
                </div>                     
              </div>
            <div class="col-md-4"></div>
            <div class="col-md-3">
                <span>Importe Total: </span>
              <span id="itemImporteT[{{ $loop->iteration }}]" class="itemImporteT">
                <b>
                    {{ $articulo->subTotalLinea }}
                </b>
              </span>
              <i class="moneda">
                  {{ $articulo->moneda }}
              </i>
            </div>
          </div>
        </div>
      </div>
        <!--
        
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
                <thead>
                    <th>                          
                        <td colspan="10" class="qSubSec" style="color:#3e631a">
                          Existencia por almacén (Total <span id="itemExistenciasAl[]">0</span>)
                        </td>                        
                    </th>   
                </thead>                     
                <tbody>                        
                                         
                  <tr style="color:#3e631a" id="itemNameExitT[]">                                     
                  </tr>                        
                  <tr style="color:#3e631a" id="itemValueExitT[]">
                  </tr>                      
                </tbody>                    
              </table>
            </div> 
            <div class="col-md-6">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">                      
                <thead>
                    <th>                          
                      <td colspan="10" class="qSubSec" style="color:#a50000">
                          Pendiente por recibir en almacén
                      </td>                        
                    </th> 
                </thead>
                <tbody>                        
                                         
                  <tr style="color:#a50000">             
                    <td>QUE</td>
                    <td>DF</td>
                    <td>LEO</td>
                    <td>DFC</td>
                    <td>SAN</td>
                    <td>GUA</td>
                    <td>MON</td>
                    <td>CED</td>
                    <td>CAN</td>
                    <td>AGU</td>                        
                  </tr>                        
                  <tr style="color:#a50000">              
                    <td>
                      <div class="oO1001 oTot">
                        <span>0</span>
                      </div>
                    </td>
                    <td>
                      <div class="oO1002 oTot">
                        <span>0</span>
                      </div>
                    </td>
                    <td>
                      <div class="oO1003 oTot">
                        <span>0</span>
                      </div>
                    </td>
                    <td>
                      <div class="oO1005 oTot">
                        <span>0</span>
                      </div>
                    </td>
                    <td>
                      <div class="oO1006 oTot">
                        <span>0</span>
                      </div>
                    </td>
                    <td>
                      <div class="oO1007 oTot">
                        <span>0</span>
                      </div>
                    </td>
                    <td>
                      <div class="oO1008 oTot">
                        <span>0</span>
                      </div>
                    </td>
                    <td>
                      <div class="oO1009 oTot">
                        <span>0</span>
                      </div>
                    </td>
                    <td>
                      <div class="oO1011 oTot">
                        <span>0</span>
                      </div>
                    </td>
                    <td>
                      <div class="oO1012 oTot">
                        <span>0</span>
                      </div>
                    </td>                        
                  </tr>                      
                </tbody>                    
              </table>
            </div>
          </div>               
        </div>
  
        -->
      </div>

            
       

@endforeach

            </div>

            <div class="row">
                
              <div class="col-md-12 text-right">
                <button id="createProduct" class="an-btn an-btn-success block-icon"> <i class="ion-plus-round"></i>Agregar artículo</button>
              </div>

            </div>

          </div>
        </div>
     </div>
</div> 


<div class="row">

  <div class="col-md-6">
    <div class="an-single-component with-shadow ">
      
      <div class="an-component-header">   
        <h6>Notas comerciales</h6> 
      </div>

      <div class="an-component-body">
        <div class="an-helper-block">
        
            {!! $cotizacion['Notes']->condiciones !!}
          
        </div>
      </div>

    </div>
    
  </div>

  <div class="col-md-6">
      <div class="an-single-component with-shadow ">
        
        <div class="an-component-header">   
          <h6>Especificaciones</h6> 
        </div>
  
        <div class="an-component-body">
          <div class="an-helper-block">
          
              {!! $cotizacion['Notes']->condiciones !!}
            
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

  <!-- Inicio producto -->
  <div id="product-base">
    <div id="item-product[Element]" class="item-product row" data-type="new"  data-product="0">
    <div class="row">  
      <div class="col-md-5">
        <div class="row">
          <div class="col-md-1">
            <span class="item-id">{{ 'Element' }}</span>
          </div>
          <div class="col-md-4">
            <div class="an-input-group">
              <select id="itemCodigo[Element]" name="itemCodigo[Element]" class="itemCodigo an-form-control"></select>
            </div>
          </div>
          <div class="col-md-7">
            <div class="an-input-group">
              <input type="text" id="itemName[Element]" name="itemName[Element]" class="itemName an-form-control">
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-7">
        <div class="row">
          <div class="col-md-2">
            <div class="an-input-group">
              <input type="text" id="itemPlista[Element]" name="itemPlista[Element]" class="itemPlista an-form-control dinero">
            </div>
          </div>
          <div class="col-md-1">
            <div class="an-input-group">
              <span id="itemMoneda[Element]" name="itemMoneda[Element]" class="itemMoneda ">{{ $monedas[0]->ISOCurrCod }}</span>
            </div>
          </div>
          
          <div class="col-md-2 text-center">
            <div class="an-input-group">
              <span id="itemPVenta[Element]" name="itemPVenta[Element]" class="itemPVenta dinero"></span>
            </div>
          </div>
          <div class="col-md-2">
            <div class="an-input-group">
              <input type="number" id="itemCantidad[Element]" name="itemCantidad[Element]" class="itemCantidad an-form-control">
            </div>
          </div>
          <div class="col-md-2">
            <div class="an-input-group">
              <select id="itemFactor[Element]" name="itemFactor[Element]"  class="itemFactor an-form-control">
                <option>0</option>
                <option>16</option>
              </select>
            </div>
          </div>
          <div class="col-md-2 text-right">
            <div class="an-input-group">
              <span id="itemImporteS[Element]" name="itemImporteS[Element]" class="itemImporteS"></span><i class="moneda"></i>
            </div>
          </div>
          <div class="col-md-1 itemClose">
            <span>
              <i id="itemClose[Element]" class="ion-android-close"></i>
            </span>
          </div>
        </div>
      </div> 
    </div>
    <div class="row">
      <div class="col-md-5">
        <div class="row">
          <div class="col-md-1 text-right">
            <label>UMV: </label>
          </div>
          <div class="col-md-2">
            <div class="an-input-group">
              <select id="itemUMV[Element]" name="itemUMV[Element]" class="itemUMV an-form-control">
              </select>
            </div>                      
          </div>
          <div class="col-md-2 text-right">
            <label>Entrega: </label>
          </div>
          <div class="col-md-3">
            <div class="an-input-group">
              <input type="text" id="itemEntrega[Element]" name="itemEntrega[Element]" class="itemEntrega an-form-control">
            </div>                     
          </div>
          <div class="col-md-4">
            <div class="an-input-group">
              <label>Marca: </label>
              <span id="itemMarca[Element]" name="itemMarca[Element]" ></span>
            </div>                     
          </div>  
        </div>
      </div> 
      <div class="col-md-7">
        <div class="row">
          <div class="col-md-2 text-right">
            <label>Descuentos a otorgar [%]: </label>                    
          </div>
          <div class="col-md-2">
            <div class="an-input-group">
              <input type="number" id="itemDesc[Element]" name="itemDesc[Element]" class="itemDesc an-form-control">
            </div>                    
          </div>
          
          <div class="col-md-3 text-right">
              <span>Total sin IVA: </span>
          </div>
          <div class="col-md-2">
              <span id="itemPrecioC[Element]">

              </span>
            </div>
          <div class="col-md-3">
            <div class="an-input-group">
              <label>Utilidad: </label>
              <span id="itemUtilidad[Element]" name="itemUtilidad[Element]" class="itemUtilidad"></span>
            </div>                     
          </div>
        </div>
      </div>
      
    </div>
    <div class="row">
      <div class="col-md-5">
        <div class="row">
          <div class="col-md-4 text-right">
            <label>Comentario (250 Max.): </label>
          </div>
          <div class="col-md-8">
            <div class="an-input-group">
              <input type="text" id="itemComentario[Element]" name="itemComentario[Element]" class="itemComentario an-form-control">
            </div>                     
          </div>
        </div>
      </div>
      <div class="col-md-7">
        <div class="row">
          <div class="col-md-1 d-none">
            <span>Descuento otorgado: </span>
            <span id="itemDescOto[Element]"></span>
          </div>
          <div class="col-md-5">
              <div class="an-input-group">
                  <label>CostoPr: </label>
                <span id="itemCosto[Element]" name="itemCosto[Element]" class="itemCosto"></span>
              </div>                     
            </div>
          <div class="col-md-4"></div>
          <div class="col-md-3">
              <span>Importe Total: </span>
            <span id="itemImporteT[Element]" class="itemImporteT"><b></b></span><i class="moneda"></i>
          </div>
        </div>
      </div>
    </div>
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
              <thead>
                  <th>                          
                      <td colspan="10" class="qSubSec" style="color:#3e631a">
                        Existencia por almacén (Total <span id="itemExistenciasAl[Element]">0</span>)
                      </td>                        
                  </th>   
              </thead>                     
              <tbody>                        
                                       
                <tr style="color:#3e631a" id="itemNameExitT[Element]">                                     
                </tr>                        
                <tr style="color:#3e631a" id="itemValueExitT[Element]">
                </tr>                      
              </tbody>                    
            </table>
          </div> 
          <div class="col-md-6">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">                      
              <thead>
                  <th>                          
                    <td colspan="10" class="qSubSec" style="color:#a50000">
                        Pendiente por recibir en almacén
                    </td>                        
                  </th> 
              </thead>
              <tbody>                        
                                       
                <tr style="color:#a50000">             
                  <td>QUE</td>
                  <td>DF</td>
                  <td>LEO</td>
                  <td>DFC</td>
                  <td>SAN</td>
                  <td>GUA</td>
                  <td>MON</td>
                  <td>CED</td>
                  <td>CAN</td>
                  <td>AGU</td>                        
                </tr>                        
                <tr style="color:#a50000">              
                  <td>
                    <div class="oO1001 oTot">
                      <span>0</span>
                    </div>
                  </td>
                  <td>
                    <div class="oO1002 oTot">
                      <span>0</span>
                    </div>
                  </td>
                  <td>
                    <div class="oO1003 oTot">
                      <span>0</span>
                    </div>
                  </td>
                  <td>
                    <div class="oO1005 oTot">
                      <span>0</span>
                    </div>
                  </td>
                  <td>
                    <div class="oO1006 oTot">
                      <span>0</span>
                    </div>
                  </td>
                  <td>
                    <div class="oO1007 oTot">
                      <span>0</span>
                    </div>
                  </td>
                  <td>
                    <div class="oO1008 oTot">
                      <span>0</span>
                    </div>
                  </td>
                  <td>
                    <div class="oO1009 oTot">
                      <span>0</span>
                    </div>
                  </td>
                  <td>
                    <div class="oO1011 oTot">
                      <span>0</span>
                    </div>
                  </td>
                  <td>
                    <div class="oO1012 oTot">
                      <span>0</span>
                    </div>
                  </td>                        
                </tr>                      
              </tbody>                    
            </table>
          </div>
        </div>               
      </div>

    </div>
</div>
<!-- Fin producto -->   

      <div id="payBase">
          <div id="item-pay[Element]" class="row item-pay">
            <div class="col-md-2">
               <div class="an-input-group">
                <select id='formPay[Element]' class="an-form-control formPay">
                  <option value="01">Efectivo</option>
                  <option value="02">Cheque</option>
                  <option value="03">Transferencia electrónica</option>
                  <option value="04">Tarjeta de crédito</option>
                </select>
              </div>
            </div>
            <div class="col-md-1">
              <div class="an-input-group">
                <input id="formMonto[Element]" type="text" name="" class="an-form-control">
              </div>
            </div>
            <div class="col-md-1">
              <div class="an-input-group">
                <select id="formCurrency[Element]" class="an-form-control formCurrency">
                  <option value="MXN">MXN</option>
                  <option value="USD">USD</option>
                </select>  
              </div>
            </div>
            <div class="col-md-2">
              <div class="an-input-group">
                <input id="formRef[Element]" type="text" name="" class="an-form-control" value="Efectivo" readonly>  
              </div>
            </div>
            <div class="col-md-2">
              <div class="an-input-group">
                <input id="formDate[Element]" type="date" name="" class="an-form-control">
              </div>
            </div>
            <div class="col-md-2">
              <div class="an-input-group">
                <input id="formFile[Element]" type="file" name="" class="an-form-control disabled">
              </div>
            </div>
            <div class="col-md-2">
              <div class="an-input-group">
                <select id='statusPay[Element]' class="an-form-control statusPay">
                  <option value="01">Pagado</option>
                  <option value="02">En proceso</option>
                  <option value="03">No pago</option>
                </select>  
              </div>
            </div>
          </div>
      </div>
</div>

<!--<div class="floatButtons">
    <button id="updateFloat" class="an-btn btn-success block-icon"><i class="ion-check"></i> Actualizar</button>
</div>-->

@section('scripts')

<script type="text/javascript">

@if(Session::has('access_token'))

  var token =  "{!! Session::get('access_token')['access_token'] !!}" ; 

@endif


@if (count($cotizacion['ArtQuotation']) > 0)
  var productos = {{ count($cotizacion['ArtQuotation']) + 1 }}
@else
  var productos = 1;
@endif

@if (count($getPayment) > 0)
  var pago = {{ count($getPayment) + 1 }}
@else
  var pago = 1;
@endif






toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}



$(document).ready(function(){

  var totalint = 0;

  $("#container-pay").find("[id^='formMonto']").each(function(key, obj){
    totalint += Number($(obj).val());
  });

  $("#totalpagos").text(totalint);
  
  $("#restante").text(Number(Number($("#totalCoti").text()) - totalint).toFixed(2));

$("#contenerdor-products").find(".item-id").each(function(key, item){

  var producIni = key + 1;

  $('#itemCantidad\\[' + producIni +'\\], \
      #itemPlista\\[' + producIni +'\\], \
       #itemDesc\\[' + producIni +'\\], \
        #itemFactor\\[' + producIni +'\\], \
         #modenaGeneral' ).change(function() {
          
          $('#item-product\\[' + producIni +'\\]').attr("data-type", "update");

          calculoCotizacion(producIni);
          calculoTotalCotizacion();
  });

});


  $('[data-toggle="tooltip"]').tooltip();

  $("#estatus").select2();

  $("#contenerdor-products").find(".itemFactor").select2();

  $("#addPay").click(function(){

    $("#container-pay").append($("#payBase").html().replace(/Element/g, pago));
    
    recargar(pago);

    pago ++;
    
  });

  function recargar(pago){

    $("#formPay\\[" + pago + "\\]").select2();
    
    $("#statusPay\\[" + pago + "\\]").select2();
    
    $("#formCurrency\\[" + pago + "\\]").select2();
  
    $("#validarPay").removeClass('disabled');

    $("#container-pay").find("[id^='formPay']").on('select2:select', function (e) {
     
        var data = e.params.data;
        
        var id = $(this).attr("id")
               .split("formPay")[1]
               .split("[")[1]
               .split("]")[0]

        if(data.id != '01'){
          $("#formRef\\[" + id + "\\]").attr('readonly', false);
        } else {
          $("#formRef\\[" + id + "\\]").attr('readonly', true);
          $("#formRef\\[" + id + "\\]").val('Efectivo');
        }
  
    });

  }

  $("#validarPay").click(function(){
    if(!$(this).hasClass('disabled')){

      var total = 0;

      $("#container-pay").find("[id^='formMonto']").each(function(key, obj){
        total += Number($(obj).val());
      });

        $.ajax({
          url: "{{ URL::route('setPayment') }}",
          type: 'post',
          data: {
            datosPay: obtenerDatosPagos(),
            numCotizacion: '{{ $id }}'
          },
          success: function(){
            
            if(Number($("#totalCoti").text()) <= total){
              toastr.success('Puedes crear la Cotización en SAP', 'Pago completado');
              $("#makeSAP").removeClass('disabled');
            } else {
              
               toastr.error("Necesita realizar más pagos para poder completar el monto", "Monto incompleto * ");  
            }

            $("#totalpagos").text(total);
            $("#restante").text(Number(Number($("#totalCoti").text()) - total).toFixed(2));


          }, error: function(){
              toastr.error("Erro al guardar los datos", "Monto incompleto * ");  
          }

        });
      
    } 

  });


    function obtenerDatosPagos(){
      
      var arrPagos = new Array();

      $("[id^='item-pay']").each(function(index, element){

        if(!$(this).hasClass('save')){
          arrPagos.push({ 
            metodo : $(this).find("[id^='formPay']").val(),
            monto : $(this).find("[id^='formMonto']").val(), 
            moneda : $(this).find("[id^='formCurrency']").val(), 
            referencia : $(this).find("[id^='formRef']").val(), 
            comprobante : $(this).find("[id^='formFile']").val(), 
            date: $(this).find("[id^='formDate']").val(),
            status : $(this).find("[id^='statusPay']").val()    
          });

          $(this).addClass('save');

        }
      });
    
      arrPagos.pop();

      return arrPagos;
  }

  $( "#quotationCron" ).datepicker();


  /*
   * Agregar y actualizar productos
   *
   */


  $("#update").click(function(){

    /*$.ajax({
      type: "POST",
      url: "",
      data:{
        estatus: $("#estatus").val(),
        quotationCron: $("#quotationCron").val(),
        coments: $("#coments").val()
      },
      success: function(){

      }});
      */

      $("#loading").show();      

      $.ajax({
        type: 'post',
        url: '{{ URL::route("updateCotizacion") }}',
        data: { 
          id: {{ $cotizacion['Quotations'][0]->id }},
          numCotizacion: "{{ $cotizacion['Quotations'][0]->numCotizacion }}",
          obtenerDatosArticulos : obtenerDatosArticulos(),
          obtenerDatosCotizacion : obtenerDatosCotizacion()
        },
        success: function(result){
          console.log(result);
          $("#loading").hide();
        },
        error: function(){
          console.log("Error");
        }
      });


  });


  $("#createProduct").click(function(){

    $("#contenerdor-products").append($("#product-base").html().replace(/Element/g, productos));
    $("#makeSAP").addClass('disabled');

    eventosProduct(productos);

    productos ++;

  });



function eventosProduct(products){

var producIni = products;

/**** Eliminar Producto ****/

  $(".itemClose i").click(function(){
    $("#item-product\\[" + $(this).attr("id")
                              .split("itemClose")[1]
                              .split("[")[1]
                              .split("]")[0] + "\\]")
                              .remove();
    //calculoTotalCotizacion();
  });

/**** Buscar Productos ****/

  $('#itemCodigo\\[' + producIni +'\\]').select2({
      width: "100%",
      ajax: {
        url:  "{{ URL::route('getArticuloAll') }}",
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
      placeholder: 'Artículo #' + producIni,
      minimumInputLength: 3,
      language: 'es'
  });

  /**** Buscar detalles del producto ****/

  $('#itemCodigo\\[' + producIni + '\\]').on('select2:select', function (e) {
   
    var data = e.params.data;

    $.ajax({
      method: 'GET',
      url: "{{ URL::route('getArticuloData') }}",
      data: { q: data.id },
      success: function (result) {
        
        var productItem = producIni;

        $('#itemName\\[' + producIni + '\\]' ).val(result[0].ItemName);
        $('#itemPlista\\[' + producIni + '\\]' ).val(result[0].Price);

        //var Currency = new Option(result[0].Currency, result[0].Currency, false, false);
        //$('#itemMoneda\\[' + producIni + '\\]' ).append(Currency).trigger('change');

        $('#itemPVenta\\[' + productItem + '\\]' ).html(result[0].Price);
        $('#itemImporteS\\[' + productItem + '\\]' ).text('');

        var UMV = new Option(result[0].SalUnitMsr, result[0].SalUnitMsr, false, false);
        $('#itemUMV\\[' + productItem + '\\]').append(UMV).trigger('change');

        $('#itemCosto\\[' + productItem + '\\]' ).text(result[0].LastPurPrc + ' ' + result[0].LastPurCur );
        $('#itemMarca\\[' + productItem + '\\]' ).html(result[0].FirmName);

        //calculoCotizacion(productItem);
        //calculoTotalCotizacion();

      },
      error: function(result) {
        console.log(result);
      }
    });
    
    $.ajax({
      method: 'GET',
      url: "{{ URL::route('getStock') }}",
      data: { q: data.id },
      success: function(result){
        
        var Names = '';
        var values = '';
        var totalValues = 0;

        $.each(result, function(index, value){
          Names +=  "<td>" + value.WhsName.substring(0,3) + "</td>";
          values += "<td>" + Number(value.OnHand).toFixed(0) + "</td>"; 
          totalValues += Number(Number(value.OnHand).toFixed(0));
        });

        $('#itemExistenciasAl\\[' + producIni + '\\]' ).text(totalValues);
        $('#itemNameExitT\\[' + producIni + '\\]' ).html(Names);
        $('#itemValueExitT\\[' + producIni + '\\]' ).html(values);
      }, 
      error: function(){

      }
    });

  });

  /**** Calcular precio All ****/

  $('#itemCantidad\\[' + producIni +'\\], \
      #itemPlista\\[' + producIni +'\\], \
       #itemDesc\\[' + producIni +'\\], \
        #itemFactor\\[' + producIni +'\\], \
         #modenaGeneral' ).change(function() {
      
          calculoCotizacion(producIni);
          calculoTotalCotizacion();
  });


  /**** Iniciar factor ****/

  $('#itemFactor\\[' + producIni +'\\]').select2();


  /**** Iniciar UMV ****/

  $('#itemUMV\\[' + producIni +'\\]').select2();

}




  function calculoCotizacion(prod){

    var productItem = prod ;
    var moneda = $("#modenaGeneral").val();
    var monedaLabel = $("#modenaGeneral option:selected").text();

    $('#itemMoneda\\[' + productItem +'\\]').text(monedaLabel);

    console.log(productItem);

    var cantidad = $('#itemCantidad\\[' + productItem +'\\]').val();
    var precioLista = $('#itemPlista\\[' + productItem +'\\]').val();
    var itemPVenta = $('#itemPVenta\\[' + productItem +'\\]').text();
    var factor = $('#itemFactor\\[' + productItem +'\\]').val();
    var costo = $('#itemCosto\\[' + productItem +'\\]').text();
    var descuento = $('#itemDesc\\[' + productItem +'\\]').val();      

    console.log("Intem [ " + productItem + " ) : " + cantidad) ;
    console.log("Intem [ " + productItem + " ) : " + precioLista) ;
    console.log("Intem [ " + productItem + " ) : " + itemPVenta) ;
    console.log("Intem [ " + productItem + " ) : " + factor) ;
    console.log("Intem [ " + productItem + " ) : " + costo) ;
    console.log("Intem [ " + productItem + " ) : " + descuento) ;

    $('#itemDescOto\\[' + productItem +'\\]').text( descuento + '%');

    itemPVenta = Number(parseFloat(Number(precioLista) - Number( descuento * precioLista / 100)));

    $('#itemPrecioC\\[' + productItem +'\\]').text(Number(itemPVenta * cantidad ).toFixed(2));


    $('#itemUtilidad\\[' + productItem +'\\]').text( 
            Number( ( itemPVenta * 100 / costo.substr(0,costo.length-4) - 100).toFixed(2)) + '%' );

    $('#itemPVenta\\[' + productItem +'\\]').text(itemPVenta);


    var precioCantidad = (itemPVenta * cantidad) + (((itemPVenta * cantidad) * factor) / 100);


    $('#itemImporteS\\[' + productItem +'\\]').text(Number(precioCantidad).toFixed(2));

    $('#itemImporteT\\[' + productItem +'\\] b').text( Number(precioCantidad).toFixed(2));

}

function calculoTotalCotizacion(){
        
        var antesSubTotalCoti = 0;

        $("#contenerdor-products").find(".item-product .itemImporteT b").each(function(){
           antesSubTotalCoti += Number($(this).text());
        }).promise().done(function(){

          $("#totalCoti").text(Number(antesSubTotalCoti).toFixed(2));

        });

        $(".moneda").text($("#modenaGeneral option:selected").text());
}


function obtenerDatosArticulos(){
      var arrArticulos = new Array();

      $("[id^='item-product']").each(function(index, element){
           if($(this).attr("data-type") == "new" || $(this).attr("data-type") == "update"){

              arrArticulos.push({ 
                id: $(this).attr("data-product"),
                dataType: $(this).attr("data-type"),
                codigoArt : $(this).find("[name^='itemCodigo']").val(), // Codigo Articulo
                nombreArt : $(this).find("[name^='itemName']").val(), // Nombre del articulo
                cantidad : $(this).find("[name^='itemCantidad']").val(), // Cantidad
                moneda : $(this).find("[id^='itemMoneda']").text(), // Moneda
                precioLista : $(this).find("[name^='itemPlista']").val(), // P.Lista
                UMV : $(this).find("[name^='itemUMV']").val(), // UMV
                precioUnidad : $(this).find("[id^='itemPrecioC']").text(), // Precio Unitario con descuento

                PrecioVenta : $(this).find("[id^='itemPVenta']").text(),
                importe : $(this).find("[id^='itemImporteS']").text(),
                marca : $(this).find("[id^='itemMarca']").text(),
                costo : $(this).find("[id^='itemCosto']").text(),
                desc : $(this).find("[id^='itemDesc']").val(),
                utilidad : $(this).find("[id^='itemUtilidad']").text(),

                factor : $(this).find("[name^='itemFactor']").val(), // Factor  
                subTotalLinea : $(this).find("[id^='itemImporteT'] b").text(),
                almacen : '0',
                tiempoEntrega : $(this).find("[name^='itemEntrega']").val(), 
                observaciones : $(this).find("[name^='itemComentario']").val()     
              });
            }
      });

      arrArticulos.pop();

      return arrArticulos;   
}

function obtenerDatosArticulosSAP(){
      var arrArticulos = new Array();

      $("[id^='item-product']").each(function(index, element){

              arrArticulos.push({ 
                id: $(this).attr("data-product"),
                dataType: $(this).attr("data-type"),
                codigoArt : $(this).find("[name^='itemCodigo']").val(), // Codigo Articulo
                nombreArt : $(this).find("[name^='itemName']").val(), // Nombre del articulo
                cantidad : Number($(this).find("[name^='itemCantidad']").val()), // Cantidad
                moneda : $(this).find("[id^='itemMoneda']").text(), // Moneda
                precioLista : Number($(this).find("[name^='itemPlista']").val()), // P.Lista
                UMV : $(this).find("[name^='itemUMV']").val(), // UMV
                precioUnidad : Number($(this).find("[id^='itemPrecioC']").text()), // Precio Unitario con descuento

                PrecioVenta : Number($(this).find("[id^='itemPVenta']").text()),
                importe : Number($(this).find("[id^='itemImporteS']").text()),
                marca : $(this).find("[id^='itemMarca']").text(),
                costo : $(this).find("[id^='itemCosto']").text(),
                desc : $(this).find("[id^='itemDesc']").val(),
                utilidad : $(this).find("[id^='itemUtilidad']").text(),

                factor : $(this).find("[name^='itemFactor']").val(), // Factor  
                subTotalLinea : Number($(this).find("[id^='itemImporteT'] b").text()),
                almacen : '0',
                tiempoEntrega : $(this).find("[name^='itemEntrega']").val(), 
                observaciones : $(this).find("[name^='itemComentario']").val()     
              });
            
      });

      arrArticulos.pop();

      return arrArticulos;   
}

function obtenerDatosCotizacion(){
 
  datos = {
    moneda: $("#modenaGeneral option:selected").text(),
    total: Number($("#totalCoti").text())
  };

  return datos;

}


/**** Eliminar Producto Inicio ****/

  $(".itemClose i").click(function(){

    if(confirm(" ¿Estás seguro que deseas eliminar este producto de la cotización?")){
      var idContent = $(this).attr("id")
                              .split("itemClose")[1]
                              .split("[")[1]
                              .split("]")[0];
    
      $("#loading").show();

      $.ajax({
        method: 'post',
        url: "{{ URL::route('deleteProduct') }}",
        data: {
          id: $(this).attr("data-id")
        }, 
        success: function(response){
          $("#item-product\\[" + idContent + "\\]")
                              .remove();
        
          $("#totalCoti").text(response.data);

          $("#loading").hide();

      }

    });



    } 
      //calculoTotalCotizacion();
  });


  /**** Inicia Moneda General ****/

  $('#modenaGeneral').select2({
    placeholder: 'Selecciona ...'
  });


  /*** Guardar cotizacion en SAP ***/


validarSAP();



function validarSAP(){

  var products = [];

  $("#contenerdor-products").find(".itemCodigo").each(function(){
    products.push($(this).val());
  });

  data = {
    q: $("#clienteCodigo").val(),
    r: products
  };

  $.ajax({
    method: "post",
    url: "{{ URL::route('validateQuotation') }}",
    data: data,
    success: function(data){

      var next = 0;

      $.each(data.data[1].Products,function(key,value){
        if(value[0].status == '0')
          $($("#contenerdor-products").find(".itemCodigo")[key]).css({backgroundColor:'#5cb85c', color:'white'})
        else
          $($("#contenerdor-products").find(".itemCodigo")[key]).css({backgroundColor:'#F44336', color:'white'})
        next += Number(value[0].status);
      });

      if(data.data[0].CardCode[0].status == '0')
        $("#clienteCodigo").css({backgroundColor:'#5cb85c', color:'white'});
      else
        $("#clienteCodigo").css({backgroundColor:'#F44336', color:'white'});

      next += Number(data.data[0].CardCode[0].status);

      if(next == 0){
        $("#makeSAP").removeClass("disabled").css({backgroundColor: '#4CAF50'});
      }

    }, 
    error: function(){
      console.log('Error :(');
    }

  });


}

console.log(obtenerDatosCotizacion());

console.log(obtenerDatosArticulosSAP());

// **** Crear en SAP


$("#makeSAP").click(function(){
  if(!$(this).hasClass('disabled')){
    $.ajax({
      method: "post",      
      url: "http://{!! Session::get('HOST_SAP_API') !!}/api/sap/cotizacion",
      headers: {"Authorization": "Bearer " + token},
      data: {
              "CardCode" : "0127",
              "NumAtCard": "1000002",
              "products": [{
                  "ItemCode": "OMS24",
                  "Quantity": 50,
                  "UnitPrice": 1
              },{
                  "ItemCode": "OMS24",
                  "Quantity": 90,
                  "UnitPrice": 1
              }]
      },
      success: function(data){
        console.log(data);
      },
      error: function(){
        console.log("Error :(");
      }

    });
  }
  
});
  


});



</script>


@endsection
