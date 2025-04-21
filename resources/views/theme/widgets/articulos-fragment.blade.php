
        <div class="an-single-component with-shadow">
          <div class="an-component-header">
            <h6>Artículos (No SAP)</h6>
            <div class="component-header-right">
              <div class="an-default-select-wrapper">
              </div>
              <div class="btn-space">
                    <button id="update-btn-trigger" class="an-btn an-btn-success block-icon" data-toggle="modal" data-target="#update-article" style="display: none;"> <i class="ion-plus-round"></i>Agregar</button>
              </div>
            </div>
          </div>
          <div class="an-component-body padding20">
            
            </div>
            <div style='padding: 20px;'>
              <table id="articles-table" hidden="hidden">
                <thead>
                  <th class="text-center">{{'ID'}}</th>
                  <th class="text-center">{{'Código'}}</th>
                  <!--<th class="text-center">{{'Nombre'}}</th>-->
                  <th class="text-center">{{'Descripción'}}</th>
                  <th class="text-center">{{'Lista'}}</th>
                  <th class="text-center">{{'Precio'}}</th>
                  <th class="text-center">{{'Moneda'}}</th>
                  <th class="text-center">{{'UMV'}}</th>
                  <th class="text-center">{{'Status'}}</th>
                  <th class="text-center"></th>
                  <th class="text-center"></th>
                </thead>
                <tbody></tbody>
              </table>
              
              <div class="row text-center" id="data-loader">
                  <img src="{{ asset('assets/img/loading3.gif') }}" />
              </div>
            </div>
        </div>

      <div class="modal fade primary" id="update-article" tabindex="-1" role="dialog" aria-labelledby="addNotas">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="update-label">{{ 'Actualizar artículo' }}</h4>
              </div>
              <div class="modal-body">
                <p class="an-small-doc-blcok" id="update-instr">Modifica los campos que consideres necesarios</p>
                <div class="col-md-6 padding20">
                  <label for="id">{{'ID'}}: </label>
                  <div class="row" id="row-cap">
                    <div class="col-md-10">
                      <div class="an-input-group">
                        <div class="an-input-group-addon"><i class="ion-pound"></i></div>
                        <input id="id" type="text" class="an-form-control text-center" disabled="disabled" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 padding20">
                  <label for="codigo">{{'Código'}}: </label>
                  <div class="row">
                    <div>
                      <div class="an-input-group">
                        <div class="an-input-group-addon"><i class=""></i></div>
                        <input id="codigo" type="text" class="an-form-control text-center" disabled="disabled" />
                      </div>
                    </div>
                  </div>
                </div>
                <!--
                <div class="row">
                  <div class="col-md-6">
                    <label for="nombre">Nombre: </label>
                    <div class="an-input-group">
                      <div class="an-input-group-addon" id=""><i class=""></i></div>
                      <input id="nombre" type="text" class="an-form-control not-null text-center" data-toggle="tooltip" title="Hello" />
                    </div>
                  </div>
                </div>-->
                <label for="desc">Descripción: </label>
                  <textarea id="desc" type="text" class="an-form-control not-null" data-toggle="tooltip" title="Hello"></textarea>
                <label for="desc">Comentarios: </label>
                  <textarea id="com" type="text" class="an-form-control" data-toggle="tooltip" title="Hello"></textarea>
                <div class="row">
                  <div class="col-md-4">
                    <label for="lista">Lista: </label>
                    <div class="an-input-group">
                      <div class="an-input-group-addon" id=""><i class=""></i></div>
                      <input id="lista" type="text" class="an-form-control not-null text-center" data-toggle="tooltip" title="Hello" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="precio">Precio: </label>
                    <div class="an-input-group">
                      <div class="an-input-group-addon" id=""><i class=""></i></div>
                      <input id="precio" type="number" step="0.01" class="an-form-control not-null" data-toggle="tooltip" title="Hello" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="moneda">Moneda: </label>
                    <div class="an-input-group">
                      <div class="an-input-group-addon" id=""><i class=""></i></div>
                      <input id="moneda" type="text" class="an-form-control not-null upper-case text-center" data-toggle="tooltip" title="Hello" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <label for="umv">UMV: </label>
                    <div class="an-input-group">
                      <div class="an-input-group-addon"><i class=""></i></div>
                      <input id="umv" type="text" class="an-form-control not-null upper-case text-center" data-toggle="tooltip" title="Hello" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label>Status: </label>
                    <span class="an-custom-radiobox">
                      <input type="radio" name="name" id="activo" checked="checked"/>
                      <label for="activo">Activo</label>
                    </span>
                    <span class="an-custom-radiobox danger">
                      <input type="radio" name="name" id="inactivo"/>
                      <label for="inactivo">inactivo</label>
                    </span>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="an-btn an-btn-danger" data-dismiss="modal">{{ 'Cancelar' }}</button>
                <button type="button" class="an-btn an-btn-success" id="action-btn"><span>{{ 'Actualizar' }}</span>
                  <img src="{{ asset('assets/img/loading.gif') }}" height="20" hidden="hidden" /></button>
              </div>
          </div>
        </div>
      </div>