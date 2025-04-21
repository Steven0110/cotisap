<div class="row">
	<div class="col-md-12">
		
		<div class="an-single-component">
			<div class="an-component-header">
				<div class="an-component-header">
					<h6>Entregas</h6>
				</div>
			</div>
			<div class="an-component-body">
				<div class="an-helper-block">
					<table id="report">
						<thead>
							<tr>
								<th>Vendedor</th>
								<th>Folio entrega</th>
								<th>Folio transacción</th>
								<th>Fecha</th>
								<th>Monto</th>
								<th></th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							@foreach( $report as $slp )
								@foreach( $slp['info'] as $delivery )
								<tr>
									<td>{{$slp['name']}}</td>
									<td>{{$delivery['docNum']}}</td>
									<td>{{$delivery['folio']}}</td>
									<td>{{$delivery['date']}}</td>
									<td>${{$delivery['total']}}</td>
									<td><a target="_blank" href="{{ URL::route('buscar-entrega') }}?id={{$delivery['docNum']}}">Ver <img height="15" src="{{asset('assets/img/search.png')}}"></a></td>
									<td style="background-color: rgba(142,218,255, 0.3);font-size: 20px;">${{$slp['final_total']}}</td>
								</tr>
								@endforeach
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>