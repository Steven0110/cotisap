      <div class="col-md-6">       
        <div class="an-single-component with-shadow">
          <div class="an-component-header">
            <h6>{{ 'Datos generales del artículo' }}</h6>
          </div>
          <div class="an-component-body">
            <div class="an-helper-block">
              
              <label for="codArt">{{ 'Código del artículo' }}: </label>
              <div class="an-input-group">  
                <div class="an-input-group-addon"><i class="ion-pound"></i></div>
                <input type="text" id="codArt" class="an-form-control not-null" name="codArt" placeholder="{{ 'Introduzca el código' }}">
              </div>

              <label for="descArt">{{ 'Descripción' }}: </label>
              <div class="an-input-group">
                <div class="an-input-group-addon"><i class="ion-information-circled"></i></div>
                <input type="text" id="descArt" class="an-form-control not-null" name="descArt" placeholder="{{'Escriba una breve descripción del artículo'}}">
              </div>
              <label for="descArt">{{ 'Comentario' }}: </label>
              <div class="an-input-group">
                <div class="an-input-group-addon"><i class="ion-android-textsms"></i></div>
                <textarea class="an-form-control" id="comm" placeholder="Escribe un comentario..."></textarea>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">       
             <div class="an-single-component with-shadow">
                <div class="an-component-header panel-heading">
                  <h6>{{ 'Datos particulares del artículo' }}</h6>
                </div>
                <div class="an-component-body">
                  <div class="an-helper-block">
                    
                    <label for="unidadMedida">{{ 'Unidad de medida' }}: </label>
                    <div class="an-input-group">
                      
                        
                        
                      
                      <div class="an-default-select-wrapper">
                        <select id="unidadMedida" name="sort">
                          <option value="0">{{ 'Seleccione una unidad de medida' }}</option>
                          @foreach($udm as $udmItem)
                            <option value="{{ $udmItem->UomCode }}">{{ $udmItem->UomName }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="precioVenta">{{ 'Precio de venta' }}: </label>
                        <div class="an-input-group">
                          <div class="an-input-group-addon"><i class="ion-social-usd"></i></div>
                          <input type="number" id="precioVenta" class="an-form-control not-null" name="precioVenta" />
                        </div>
                        
                      </div>
                      <div class="col-md-6">
                        <label for="moneda">{{ 'Moneda' }}: </label>
                        <div class="an-input-group">
                          <div class="an-default-select-wrapper">
                            <select id="moneda" name="sort">
                              <option value="0">{{ 'Seleccione una divisa' }}</option>
                              <option value="1">{{'MXN'}}</option>
                              <option value="2">{{'USD'}}</option>
                              <option value="3">{{'EUR'}}</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>

                  <div class="an-helper-block text-right">
                      <button type="button" class="an-btn an-btn-danger">{{ 'Cancelar' }}</button>
                      <button type="button" id="save" class="an-btn an-btn-success">{{ 'Registrar' }}<img src="{{ asset('assets/img/loading.gif') }}" height="20" width="20" hidden="hidden" /></button>
                    </div>
                  </div>

                  </div>
                </div>
              </div>
             <div class="an-single-component with-shadow">

              <div class="an-component-body">
                  
             </div>
      </div>
