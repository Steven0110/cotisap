<div class="row">
	<div class="col-md-3">
		<div class="an-single-component">
			<div class="an-component-header">
				<div class="an-component-header">
					<h6>Buscar por vendedor</h6>
				</div>
			</div>
			<div class="an-component-body">
				<div class="an-helper-block">
					<label for="numPedido">Nombre del vendedor</label>
					<div class="an-input-group">
						<select id="slp" class="an-form-control"></select>
					</div>
					<br/>
					<label for="numPedido">Periodo:</label>
					<div class="row">
						<div class="col-md-12">
							<div class="an-daterange-picker">
				                <div id="reportrange">
				                	<i class="icon-calendar"></i>&nbsp;
				                    <span></span>
				                    <span class="hidden"></span>
				                </div>
				            </div>
						</div>
					</div>
					<br/>
					<div class="an-input-group">
						<input class="an-btn an-btn-success" type="button" id="search" value="Buscar" disabled="disabled">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="an-single-component">
			<div class="an-component-header">
				<div class="an-component-header">
					<h6>Vendedor: <strong id="slpname"></strong></h6>
				</div>
			</div>
			<div class="an-helper-block">
				<table id="progress-table" class="text-center" >
					<thead>
						<tr>
							<th class="text-center">Cotizacion</th>
							<th class="text-center">Fecha</th>
							<th class="text-center">Oferta</th>
							<th class="text-center">Pago</th>
							<th class="text-center">Pedido</th>
							<th class="text-center">En camino</th>
							<th class="text-center">Entrega</th>
							<th class="text-center">Factura</th>
							<th class="text-center">Sigla 03</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<div class="text-center">
					<img id="progress-table-loader" hidden="hidden" src="{{ asset('assets/img/loading3.gif') }}"/>
				</div>
			</div>
		</div>
	</div>
</div>