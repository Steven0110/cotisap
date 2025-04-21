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
						<input id="resume-button" class="btn-block an-btn an-btn-success" type="button" value="Resumen de comisiones">
					</div>
					<br/>
					<div class="an-input-group">
						<input id="estimate-button" class="btn-block an-btn an-btn-success" type="button" value="Comisiones estimadas">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>