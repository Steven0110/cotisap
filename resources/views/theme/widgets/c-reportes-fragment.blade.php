<div class="row">
	<div class="col-md-12">
		
		<div class="an-single-component">
			<div class="an-component-header">
				<div class="an-component-header">
					<h6>Resumen de comisiones</h6>
				</div>
			</div>
			<div class="an-component-body">
				@foreach($salesperson as $slp)
				<div class="an-helper-block">
					<hr/>
					<h4>{{$slp['name']}}</h4>
					<table class="compact hover">
						<thead>
							<tr>
								<th>SN</th>
								<th>Transacción</th>
								<th>No. Pago</th>
								<th>Fecha documento</th>
								<th>Vencimiento</th>
								<th>Total doc.</th>
								<th>Total (${{$slp['total_slp']}})</th>
								<th>Subtotal doc.</th>
								<th>Subtotal (${{$slp['subtotal_slp']}})</th>
								<th>Comisión doc.</th>
								<th>Comisión (${{$slp['comision_slp']}})</th>
							</tr>
						</thead>
						<tbody>
							@foreach($slp['documents'] as $document )
							<tr>
								<td>{{$document['name']}}</td>
								<td>{{$document['transaccion']}}</td>
								<td>{{$document['no_pago']}}</td>
								<td>{{$document['fecha_doc']}}</td>
								<td>{{$document['fecha_vencimiento']}}</td>
								<td>${{$document['total']}}</td>
								<td style="background-color: rgba(142,218,255, 0.3);font-size: 16px;"><strong>
									${{$document['total_doc']}}</strong></td>
								<td>${{$document['subtotal']}}</td>
								<td style="background-color: rgba(142,218,255, 0.3);font-size: 16px;"><strong>${{$document['subtotal_doc']}}</strong></td>
								<td>${{$document['comision']}}</td>
								<td style="background-color: rgba(142,218,255, 0.3);font-size: 16px;"><strong>${{$document['com_doc']}}</strong></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>