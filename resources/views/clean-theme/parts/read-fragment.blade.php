
            <div class="col s12" >
                <div class="box">
                    <div class="box-header">
                        <i class="icon-bookmark"></i>
                        <h5>Empresas registradas</h5>
                    </div>
                    <div class="box-hide-me box-content text-center">
                        <table id="companies-table" class="hover"></table>
                        <div class="row" style="text-align: center !important;">
                            <img src="{{asset('assets/img/loading3.gif')}}" id="table-loader"/>
                        </div>
                    </div>
                </div>
            </div>
            

            <div id="update-modal" style="display: none;width: 70%;" id="update-modal" class="animated-modal">
                <div id="loading-container" class="animated-modal center">
                    <img src="{{asset('assets/img/loading3.gif')}}" id="update-loader"/>
                </div>
                <div id="container" style="display: none;">
                    
                    <h5>Datos generales</h5>
                    <div class="row">
                        <input style="display: none;" value="1" id="id" type="text">
                        <div class="col s6">
                            <div class="input-field col s12">
                                <input value="MBR Hosting" id="name" type="text">
                                <label for="name">Nombre</label>
                            </div>
                            <div class="input-field col s12">
                                <input value="mbrhosting" disabled="disabled" id="prefix" type="text">
                                <label for="prefix">Prefijo de tablas <small>(no editable)</small> </label>
                            </div>
                            <div class="input-field col s12">
                                <input value="mbrhosting.com" id="domain" type="text">
                                <label for="domain">Dominio</label>
                            </div>
                        </div>
                        <div class="col s6">
                            <div class="input-field col s12 center">
                                <img id="image" style="border-radius:10%;border: 2px solid #1f3a4d;padding:10px;" src="" width="150" height="150" />
                            </div>
                            <div class="input-field col s12">
                                <input value="mbrhosting.com/img.jpg" id="url" type="text">
                                <label for="url">URL de logo</label>
                            </div>
                        </div>
                    </div>
                    <h5>Accesos a SAP</h5>
                    <div class="row">
                        <div class="col s6">
                            <div class="input-field col s12">
                                <input value="sap.com" id="sap_host" type="text">
                                <label for="sap_host">Host</label>                            
                            </div>
                            <div class="input-field col s12">
                                <input value="sap.com" id="sap_dbname" type="text">
                                <label for="sap_dbname">Base de datos</label>  
                            </div>
                        </div>
                        <div class="col s6">
                            <div class="input-field col s12">
                                <input value="sapbo" id="sap_user" type="text">
                                <label for="sap_user">Usuario</label>                            
                            </div>
                            <div class="input-field suffix col s12">
                                <input value="root" id="sap_psw" type="password">
                                <label for="sap_psw">Contraseña</label>
                                <i class="material-icons changer">lock</i>                            
                            </div>
                        </div>
                    </div>
                    <h5>Accesos a MySQL</h5>
                    <div class="row">
                        <div class="col s6">
                            <div class="input-field col s12">
                                <input value="mysql.com" id="mysql_host" type="text">
                                <label for="mysql_host">Host</label>                            
                            </div>
                            <div class="input-field col s12">
                                <input value="mysql.com" id="mysql_dbname" type="text">
                                <label for="mysql_dbname">Base de datos</label>  
                            </div>
                        </div>
                        <div class="col s6">
                            <div class="input-field col s12">
                                <input value="mysqlbo" id="mysql_user" type="text">
                                <label for="mysql_user">Usuario</label>                            
                            </div>
                            <div class="input-field suffix col s12">
                                <input value="root" id="mysql_psw" type="password">
                                <label for="mysql_psw">Contraseña</label>
                                <i class="material-icons changer">lock</i>                            
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s4">
                            <a class="waves-effect waves-light btn" id="return" data-fancybox-close><i class="material-icons right">keyboard_return</i>Regresar</a>
                        </div>
                        <div class="col s4 offset-s4">
                            <a class="waves-effect waves-light btn" id="update-btn"><i class="material-icons right">backup</i>Actualizar</a>
                        </div>
                    </div>
                    <div class="row" id="loading-update" style="display: none;">
                        <div class="progress">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </div>
            </div>
        