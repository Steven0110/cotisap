@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

      
    <div class="an-single-component with-shadow">
          <div class="an-component-header">
            <h6>Herramientas</h6>
            <div class="component-header-right">
              <form class="an-form" action="#">
                <!--
                <div class="an-search-field">
                  <input class="an-form-control" id='search' type="text" placeholder="{{ 'Buscar ...' }}">
                  <button class="an-btn an-btn-icon" type="submit"><i class="icon-search"></i></button>
                </div>-->
              </form>
              <div class="an-default-select-wrapper">
                <!--
                <select name="sort">
                  <option value="0">{{ 'Seleccione estatus' }}</option>
                  <option value="1">{{ 'Activo' }}</option>
                  <option value="2">{{ 'Inactivo' }}</option>
                </select> -->
              </div>
              <div class="btn-space">
                    <button style="display: none;" id="create-btn" class="an-btn an-btn-success block-icon" data-toggle="modal" data-target="#addTool"> <i class="ion-plus-round"></i>Agregar</button>
                    <button id="update-btn-trigger" class="an-btn an-btn-success block-icon" data-toggle="modal" data-target="#addTool" style="display: none;"> <i class="ion-plus-round"></i>Agregar</button>
              </div>
            </div>
          </div>
          <div class="an-component-body padding20">
            <!--
            <div class="an-user-lists tables messages">
              <div class="list-title">
                <h6 class="basis-50">
                  <span class="an-custom-checkbox">
                    <input type="checkbox" id="check-11">
                    <label for="check-11"></label>
                  </span>
                  {{ 'Categoría' }}
                </h6>
                <h6 class="basis-30">{{'Título'}}</h6>
                <h6 class="basis-50">{{'Descripción'}}</h6>
                <h6 class="basis-30">{{'Archivo'}}</h6>
                <h6 class="basis-50">{{'Link'}}</h6>
                <h6 class="basis-10">{{'Estado'}}</h6>
                <h6 class="basis-10"></h6>
                <h6 class="basis-10"></h6>
              </div>

              <div class="an-lists-body an-customScrollbar">
                <div class="list-user-single">
                  <div class="list-name basis-50">
                    <span class="an-custom-checkbox">
                      <input type="checkbox" id="check-20">
                      <label for="check-20"></label>
                    </span>
                    <a href="#">Certificaciones</a>
                  </div>
                  <div class="list-text basis-30">
                    <p>Test 001</p>
                  </div>
                  <div class="list-text basis-50">
                    <p>Lorem ipsum</p>
                  </div>
                  <div class="list-text basis-30">
                    <p>test001.png</p>
                  </div>
                  <div class="list-text email approve basis-50">
                    <a href="#">http://www.google.com</a>
                  </div>
                  <div class="list-state basis-10">
                    <span class="msg-tag read">Activo</span>
                  </div>                        
                  <div class="list-action basis-20">
                    <div class="btn-group">
                      <button type="button" class="an-btn an-btn-icon small dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-setting"></i>
                      </button>
                      <div class="dropdown-menu right-align">
                        <ul class="an-basic-list">
                          <li><a href="#">Mark as read</a></li>
                          <li><a href="#">Mark as unread</a></li>
                          <li><a href="#">Select</a></li>
                        </ul>
                      </div>
                    </div>
                    <button class="an-btn an-btn-icon small muted danger"><i class="icon-trash"></i></button>
                  </div>
                </div>
              </div>
            -->
            </div>
            <div style='padding: 20px;' >
              <table id="tools-table" hidden="hidden" width="100%" class="display" cellspacing="0">
                <thead>
                  <th class="text-center">{{'ID'}}</th>
                  <th class="text-center">{{'Título'}}</th>
                  <th class="text-center">{{'Marca'}}</th>
                  <th class="text-center">{{'Descripción'}}</th>
                  <th class="text-center">{{'Categoría'}}</th>
                  <th class="text-center">{{'Archivo'}}</th>
                  <th class="text-center">{{'Link'}}</th>
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
            <!--
            <div class="an-pagination-container">
                <p class="result-info">Desplegados 5 resultados de 1245</p>
                <button class="an-btn an-btn-transparent rounded uppercase small-font">Ver todo ...</button>
                <ul class="pagination">
                  <li>
                    <a href="#" aria-label="Previous">
                      <span aria-hidden="true"><i class="ion-chevron-left"></i></span>
                    </a>
                  </li>
                  <li><a href="#" class="active">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">..</a></li>
                  <li><a href="#">45</a></li>
                  <li><a href="#">55</a></li>
                  <li>
                    <a href="#" aria-label="Next">
                      <span aria-hidden="true"><i class="ion-chevron-right"></i></span>
                    </a>
                  </li>
                </ul>
            </div>
          </div>-->
      <!-- Agregar nuevo registro -->
      <div class="modal fade primary" id="addTool" tabindex="-1" role="dialog" aria-labelledby="addNotas">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="addRegLabel">{{ 'Agregar registro' }}</h4>
                <h4 id="updateRegLabel" style="display: none;">{{ 'Actualizar registro' }}</h4>
              </div>
              <div class="modal-body">
                <p class="an-small-doc-blcok" id="create-instr">Complete el siguiente formulario para poder agregar un registro de capacitación</p>
                <p class="an-small-doc-blcok" id="update-instr">Modifica los campos que consideres necesarios</p>
                <div id="row-id">
                  <label for="titTool">ID: </label>
                  <div class="row" id="">
                    <div class="col-md-4">
                      <div class="an-input-group">
                        <div class="an-input-group-addon"><i class="ion-pound"></i></div>
                        <input id="idTool" type="text" class="an-form-control text-center" placeholder="ID" data-toggle="tooltip" title="Hello" value="" disabled="disabled" />
                      </div>
                    </div>
                  </div>
                </div>
                <label for="titTool">Título de la herramienta: </label>
                <div class="an-input-group">
                  <div class="an-input-group-addon" id="titToolIcon"><i class=""></i></div>
                  <input id="titTool" type="text" class="an-form-control" placeholder="Título" data-toggle="tooltip" title="Hello" />
                </div>
                <label for="brandTool">Marca de la herramienta: </label>
                <div class="an-input-group">
                  <div class="an-input-group-addon" id="brandToolIcon"><i class=""></i></div>
                  <input id="brandTool" type="text" class="an-form-control" placeholder="Marca" data-toggle="tooltip" title="Hello" />
                </div>
                <div id="row-cat-info">
                <label for="descTool">Categoría: </label>
                  <div class="an-input-group">
                    <div class="an-input-group-addon" id=""><i class=""></i></div>
                    <input id="catTool" type="text" class="an-form-control" placeholder="" disabled="disabled" />
                  </div>
                </div>

                <label for="descTool">Descripción: </label>
                <div class="an-input-group">
                  <textarea id="descTool" placeholder="Escribe una breve descripción" data-toggle="tooltip" title="Hello" cols="75" rows="2"></textarea>
                </div>

                <div id="row-cat" class="an-default-select-wrapper">

                  <label for="select-cat">Categoría: </label>
                  <select name="categoria" id="select-cat" data-toggle="tooltip" title="Hello" >
                    <option data-value="unchosen" value="unchosen">{{ 'Selecciona una categoría' }}</option>
                    <option data-value="0" value="0" text="Catálogos">{{ 'Catálogos' }}</option>
                    <option data-value="1" value="1" text="Certificaciones">{{ 'Certificaciones' }}</option>
                    <option data-value="2" value="2" text="Fichas Técnicas">{{ 'Fichas Técnicas' }}</option>
                    <option data-value="3" value="3" text="Manuales">{{ 'Manuales' }}</option>
                    <option data-value="4" value="4" text="Varios">{{ 'Varios' }}</option>
                    <option data-value="5" value="5" text="Comunicados">{{ 'Comunicados' }}</option>
                    <option data-value="6" value="6" text="Video">{{ 'Video' }}</option>
                    <option data-value="7" value="7" text="Audio">{{ 'Audio' }}</option>
                  </select>
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
                <div id="row-file-choose">
                  <label>Tipo de recurso: </label>
                  <span class="an-custom-radiobox">
                    <input type="radio" name="type" id="file" checked="checked" />
                    <label for="file">Archivo</label>
                  </span>
                  <span class="an-custom-radiobox">
                    <input type="radio" name="type" id="link"/>
                    <label for="link">Link</label>
                  </span>
                </div>
                <br/>
                <div class="text-center" id="row-link" hidden="hidden">
                  <div class="an-input-group">
                    <div class="an-input-group-addon" id="linkToolIcon"><i class=""></i></div>
                    <input id="linkTool" type="text" class="an-form-control" placeholder="Link" data-toggle="tooltip" title="Hello" />
                  </div>
                </div>
                <div class="text-center" id="row-file">
                  <button class="an-btn an-btn-success block-icon" id="upload_file" type="button"> <i class="icon-upload" data-toggle="tooltip" title="No hay ningún archivo seleccionado"></i><span>Subir archivo</span></button>
                  <input type="file" id="input_file" name="imagen" hidden="hidden" style="display: none;" />
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