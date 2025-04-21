<header class="an-header wow fadeInDown">
        <div class="an-topbar-left-part">
          <h3 class="an-logo-heading">
            <a class="an-logo-link" href="{{ URL::route('dashboard') }}">CotiSAP
            </a>
          </h3>
          <button class="an-btn an-btn-icon toggle-button js-toggle-sidebar">
            <i class="icon-list"></i>
          </button>
          <form class="an-form" action="{{URL::route('search')}}" method="GET">
            <div class="an-search-field topbar">
              <input class="an-form-control" name="q" type="text" placeholder="Buscar cotizaciones, clientes...">
              <button class="an-btn an-btn-icon" type="submit">
                <i class="icon-search"></i>
              </button>
            </div>
          </form>
        </div> <!-- end .AN-TOPBAR-LEFT-PART -->

        <div class="an-topbar-right-part">

          <div id="an-currency" class="an-currency">
            <span></span> USD
          </div>

          <div class="an-notifications">
            <div class="btn-group an-notifications-dropown notifications">
              <button type="button"
                class="an-btn an-btn-icon dropdown-toggle js-has-new-notification"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ion-ios-bell-outline"></i>
              </button>
              <div class="dropdown-menu">
                <p class="an-info-count">Notificaciones <span>0</span></p>
                <div class="an-info-content notifications-info notifications-content">
                 
                  <div class="an-info-single unread">
                    <a href="#">
                      <span class="icon-container important">
                        <i class="icon-setting"></i>
                      </span>
                      <div class="info-content">
                        <h5 class="user-name">Descubre los nuevos modulos</h5>
                        <p class="content"><i class="icon-clock"></i> Hace 10 días</p>
                      </div>
                    </a>
                  </div>

                </div> <!-- end .AN-INFO-CONTENT -->
                <div class="an-info-show-all-btn">
                  <a class="an-btn an-btn-transparent fluid rounded uppercase small-font" href="#">Ver todo</a>
                </div>
              </div>
            </div>
          </div> <!-- end .AN-NOTIFICATION -->

          <div class="an-messages">
            <div class="btn-group an-notifications-dropown messages">
              <button type="button" class="an-btn an-btn-icon dropdown-toggle js-has-new-messages"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ion-ios-email-outline"></i>
              </button>
              <div class="dropdown-menu">
                <p class="an-info-count">Mensajes <span>0</span></p>
                <div class="an-info-content notifications-info">
                  <div class="an-info-single unread">
                    <a href="#">
                      <span class="user-img"></span>
                      <div class="info-content">
                        <h5 class="user-name"></h5>
                        <p class="content">No hay mensajes</p>
                        <span class="info-time"><i class="icon-clock"></i>00:00</span>
                      </div>
                    </a>
                  </div>


                </div> <!-- end .AN-INFO-CONTENT -->

                <div class="an-info-show-all-btn">
                  <a class="an-btn an-btn-transparent fluid rounded uppercase small-font" href="#">Ver todo</a>
                </div>
              </div>
            </div>
          </div> <!-- end .AN-MESSAGE -->

          <div class="an-profile-settings">
            <div class="btn-group an-notifications-dropown  profile">
              <button type="button" class="an-btn an-btn-icon dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="an-profile-img" style="background-image: url({{ asset('/assets/img/users/photo.jpg')  }});"></span>
                <span class="an-user-name">
                  
                  {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
                
                </span>
                <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span>
              </button>
              <div class="dropdown-menu">
                <p class="an-info-count">Ajustes de la cuenta</p>
                <ul class="an-profile-list">
                  <li><a href="{{ URL::route('profile') }}"><i class="icon-user"></i>Mi perfil</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="{{ URL::route('logout') }}"><i class="icon-download-left"></i>Salir</a></li>
                </ul>
              </div>
            </div>
          </div> <!-- end .AN-PROFILE-SETTINGS -->
        </div> <!-- end .AN-TOPBAR-RIGHT-PART -->
      </header> <!-- end .AN-HEADER -->
@section('scripts')
  @parent

  <script type="text/javascript">
    
  /*  $(document).ready(function(){
      $.ajax({
        method: 'GET',
        url: "{{ URL::route('Currency') }}",
        success: function(result){
          $("#an-currency span").text(Number(result[0].Rate).toFixed(2));
        }
      });
    });
*/
  </script>


@endsection