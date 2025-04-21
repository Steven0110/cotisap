<div class="row">
	<div class="col-md-4">
		<div class="an-single-component">
			<div class="an-component-header">
				<div class="an-component-header">
					<h6>Buscar por número de entrega</h6>
				</div>
			</div>
			<div class="an-component-body">
				<div class="an-helper-block">
					<label for="numPedido">Número de entrega</label>
					<div class="an-input-group">
						<select type="text" id="num" class="an-form-control" name="num"></select>
					</div>
					<br>
					<div class="an-input-group">
						<input id="search-button" class="an-btn an-btn-success" type="button" value="Buscar">
					</div>
				</div>
			</div>
		</div>
		<div class="an-single-component">
			<div class="an-component-header">
				<div class="an-component-header">
					<h6>Buscar por vendedor/es</h6>
				</div>
			</div>
			<div class="an-component-body">
				<div class="an-helper-block">
					<label for="numPedido">Selecciona uno o varios vendedores:</label>
					<img id="slp-loader" height="20" src="{{ asset('assets/img/loading.gif') }}"/>
					<div class="an-input-group" id="slp-container" style="display: none;">
						<select multiple="multiple" id="slp" name="slp">
					        <optgroup label="activos">
					        </optgroup>
					        <optgroup label="inactivos">
					        </optgroup>
					    </select>
					</div>
					<br>
					<div class="an-input-group">
						<input id="search-slp-button" disabled="disabled" class="an-btn an-btn-success" type="button" value="Generar reporte">
						<img id="report-loader" class="hidden" height="20" src="{{ asset('assets/img/loading.gif') }}"/>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		
		<div class="an-single-component">
			<div class="an-component-header">
				<div class="an-component-header">
					<h6>Entrega <strong>#<span id="dlv-num"></span></strong></h6>
				</div>
			</div>
			<div class="an-component-body">
					
				<div class="an-helper-block">
					<div class="row">
						<div class="col-md-4">
							<label>Folio de referencia:</label>
							<div class="an-input-group">
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" name="folio" id="folio" class="an-form-control" disabled="disabled" />
							</div>			
						</div>
						<div class="col-md-4">
							<label>Fecha de documento:</label>
							<div class="an-input-group">
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" name="doc-date" id="doc-date" class="an-form-control" disabled="disabled" />
							</div>			
						</div>
						<div class="col-md-4">
							<label>Fecha de entrega:</label>
							<div class="an-input-group">
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" name="deliver" id="deliver" class="an-form-control" disabled="disabled"/>
							</div>			
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<label>Cliente:</label>
							<div class="an-input-group">
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" name="client" id="client" class="an-form-control" disabled="disabled"/>
							</div>			
						</div>
						<div class="col-md-4">
							<label>Status:</label>
							<div class="an-input-group">
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" name="status" id="status" class="an-form-control" disabled="disabled"/>
							</div>			
						</div>
					</div>
					<div class="an-component-header">
							<h6>Datos de entrega</h6>
					</div>
					<br/>
					<div class="row">
						<div class="col-md-4">
							<label>Persona que recoge:</label>
							<div class="an-input-group">
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" name="person" id="person" class="an-form-control" disabled="disabled"/>
							</div>			
						</div>
						<div class="col-md-4">
							<label>Teléfono:</label>
							<div class="an-input-group">
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" name="tel" id="tel" class="an-form-control" disabled="disabled"/>
							</div>			
						</div>
						<div class="col-md-4">
							<label>Identificacion:</label>
							<div class="an-input-group">
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" name="ID" id="ID" class="an-form-control" disabled="disabled"/>
							</div>			
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h6>Comentario de quien entrega:</h6>
							<textarea id="com-dev" class=".an-form-control" rows="6" disabled="disabled" style="width:100%;"></textarea>
							<p></p>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 text-center">
							<h6 class="">ARTICULOS:</h6>
							<img id="deliver-table-loader" hidden="hidden" src="{{ asset('assets/img/loading3.gif') }}"/>
							<table id="deliver-table"></table>
						</div>
						<br/>
					</div>
					<div class="row">
						<div class="col-md-5 col-md-offset-7">
							<div class="col-md-6 text-right">
								<br/>
								<p><br></p>
								<p>Subtotal MXN:</p>
								<p>IVA MXN:</p>
								<p><strong>Total MXN:</strong></p>
							</div>
							<div class="col-md-6 text-right">
								<br/>
								<p><strong >Total MXN</strong></p>
								<p><span id="sub">0.00</span></p>
								<p><span id="iva">0.00</span></p>
								<p><strong id="total">$0.00</strong></p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h6>Comentarios:</h6>
							<textarea id="com" class=".an-form-control" rows="6" disabled="disabled" style="width:100%;"></textarea>
							<p></p>
						</div>

						<div class="col-md-12 btn-space">
							<div class="col-md-3 text-center">
                				<button type="button" id="return-button" class="an-btn an-btn-danger btn-block block-icon"><i class="ion-arrow-return-left"></i>{{ 'Regresar' }}</button>
                			</div>
                		</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>