      
           <div class="an-single-component with-shadow">
              <div class="an-component-header">
                <h6>{{ 'Datos del cliente' }}</h6>
              </div>
              <div class="an-component-body">
                  
                  <div class="an-helper-block">
                    <div class="col-md-12">
                      <form id="alta-cliente-form">
                        <div class="col-md-6">
                          <label for="pContacto">{{ 'Persona de contacto' }}: </label>
                          <div class="an-input-group">  
                            <div class="an-input-group-addon"><i class="ion-android-person"></i></div>
                            <input type="text" id="pContacto" class="an-form-control not-null" name="pContacto" placeholder="{{ 'Introduzca el nombre de la persona de contacto' }}" />
                          </div>
                          <label for="telCliente">{{ 'Teléfono' }}: </label>
                          <div class="an-input-group">  
                            <div class="an-input-group-addon"><i class="ion-ios-telephone"></i></div>
                            <input type="tel" id="telCliente" class="an-form-control not-null" name="telCliente" placeholder="{{ 'Introduzca el teléfono' }}" />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for="emailCliente">{{ 'Email' }}: </label>
                          <div class="an-input-group">
                            <div class="an-input-group-addon"><i class="ion-at"></i></div>
                            <input type="email" id="emailCliente" class="an-form-control not-null" name="emailCliente" placeholder="{{ 'Introduzca el email' }}" />
                          </div>
                          <label for="razonCliente">{{ 'Razón social' }}: </label>
                          <div class="an-input-group">
                            <div class="an-input-group-addon"><i class="ion-document-text"></i></div>
                            <input type="email" id="razonCliente" class="an-form-control not-null" name="razonCliente" placeholder="{{'Introduzca la razón social del cliente'}}" />
                          </div>
                        </div>
                        <div class="col-md-3 col-md-offset-9">
                          <label for="razonCliente">{{ 'Limite de crédito' }}: </label>
                          <div class="an-input-group">
                            <div class="an-input-group-addon"><i class="ion-social-usd"></i></div>
                            <input type="number" id="limiteCredito" class="an-form-control not-null" name="limiteCredito" step="1" value="0"/>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-offset-9">
                      <button type="button" class="an-btn an-btn-danger">{{ 'Cancelar' }}</button>
                      <button type="button" id="registrar" class="an-btn an-btn-success">{{ 'Registrar' }}</button>
                    </div>
                  </div>

              </div>
            </div>