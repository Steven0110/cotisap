        
              <div class="an-single-component with-shadow">

                <div class="an-helper-block">
                  <div class="an-component-header">
                    <h6>Información por vendedor</h6>
                    <div class="component-header-right">
                      <span>Selecciona un vendedor: </span>
                      <div class="an-default-select-wrapper salespersons-wrapper" style="margin:0px;margin-left:5px;">
                        <select id="salesperson" class="an-form-control success salespersons">
                          <option value="1">Vendedor 1</option>
                          <option value="2">Vendedor 2</option>
                          <option value="3">Vendedor 3</option>
                          <option value="4">Vendedor 4</option>
                          <option value="5">Vendedor 5</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="an-component-body" id="salespersons-container">
                    <div class="row">
                      <div class="col-md-6">
                        <canvas id="quotations-salesperson-graph" width="400" height="300"></canvas>
                      </div>
                      <div class="col-md-6">
                        <canvas id="products-salesperson-graph" width="400" height="300"></canvas>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <canvas id="quotations-status-salesperson-graph" width="100" height="100"></canvas>
                      </div>
                      <div class="col-md-4">
                        <canvas id="hitrate-salesperson-graph" width="100" height="100"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>