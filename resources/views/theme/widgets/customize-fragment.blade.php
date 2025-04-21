          
    <div class="an-single-component with-shadow">
          <div class="an-component-header">
            <h6>Colores <img src="{{asset('assets/img/loading.gif')}}" height="30" width="30" id="loader-data" /></h6>
            <div class="component-header-right">
              <form class="an-form" action="#">
              </form>
            </div>
          </div>
          <div class="an-component-body padding20">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Color del header</label>
                  <input type="color" class="form-control" data=".an-header" data-prop="background-color" id="header_background"/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Color de header (Fuente)</label>
                  <input type="color" class="form-control" data=".an-header" data-prop="color" id="header_color"/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Color de sidebar</label>
                  <input type="color" class="form-control" data=".an-sidebar-nav" data-prop="background-color" id="sidebar_background"/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Color de sidebar (Fuente)</label>
                  <input type="color" class="form-control" data=".an-sidebar-nav" data-prop="color" id="sidebar_color"/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Color de KPIs</label>
                  <input type="color" class="form-control" data=".widget-signle" data-prop="background-color" id="sidebar_kpi_background"/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Buscador de header</label>
                  <input type="color" class="form-control" data=".an-topbar-left-part .an-search-field .an-form-control" data-prop="background-color" id="searchbox_background"/>
                </div>
              </div>
            </div>

            <hr/>

            <div class="row text-center">
              
              <div class="col-md-2">
                <label><strong>Botón (Primary)</strong></label>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="color" class="form-control" data=".an-btn-primary" data-type="background-color" data-btn="true" data-btn-type="normal" data-prop="background-color" id="btn_primary">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <button class="an-btn an-btn-primary btn-block">Botón</button>
                </div>
              </div>
              
              <div class="col-md-2">
                <label><strong>Botón (Success)</strong></label>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="color" class="form-control" data=".an-btn-success" data-type="background-color" data-btn="true" data-btn-type="normal" data-prop="background-color" id="btn_success">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <button class="an-btn an-btn-success btn-block">Botón</button>
                </div>
              </div>
              
              <div class="col-md-2">
                <label><strong>Botón (Info)</strong></label>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="color" class="form-control" data=".an-btn-info" data-type="background-color" data-btn="true" data-btn-type="normal" data-prop="background-color" id="btn_info">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <button class="an-btn an-btn-info btn-block">Botón</button>
                </div>
              </div>
              
              <div class="col-md-2">
                <label><strong>Botón (Warning)</strong></label>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="color" class="form-control" data=".an-btn-warning" data-type="background-color" data-btn="true" data-btn-type="normal" data-prop="background-color" id="btn_warning">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <button class="an-btn an-btn-warning btn-block">Botón</button>
                </div>
              </div>

              <div class="col-md-2">
                <label><strong>Botón (Danger)</strong></label>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="color" class="form-control" data=".an-btn-danger" data-type="background-color" data-btn="true" data-btn-type="normal" data-prop="background-color" id="btn_danger">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <button class="an-btn an-btn-danger btn-block">Botón</button>
                </div>
              </div>
            </div>
            <br/>
            <br/>
            <br/>
            <div class="row">
              <div class="col-md-12 text-center">
                <button type="button" id="save-styles" class="an-btn an-btn-primary">Guardar cambios</button>
                <img src="{{asset('assets/img/loading.gif')}}" height="30" width="30" id="loader" style="display: none;" />
              </div>
            </div>
          </div>
    </div>