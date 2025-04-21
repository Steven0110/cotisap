          <div class="an-body-topbar wow fadeIn">
            <div class="an-page-title">
              <h2>{{ 'Vista general' }}</h2>
              <p>{{ 'Bienvenido' }}, 


                <a href="#"><i class="icon-marker"></i>{{ 'Ubicaci&oacute;n' }}: <span id="location">México</span></a>
              </p>
            </div>
          </div>
          @include('theme.widgets.datos')

          <div class="row an-masonry-layout">
            <div class="col-md-6 grid-item">
              @include('theme.widgets.slider')
            </div>
                   
            <div class="col-md-6 grid-item">
              @include('theme.widgets.kpi.general-quotations')
            </div>
            <br/>
            <div class="col-md-6 grid-item">
              @include('theme.widgets.kpi.quick-article')
            </div>
            <div class="col-md-4 grid-item">
              @include('theme.widgets.kpi.cotizaciones-wheel')
            </div>
            <div class="col-md-3 grid-item">
              @include('theme.widgets.kpi.hitrate-wheel')
            </div>
            
            <div class="col-md-12 grid-item">
              @include('theme.widgets.kpi.salesperson-info')
            </div>

            <div class="col-md-12 grid-item">
              @include('theme.widgets.kpi.estado-cuenta');
            </div>
          </div>