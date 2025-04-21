<div class="row">
	<div class="col-md-4">
		<div class="an-single-component">
			<div class="an-component-header">
				<div class="an-component-header">
					<h6>Buscar por número de factura</h6>
				</div>
			</div>
			<div class="an-component-body">
				<div class="an-helper-block">
					<label for="numPedido">Número de factura</label>
					<div class="an-input-group">
						<select type="text" id="numPedido" class="an-form-control" name="numPedido"></select>
					</div>
					<br>
					<div class="an-input-group">
						<input id="search-button" class="an-btn an-btn-success" type="button" value="Buscar">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		
		<div class="an-single-component">
			<div class="an-component-header">
				<div class="an-component-header">
					<h6>Factura <strong>#<span id="fact-num"></span></strong></h6>
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
							<label>Fecha de vencimiento:</label>
							<div class="an-input-group">
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" name="expiration" id="expiration" class="an-form-control" disabled="disabled"/>
							</div>			
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label>Número de documento electrónico:</label>
							<div class="an-input-group">
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" name="doc-num" id="doc-num" class="an-form-control" disabled="disabled"/>
							</div>			
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<h6 class="">ARTICULOS:</h6>
							<img id="invoice-table-loader" hidden="hidden" src="{{ asset('assets/img/loading3.gif') }}"/>
							<table id="invoice-table"></table>
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
                				<button type="button" id="pdf-button" class="an-btn an-btn-primary btn-block block-icon"><i class="ion-document"></i>{{ 'PDF' }}</button>
                			</div>
							<div class="col-md-3 text-center">
                				<button type="button" id="xml-button" class="an-btn an-btn-primary btn-block block-icon"><i class="ion-ios-list-outline"></i>{{ 'XML' }}</button>
                			</div>
							<div class="col-md-3 text-center">
                				<button type="button" id="send-button" class="an-btn an-btn-success btn-block block-icon"><i class="ion-ios-email-outline"></i>{{ 'Enviar' }}</button>
                			</div>
							<div class="col-md-3 text-center">
                				<button type="button" id="save-button" class="an-btn an-btn-success btn-block block-icon"><i class="ion-ios-download-outline" disabled="disabled"></i>{{ 'Guardar' }}</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>