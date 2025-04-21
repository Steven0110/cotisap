              <style type="text/css">
                #statements-table td:nth-last-child(-n+2), #statements-table th:nth-last-child(-n+2){
                  background: rgba(50,165,213,1);
                  color: white;
                }
                #statements-table td:last-child, #statements-table th:last-child{
                  background: rgba(118,196,51,1);
                  color: white;
                }
              </style>
              <div class="an-single-component with-shadow" style="padding: 20px;">
                <div class="an-component-header">
                  <h6>Estados de cuenta (45 días)</h6>
                  <div class="component-header-right">
                    <span>Selecciona un socio: </span>
                    <div class="an-default-select-wrapper" id="partner-wrapper">
                    </div>
                  </div>
                </div>

                <div class="an-component-body">
                  <style type="text/css">
                    #statements-table-loader{
                    }
                  </style>
                  <img id="statements-table-loader" style="position:absolute;top:25px;z-index: 9999;display:none;" src="{{ asset('assets/img/loading3.gif') }}"/>
                  <table id="statements-table" class="display compact">
                  </table>
                </div> 
              </div>