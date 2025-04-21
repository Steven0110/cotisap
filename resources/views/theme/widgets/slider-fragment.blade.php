<!-- 
  [
    'Developer' => 'Gerardo Aramis Cabello Acosta',
    'GitHub'    => 'https://github.com/Steven0110/'
  ]
-->
        <div class="an-single-component with-shadow">
          <div class="an-component-header">
            <h6>Slider</h6>
            <div class="component-header-right">
              <form class="an-form" action="#">
              </form>
              <div class="an-default-select-wrapper">
              </div>
              <div id="div-add" class="btn-space" style="display: none;">
                    <button id="create-btn" class="an-btn an-btn-success block-icon" data-toggle="modal" data-target="#addSlider"> <i class="ion-plus-round"></i>Agregar</button>
                    <button id="update-btn-trigger" class="an-btn an-btn-success block-icon" data-toggle="modal" data-target="#addSlider" style="display: none;"> <i class="ion-plus-round"></i>Agregar</button>
              </div>
            </div>
          </div>
          <div class="an-component-body padding20">
            </div>
            <div style='padding: 20px;'>
              <table id="slider-table" hidden="hidden">
                <thead>
                  <th class="text-center">{{'ID'}}</th>
                  <th class="text-center">{{'Título'}}</th>
                  <th class="text-center">{{'Archivo'}}</th>
                  <th class="text-center">{{'Interno'}}</th>
                  <th class="text-center">{{'Cliente'}}</th>
                  <th class="text-center">{{'Estado'}}</th>
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
      <div class="modal fade primary" id="addSlider" tabindex="-1" role="dialog" aria-labelledby="addNotas">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="myModalLabel">{{ 'Agregar Slider' }}</h4>
              </div>
              <div class="modal-body">
                <p class="an-small-doc-blcok" id="create-instr">Complete el siguiente formulario para poder agregar un slider</p>
                <p class="an-small-doc-blcok" id="update-instr">Modifica los campos que consideres necesarios</p>
                <div id="row-id">
                  <label for="titSlider">ID: </label>
                  <div class="row" id="row-slider">
                    <div class="col-md-4">
                      <div class="an-input-group">
                        <div class="an-input-group-addon"><i class="ion-pound"></i></div>
                        <input id="idSlider" type="text" class="an-form-control text-center" placeholder="ID" data-toggle="tooltip" title="Hello" value="" disabled="disabled" />
                      </div>
                    </div>
                  </div>
                </div>
                <label for="titSlider">Título del slider: </label>
                <div class="an-input-group">
                  <div class="an-input-group-addon" id="titSliderIcon"><i class=""></i></div>
                  <input id="titSlider" type="text" class="an-form-control" placeholder="Título" data-toggle="tooltip" title="Hello" />
                </div>
                <div id="row-int-ext">
                  <span class="an-custom-checkbox">
                    <input type="checkbox" id="check-int"/>
                    <label for="check-int">Interno</label>
                  </span>
                  <span class="an-custom-checkbox">
                    <input type="checkbox" id="check-ext"/>
                    <label for="check-ext">Externo</label>
                  </span>
                </div>
                <br/>
                <div id="row-status">
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
                <br/>
                <div class="text-center" id="row-file">
                  <button class="an-btn an-btn-success block-icon" id="upload_img" type="button"> <i class="icon-upload" data-toggle="tooltip" title="No hay ningún archivo seleccionado"></i><span>Subir imagen</span></button>
                  <input type="file" id="input_img" name="imagen" hidden="hidden" style="display: none;" />
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="an-btn an-btn-danger" data-dismiss="modal">{{ 'Cancelar' }}</button>
                <button type="button" class="an-btn an-btn-success" id="action-btn"><span>{{ 'Guardar' }}</span>
                  <img src="{{ asset('assets/img/loading.gif') }}" height="20" hidden="hidden" /></button>
              </div>
          </div>
        </div>
      </div>
    </div>