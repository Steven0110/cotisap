<div class="row">
	<div class="col-md-4">
		<div class="an-single-component">
			<div class="an-component-header">
				<div class="an-component-header">
					<h6>Buscar por vendedor/es</h6>
				</div>
			</div>
			<div class="an-component-body">
				<div class="an-helper-block">
					<label>Selecciona uno o varios vendedores:</label>
					<img id="slp-loader" height="20" src="{{ asset('assets/img/loading.gif') }}"/>
					<div class="an-input-group" id="slp-container" style="display: none;">
						<select multiple="multiple" id="slp" name="slp">
					        <optgroup label="activos">
					        </optgroup>
					        <optgroup label="inactivos">
					        </optgroup>
					    </select>
					</div>
					<br/>
					<div class="an-input-group">
						<input id="orders-button" class="btn-block an-btn an-btn-success" type="button" disabled="disabled" value="Ver pedidos">
					</div>
					<br/>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="an-single-component">
			<div class="an-component-header">
				<div class="an-component-header">
					<h6>Reporte de pedidos</h6>
				</div>
			</div>
			<div class="an-helper-block">
				<table id="orders-table" class="text-center" >
					<thead>
						<tr>
							<th class="text-center">Vendedor</th>
							<th class="text-center">Folio</th>
							<th class="text-center">Fecha</th>
							<th class="text-center">Cliente</th>
							<th class="text-center">Monto total</th>
							<th class="text-center">Monto</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<div class="text-center">
					<img id="table-loader" style="position: absolute;top:-50px;right:30%;display: none;" src="{{ asset('assets/img/loading3.gif') }}"/>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4"></div>
	<div class="col-md-8">
		<div class="an-single-component">
			<div class="an-component-header">
				<div class="an-component-header">
					<h6>Total por vendedor</h6>
				</div>
			</div>
			<div class="an-helper-block">
				<table id="total-table" class="text-center" >
					<thead>
						<tr>
							<th class="text-center">Vendedor</th>
							<th class="text-center">Monto</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<div class="text-center">
					<img id="total-loader" style="position: absolute;top:-50px;right:30%;display: none;" src="{{ asset('assets/img/loading3.gif') }}"/>
				</div>
			</div>
		</div>
	</div>
</div>