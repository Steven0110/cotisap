<!-- 
  [
    'Developer' => 'Gerardo Aramis Cabello Acosta',
    'GitHub'    => 'https://github.com/Steven0110/'
  ]
-->
              <div class="an-single-component with-shadow">

                <div class="an-helper-block">
                  <div class="an-component-header">
                    <h6>Búsqueda rápida de productos</h6>
                    <div class="component-header-right">
                      <img style="display: none;" src="{{asset('assets/img/loading.gif')}}" height="30" width="30" id="quick-loader"/>
                    </div>
                  </div>

                  <div class="an-component-body">
                    <div class="row">
                      <div class="col-md-4"><select id="artCode" class="an-form-control"></select></div>
                      <div class="col-md-8"><input id="artName" type="text" class="an-form-control" placeholder="Nombre" /></div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <span>P. Lista:</span>
                        <h4>$<span id="precioLista">0.00</span></h4>
                      </div>
                      <div class="col-md-3">
                        <span>Descuento:</span>
                        <select class="an-form-control info" id="descuento" value="0">
                          <option value="0" selected="selected">0%</option>
                          <option value="17">17%</option>
                          <option value="18.5">18.5%</option>
                          <option value="20">20%</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <h2 class="text-right">$<span id="precio">0.00</span><span style="font-size: 15px;">MXN</span></h2>
                      </div>
                    </div>
                    <div class="row" style="padding-left: 15px;">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">                      
                        <tbody>                        
                          <tr>                          
                            <td colspan="10" class="qSubSec" style="color:#3e631a">
                              Existencia por almacén (Total <span id="total">0</span>)
                            </td>                        
                          </tr>                        
                          <tr style="color:#3e631a" id="names">                                     
                          </tr>                        
                          <tr style="color:#3e631a" id="values">
                          </tr>                      
                        </tbody>                    
                      </table>
                    </div>
                    <div class="row" style="padding-left: 15px;">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>                        
                          <tr>                          
                            <td colspan="10" class="qSubSec" style="color:#a50000">
                              Pendiente por recibir en almacén
                            </td>                        
                          </tr>
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