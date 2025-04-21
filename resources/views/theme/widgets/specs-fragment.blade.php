
        <div class="an-single-component with-shadow">
          <div class="an-component-header">
            <h6>Especificaciones</h6>
            <div class="component-header-right">
              <form class="an-form" action="#">
              </form>
              <div class="an-default-select-wrapper">
              </div>
              <div id="div-add" class="btn-space">
                    <button id="create-btn" class="an-btn an-btn-success block-icon" data-toggle="modal" data-target="#add"> <i class="ion-plus-round"></i>Agregar</button>
                    <button id="update-btn-trigger" class="an-btn an-btn-success block-icon" data-toggle="modal" data-target="#add" style="display: none;"> <i class="ion-plus-round"></i>Agregar</button>
              </div>
            </div>
          </div>
          <div class="an-component-body padding20">
            </div>
            <div style='padding: 20px;'>
              <div id="container" style="display:none;">
                <table id="specs-table" class="hover"></table>
              </div>
              
              <div class="row text-center" id="data-loader">
                  <img src="{{ asset('assets/img/loading3.gif') }}" />
              </div>
            </div>
        </div>

      <!-- Agregar nuevo registro -->
      <div class="modal fade primary" id="add" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="display: none;" id="add-label">{{ 'Agregar especificación' }}</h4>
                <h4 style="display: none;" id="update-label">{{ 'Actualizar especificación' }}</h4>
              </div>
              <div class="modal-body">
                <p class="an-small-doc-blcok" id="create-instr">Complete el siguiente formulario para poder agregar una especificación</p>
                <p class="an-small-doc-blcok" id="update-instr">Modifica los campos que consideres necesarios</p>
                <div id="row-id">
                  <label for="id">ID: </label>
                  <div class="row" id="row-component">
                    <div class="col-md-4">
                      <div class="an-input-group">
                        <div class="an-input-group-addon"><i class="ion-pound"></i></div>
                        <input id="id" type="text" class="an-form-control text-center" placeholder="ID" data-toggle="tooltip" title="Hello" value="" disabled="disabled" />
                      </div>
                    </div>
                  </div>
                </div>
                <label for="title">Nombre: </label>
                <div class="an-input-group">
                  <div class="an-input-group-addon" id="title-icon"><i class=""></i></div>
                  <input id="title" type="text" class="an-form-control not-null" placeholder="Título" data-toggle="tooltip" title="Hello" />
                </div>
                <div id="row-type">
                  <label for="type-update">Tipo: </label>
                  <div class="an-input-group">
                    <div class="an-input-group-addon" id="title-icon"><i class=""></i></div>
                    <input id="type-update" type="text" class="an-form-control" placeholder="Tipo" data-toggle="tooltip" title="Hello" disabled="disabled" />
                  </div>
                </div>
                <div id="row-select-type" class="an-default-select-wrapper" style="margin-bottom: 40px;">

                  <label for="select-cat">Tipo: </label>
                  <select name="type" id="type" data-toggle="tooltip" title="Hello" >
                    <option data-value="unchosen" value="unchosen">{{ 'Selecciona un tipo' }}</option>
                    <option data-value="0" value="0" text="">{{ 'Condiciones comerciales' }}</option>
                    <option data-value="1" value="1" text="">{{ 'Consideraciones especiales' }}</option>
                    <option data-value="2" value="2" text="">{{ 'Factores a considerar' }}</option>
                    <option data-value="3" value="3" text="">{{ 'Entrega Express' }}</option>
                    <option data-value="4" value="4" text="">{{ 'Viáticos de consultores' }}</option>
                    <option data-value="5" value="5" text="">{{ 'Alcance de implementación' }}</option>
                  </select>
                </div>
                <label for="desc">Descripción: </label>
                <div class="an-input-group">
                  <div class="an-input-group-addon" id="desc-icon"><i class=""></i></div>
                  <textarea id="desc" type="text" class="an-form-control not-null" placeholder="Descripción de la especificación" data-toggle="tooltip" title="Hello" ></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="an-btn an-btn-danger" id="close" data-dismiss="modal">{{ 'Cancelar' }}</button>
                <button type="button" class="an-btn an-btn-success" id="action-btn"><span>{{ 'Guardar' }}</span>
                  <img id="ajax-loader" src="{{ asset('assets/img/loading.gif') }}" height="20" style="display: none;"/></button>
              </div>
          </div>
        </div>
      </div>
    </div>