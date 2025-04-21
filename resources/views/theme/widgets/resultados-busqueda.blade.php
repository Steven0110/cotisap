
        <div class="an-single-component with-shadow">          

          <div class="an-component-header">
            <h6>Se encontraron <strong>{{$total}}</strong> resultados para <strong>{{$q}}</strong></h6>
            <div class="component-header-right">
              <div class="an-default-select-wrapper">
              </div>
            </div>
          </div>
          <div class="an-component-body padding20">
            <div class="search-results">
              @if(count($quotations) != 0)
              <!-- Cotizaciones -->
              <h4><strong>Cotizaciones</strong></h4>
              <div class="row headers">
                <div class="col-md-2 text-center">
                  <h5>#</h5>
                </div>
                <div class="col-md-4 text-center">
                  <h5>Cliente</h5>
                </div>
                <div class="col-md-2 text-center">
                  <h5>Fecha</h5>
                </div>
                <div class="col-md-2 text-center">
                  <h5>Monto</h5>
                </div>
                <div class="col-md-2 text-center">
                  <h5></h5>
                </div>
              </div>
              @foreach($quotations as $q)
              <div class="row">
                <div class="col-md-2 text-center">
                  <h5>{{$q->numCotizacion}}</h5>
                </div>
                <div class="col-md-4 text-center">
                  <h5>{{$q->nombreCliente}}</h5>
                </div>
                <div class="col-md-2 text-center">
                  <h5>{{substr($q->created_at, 0, 10)}}</h5>
                </div>
                <div class="col-md-2 text-center">
                  <h5>$ {{number_format($q->total,2,",",".")}}</h5>
                </div>
                <div class="col-md-2 text-center">
                  <a href="{{URL::route('show-cotizacion', $q->numCotizacion)}}" target="_blank"><button type="button" class="an-btn an-btn-primary">Ver</button></a>
                </div>
              </div>
              @endforeach
              @endif


              @if(count($delivers) != 0)
              <!-- Entregas -->
              <br/>
              <hr/>
              <h4><strong>Entregas</strong></h4>
              <div class="row headers">
                <div class="col-md-1 text-center">
                  <h5>#</h5>
                </div>
                <div class="col-md-4 text-center">
                  <h5>Cliente</h5>
                </div>
                <div class="col-md-2 text-center">
                  <h5>Estatus</h5>
                </div>
                <div class="col-md-3 text-center">
                  <h5>Fecha</h5>
                </div>
                <div class="col-md-2 text-center">
                  <h5></h5>
                </div>
              </div>

              @foreach($delivers as $d)
              <div class="row">
                <div class="col-md-1 text-center">
                  <h5>{{$d->id}}</h5>
                </div>
                <div class="col-md-4 text-center">
                  <h5>{{$d->CardName}}</h5>
                </div>
                <div class="col-md-2 text-center">
                  <h5>{{$d->DocStatus}}</h5>
                </div>
                <div class="col-md-3 text-center">
                  <h5>{{$d->DocDate}}</h5>
                </div>
                <div class="col-md-2 text-center">
                  <a href="{{URL::route('buscar-entrega')}}?id={{$d->id}}" target="_blank"><button type="button" class="an-btn an-btn-primary">Ver</button></a>
                </div>
              </div>
              @endforeach
              @endif

              
              @if(count($invoices) != 0)
              <!-- Facturas -->
              <br/>
              <hr/>
              <h4><strong>Facturas</strong></h4>
              <div class="row headers">
                <div class="col-md-1 text-center">
                  <h5>#</h5>
                </div>
                <div class="col-md-4 text-center">
                  <h5>Cliente</h5>
                </div>
                <div class="col-md-5 text-center">
                  <h5>Comentarios</h5>
                </div>
                <div class="col-md-2 text-center">
                  <h5></h5>
                </div>
              </div>

              @foreach($invoices as $i)
              <div class="row">
                <div class="col-md-1 text-center">
                  <h5>{{$i->id}}</h5>
                </div>
                <div class="col-md-4 text-center">
                  <h5>{{$i->CardName}}</h5>
                </div>
                <div class="col-md-5 text-center">
                  <h5>{{$i->Comments}}</h5>
                </div>
                <div class="col-md-2 text-center">
                  <a href="{{URL::route('buscar-facturas')}}?id={{$i->id}}" target="_blank"><button type="button" class="an-btn an-btn-primary">Ver</button></a>
                </div>
              </div>
              @endforeach
              @endif

            </div>
            <hr/>
          </div>
        </div>
      </div>