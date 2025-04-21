
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button class="btn btn-navbar" data-toggle="collapse" data-target="#app-nav-top-bar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="../" class="brand"><i class="icon-dashboard"> Administración general</i></a>
                    <div id="app-nav-top-bar" class="nav-collapse">
                        <ul class="nav pull-right">
                            <li>
                                <a href="{{ URL::route('logout') }}"><i class="icon-signout"></i>Logout</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    
        <div id="body-container">
            <div id="body-content">
                
                    <div class="body-nav body-nav-horizontal body-nav-fixed">
                        <div class="container">
                            <ul>
                                <li>
                                    <a href="{{URL::route('create')}}" @isset($active)@if($active == 'create') class='active' @endif @endisset>
                                        <i class="icon-plus icon-large"></i> Agregar Empresa
                                    </a>
                                </li>
                                <!--
                                <li>
                                    <a href="{{URL::route('delete')}}" @isset($active)@if($active == 'delete') class='active' @endif @endisset>
                                        <i class="icon-remove icon-large"></i> Eliminar empresa
                                    </a>
                                </li>
                                <li>
                                    <a href="{{URL::route('update')}}" @isset($active)@if($active == 'update') class='active' @endif @endisset>
                                        <i class="icon-pencil icon-large"></i>Actualizar empresa
                                    </a>
                                </li>-->
                                <li>
                                    <a href="{{URL::route('read')}}" @isset($active)@if($active == 'read') class='active' @endif @endisset>
                                        <i class="icon-eye-open icon-large"></i> Ver empresas
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                
            </div>
        