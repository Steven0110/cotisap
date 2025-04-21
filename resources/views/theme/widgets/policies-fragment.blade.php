
        <div class="an-single-component with-shadow">
          <div class="an-component-header">
            <h6>Póliza</h6>
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
                <table id="policies-table"></table>
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
                <h4 style="display: none;" id="add-label">{{ 'Agregar Póliza' }}</h4>
                <h4 style="display: none;" id="update-label">{{ 'Actualizar Póliza' }}</h4>
              </div>
              <div class="modal-body">
                <p class="an-small-doc-blcok" id="create-instr">Complete el siguiente formulario para poder agregar una póliza</p>
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
                <label for="title">Nombre de la póliza: </label>
                <div class="an-input-group">
                  <div class="an-input-group-addon" id="title-icon"><i class=""></i></div>
                  <input id="title" type="text" class="an-form-control not-null" placeholder="Título" data-toggle="tooltip" title="Hello" />
                </div>
                <br/>
                <label for="desc">Descripción: </label>
                <div class="an-input-group">
                  <div class="an-input-group-addon" id="desc-icon"><i class=""></i></div>
                  <textarea id="desc" type="text" class="an-form-control not-null" placeholder="Descripción de la póliza" data-toggle="tooltip" title="Hello" ></textarea>
                </div>
                <label for="price">Precio <small id="small-price">(opcional)</small>:</label>
                <div class="an-input-group">
                  <div class="an-input-group-addon" id="title-icon"><i class="ion-social-usd"></i></div>
                  <input id="price" type="text" class="an-form-control" placeholder="Precio" data-toggle="tooltip" title="Hello" />
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