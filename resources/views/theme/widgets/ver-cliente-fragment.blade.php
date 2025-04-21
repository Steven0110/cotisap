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
					<label for="client">Nombre o código de cliente: </label> <img id="data-loader" style="width: 20px;display: none;" src="{{asset('assets/img/loading.gif')}}">
					<div class="an-input-group">
						<div class="an-input-group-addon">
							<i></i>
						</div>
						<select type="text" id="client" class="an-form-control" name="client"></select>
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
				<h6>Cliente #<strong id="code"></strong></h6>
			</div>

			<div class="an-component-body">
				<div class="an-helper-block">
					<h5>Información general</h5>
					<div class="row">
						<div class="col-md-6">
							<label for="name">{{ 'Nombre' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="name" class="an-form-control" name="name"/>
							</div>
						</div>
						<div class="col-md-6">
							<label for="rfc">{{ 'RFC' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="rfc" class="an-form-control" name="rfc"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label for="">{{ 'Teléfono' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="phone" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-6">
							<label for="">{{ 'Email' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="email" class="an-form-control" name="rfc"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label for="">{{ 'Website' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="website" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-4">
							<label for="">{{ 'Tipo de persona' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="person" class="an-form-control"/>
							</div>
						</div>
					</div>
					<h5>Persona de contacto</h5>
					<div class="row">
						<div class="col-md-6">
							<label for="">{{ 'Nombre' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="cname" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-6">
							<label for="">{{ 'Teléfono' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="cphone" class="an-form-control" name="rfc"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label for="">{{ 'Email' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="cemail" class="an-form-control"/>
							</div>
						</div>
					</div>
					<h5>Dirección fiscal</h5>
					<div class="row">
						<div class="col-md-4">
							<label for="">{{ 'Calle y número' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="street" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-4">
							<label for="">{{ 'Colonia' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="suburb" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-4">
							<label for="">{{ 'Ciudad' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="city" class="an-form-control"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label for="">{{ 'Municipio / Delegación' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="del_mun" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-4">
							<label for="">{{ 'Estado' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="state" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-4">
							<label for="">{{ 'País' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="country" class="an-form-control"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label for="">{{ 'Código Postal' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="cp" class="an-form-control"/>
							</div>
						</div>
					</div>
					<h5>Dirección de envío</h5>
					<div class="row">
						<div class="col-md-4">
							<label for="">{{ 'Calle y número' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="sstreet" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-4">
							<label for="">{{ 'Colonia' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="ssuburb" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-4">
							<label for="">{{ 'Ciudad' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="scity" class="an-form-control"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label for="">{{ 'Municipio / Delegación' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="sdel_mun" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-4">
							<label for="">{{ 'Estado' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="sstate" class="an-form-control"/>
							</div>
						</div>
						<div class="col-md-4">
							<label for="">{{ 'País' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="scountry" class="an-form-control"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label for="">{{ 'Código Postal' }}: </label>
							<div class="an-input-group">  
								<div class="an-input-group-addon"><i></i></div>
								<input type="text" id="scp" class="an-form-control"/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>