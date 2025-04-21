
	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!--      Wizard container        -->
		            <div class="wizard-container">
		                <div class="card wizard-card" data-color="theme" id="wizardProfile">
		                    <form action="" method="">
		                <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#about" data-toggle="tab">Datos de la empresa</a></li>
			                            <li><a href="#account" data-toggle="tab">Accesos a SAP</a></li>
			                            <li><a href="#address" data-toggle="tab">Accesos a MySQL</a></li>
			                            <li><a href="#end" data-toggle="tab">Finalizado</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <!-- :::::::::::: INFOMRACIÓN DE LA EMPRESA	 ::::::::::::::::-->
		                            <div class="tab-pane" id="about">
		                                <div class="row">
		                                	<h4 class="info-text"> Ingresa la información solicitada de la empresa que se va a agregar</h4>
		                                	<div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">business</i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Nombre <small>(*)</small></label>
			                                          <input name="name" type="text" id="name" class="form-control">
			                                        </div>
												</div>

												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">find_in_page</i>
													</span>
													<div class="form-group label-floating">
													  <label class="control-label">Dominio <small>(*)</small></label>
													  <input name="domain" type="text" id="domain" class="form-control">
													</div>
												</div>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">insert_photo</i>
													</span>
													<div class="form-group label-floating">
													  <label class="control-label">URL de logo <small>(*)</small></label>
													  <input name="urllogo" id="urllogo" type="text" class="form-control">
													</div>
												</div>
		                                	</div>
		                                	<div class="col-sm-6">
		                                    	<div class="picture-container">
		                                        	<div class="picture">
                                        				<img src="" class="picture-src" id="wizardPicturePreview" title=""/>
		                                        	</div>
		                                    	</div>
		                                	</div>
		                                	<div class="col-sm-6">
				                            	<div class="pull-right">
				                                	<input type='button' class='btn btn-fill btn-theme btn-wd' name='check' value='Revisar imagen' id="lure"/>
				                                </div>
			                                </div>
		                            	</div>
		                            </div>
		                            <!-- :::::::::::: ACCESOS A MYSQL ::::::::::::::::-->
		                            <div class="tab-pane" id="account">
		                                <div class="row">
		                                	<h4 class="info-text"> Ingresa los datos de acceso para poder establecer la comunicación con SAP</h4>

		                                	<div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">business</i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Host <small>(*)</small></label>
			                                          <input name="host" id="host" type="text" class="form-control">
			                                        </div>
												</div>

												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">person</i>
													</span>
													<div class="form-group label-floating">
													  <label class="control-label">Usuario <small>(*)</small></label>
													  <input name="user" id="user" type="text" class="form-control">
													</div>
												</div>
											</div>
		                                	<div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">assignment</i>
													</span>
													<div class="form-group label-floating">
													  <label class="control-label">Nombre de la base de datos<small>(*)</small></label>
													  <input name="dbname" id="dbname" type="text" class="form-control">
													</div>
												</div>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">lock</i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Contraseña <small>(*)</small></label>
			                                          <input name="psw" id="psw" type="text" class="form-control">
			                                        </div>
												</div>
											</div>
		                                </div>
		                                <div class="row">
		                                	<div class="col-sm-4 col-md-offset-4">
				                            	<div class="text-center">
				                                	<input type='button' class='btn btn-fill btn-theme btn-wd btn-block' name='test' value='Probar conexión' id="testSAP"/>
				                                </div>
		                                	</div>
		                                </div>
		                                <div class="row" id="test-loader" style="display: none;">
		                                	<div class="col-sm-4 col-md-offset-4 text-center">
		                                		<img src="{{asset('assets/img/loading4.gif')}}"/>
		                                	</div>
		                                </div>
		                                <div class="row text-center" id="no-connection-message" style="display: none;">
				                            <h5>No se pudo establecer una conexión con el servidor de SAP</h5>
		                                </div>


		                            </div>
		                            <div class="tab-pane" id="address">
										<div class="row">
		                                	<h4 class="info-text" style="padding-left: 20px;padding-right: 20px;"> Selecciona dónde va a estar la base de datos de MySQL e ingresa la información requerida si es necesario.</h4>
											<div class="col-sm-4 col-sm-offset-2">
												<div class="choice" data-toggle="wizard-radio" id="int" rel="tooltip" title="Selecciona ésta opción si deseas que la base de datos se genere automáticamente.">
													<input type="radio" name="mysql" value="int" id="int-radio">
													<div class="icon">
														<i class="material-icons">input</i>
													</div>
													<h6>Interna</h6>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="choice" data-toggle="wizard-radio" id="ext" rel="tooltip" title="Selecciona ésta opción si deseas usar una base de datos externa. El servidor externo deberá aceptar conexiones remotas.">
													<input type="radio" name="mysql" value="ext"  id="ext-radio">
													<div class="icon">
														<i class="material-icons">open_in_new</i>
													</div>
													<h6>Externa</h6>
												</div>
											</div>
										</div>
										<div class="row" id="ext-content" style="display:none;">
											<div class="col-sm-12">	
			                                	<div class="col-sm-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">business</i>
														</span>
														<div class="form-group label-floating">
				                                          <label class="control-label">Host <small>(*)</small></label>
				                                          <input name="mysql_host" id="mysql_host" type="text" class="form-control">
				                                        </div>
													</div>

													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">person</i>
														</span>
														<div class="form-group label-floating">
														  <label class="control-label">Usuario <small>(*)</small></label>
														  <input name="mysql_user" id="mysql_user" type="text" class="form-control">
														</div>
													</div>
												</div>
			                                	<div class="col-sm-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">assignment</i>
														</span>
														<div class="form-group label-floating">
														  <label class="control-label">Nombre de la base de datos<small>(*)</small></label>
														  <input name="mysql_dbname" id="mysql_dbname" type="text" class="form-control">
														</div>
													</div>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">lock</i>
														</span>
														<div class="form-group label-floating">
				                                          <label class="control-label">Contraseña <small>(*)</small></label>
				                                          <input name="mysql_psw" id="mysql_psw" type="text" class="form-control">
				                                        </div>
													</div>
												</div>
											</div>
			                                <div class="col-sm-12" >
			                                	<div class="col-sm-4 col-md-offset-4">
					                            	<div class="text-center">
					                                	<input type='button' class='btn btn-fill btn-theme btn-wd btn-block' name='test' value='Probar conexión' id="testMySQL"/>
					                                </div>
			                                	</div>
			                                </div>
			                                <div class="col-sm-12" id="no-connection-message-2" style="display: none;">
				                            	<h5 class="text-center">No se pudo establecer una conexión con la base de datos</h5>
			                                </div>

			                                <div class="col-sm-12" style="display: none;" id="download-btn-div">
			                                	<a href="#" id="sql-anchor"></a>
				                                	<div class="col-sm-4 col-md-offset-4">
						                            	<div class="text-center"  data-toggle="wizard-radio" rel="tooltip" title="Éste archivo contiene la estructura de la información que usa CotiSAP. Deberás importarlo en la base de datos que pusiste. Preferentemente debe estar vacía, para evitar conflictos con nombres de recursos">
						                                	<input type='button' class='btn btn-fill btn-theme btn-wd btn-block' name='test' value='Descargar .SQL' id="download-btn"/>
						                                </div>
				                                	</div>
			                                </div>
			                                <div class="col-sm-12" id="mysql-loader" style="display: none;">
			                                	<div class="col-sm-4 col-md-offset-4 text-center">
			                                		<img src="{{asset('assets/img/loading4.gif')}}"/>
			                                	</div>
		                                	</div>
										</div>
		                            </div>
		                            <div class="tab-pane" id="end">
		                            	<div class="row">
		                            		<h3 class="text-center">Revisa los datos antes de crear la empresa </h3>
		                            		<h5 class="text-left" style="padding-left: 20px;padding-right: 20px;">Datos de la empresa</h5>
		                            		<div class="col-md-12">
			                            		<div class="col-sm-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">business</i>
														</span>
														<div class="form-group ">
				                                          <label class="control-label">Nombre</label>
				                                          <input id="name_prev" class="form-control" disabled="disabled">
				                                        </div>
													</div>

													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">find_in_page</i>
														</span>
														<div class="form-group ">
														  <label class="control-label">Dominio</label>
														  <input  type="text" id="domain_prev" class="form-control" disabled="disabled">
														</div>
													</div>
			                                	</div>
			                                	<div class="col-sm-6">
			                                    	<div class="picture-container">
			                                        	<div class="picture" style="width: 80px !important;height:80px !important">
	                                        				<img src="" class="picture-src" id="logo_prev" title=""/>
			                                        	</div>
			                                    	</div>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">insert_photo</i>
														</span>
														<div class="form-group ">
														  <label class="control-label">URL de logo</label>
														  <input name="urllogo" id="urllogo_prev" type="text" class="form-control" disabled="disabled">
														</div>
													</div>
			                                	</div>
			                                </div>
		                            		<h5 class="text-left" style="padding-left: 20px;padding-right: 20px;">Accesos a SAP</h5>
		                            		<div class="col-sm-12">
			                                	<div class="col-sm-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">business</i>
														</span>
														<div class="form-group ">
				                                          <label class="control-label">Host</label>
				                                          <input id="sap_host_prev" type="text" class="form-control" disabled="disabled">
				                                        </div>
													</div>

													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">person</i>
														</span>
														<div class="form-group ">
														  <label class="control-label">Usuario</label>
														  <input id="sap_user_prev" type="text" class="form-control" disabled="disabled">
														</div>
													</div>
												</div>
			                                	<div class="col-sm-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">assignment</i>
														</span>
														<div class="form-group ">
														  <label class="control-label">Nombre de la base de datos</label>
														  <input id="sap_dbname_prev" type="text" class="form-control" disabled="disabled">
														</div>
													</div>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">lock</i>
														</span>
														<div class="form-group ">
				                                          <label class="control-label">Contraseña</label>
				                                          <input  id="sap_psw_prev" type="text" class="form-control" disabled="disabled">
				                                        </div>
													</div>
												</div>
		                            		</div>
		                            		<h5 class="text-left" id="mysql_prev_title" style="padding-left: 20px;padding-right: 20px;">Accesos a MySQL (<span id="tipo"></span>)</h5>
		                            		<div class="col-sm-12"  id="mysql_prev">
			                                	<div class="col-sm-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">business</i>
														</span>
														<div class="form-group ">
				                                          <label class="control-label">Host</label>
				                                          <input id="mysql_host_prev" type="text" class="form-control" disabled="disabled">
				                                        </div>
													</div>

													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">person</i>
														</span>
														<div class="form-group ">
														  <label class="control-label">Usuario</label>
														  <input id="mysql_user_prev" type="text" class="form-control" disabled="disabled">
														</div>
													</div>
												</div>
			                                	<div class="col-sm-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">assignment</i>
														</span>
														<div class="form-group ">
														  <label class="control-label">Nombre de la base de datos</label>
														  <input id="mysql_dbname_prev" type="text" class="form-control" disabled="disabled">
														</div>
													</div>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">lock</i>
														</span>
														<div class="form-group ">
				                                          <label class="control-label">Contraseña</label>
				                                          <input  id="mysql_psw_prev" type="text" class="form-control" disabled="disabled">
				                                        </div>
													</div>
												</div>
		                            		</div>
		                            	</div>
		                            </div>
		                        </div>
		                        <div class="wizard-footer">
		                            <div class="pull-right">
		                                <input type='button' class='btn btn-next btn-fill btn-theme btn-wd' name='next' value='Siguiente' id="nextBtn" />
		                                <input type='button' class='btn btn-finish btn-fill btn-theme btn-wd' name='finish' value='Crear empresa' id="create" />
			                            <img id="final_loader" style="display: none;" src="{{asset('assets/img/loading4.gif')}}"/>
		                            </div>

		                            <div class="pull-left">
		                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Anterior' />
		                            </div>
		                            <div class="clearfix"></div>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
	        </div>
	    </div>
