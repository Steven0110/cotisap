<div class="row">
	<div class="col-md-4">
		<div class="an-single-component">
			<div class="an-component-header">
				<div class="an-component-header">
					<h6>Buscar por nombre o código</h6>
				</div>
			</div>
			<div class="an-component-body">
				<div class="an-helper-block">
					<label>Nombre o código del artículo: </label> <img id="data-loader" style="width: 20px;display: none;" src="{{asset('assets/img/loading.gif')}}">
					<div class="an-input-group">
						<div class="an-input-group-addon">
							<i></i>
						</div>
						<select type="text" id="article" class="an-form-control"></select>
					</div>
					<br/>
					<div class="an-input-group">
						<input class="an-btn an-btn-success" id="search-button" type="button" value="Buscar"/>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="an-single-component">
			<div class="an-component-header">
				<h6>Ínformación general del artículo #<strong id="code"></strong></h6>
			</div>
			<div class="an-component-body">
				<div class="an-helper-block">
					<div class="row">
						<div class="col-md-12">
							<label for="name">{{ 'Descripción' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="desc" class="an-form-control"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<label for="clase">{{ 'Clase' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="class" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-3">
							<label for="clase">{{ 'Grupo' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="group" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-3">
							<label for="name">{{ 'Lista' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="list" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-3">
							<label for="clase">{{ 'UMV' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="umv" class="an-form-control"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<label for="clase">{{ 'Precio' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="price" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-3">
							<label for="clase">{{ 'Moneda' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="currency" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-6">
							<label>{{ 'Estatus' }}: </label>

							<div class="an-input-group">  
								<span id="status" class='msg-tag'></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>