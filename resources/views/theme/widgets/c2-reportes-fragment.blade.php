<div class="row">
	<div class="col-md-12">
		
		<div class="an-single-component">
			<div class="an-component-header">
				<div class="an-component-header">
					<h6>Comisiones estimadas</h6>
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
								<th>No. Documento</th>
								<th>Fecha documento</th>
								<th>Límite de pago</th>
								<th>Vencimiento de comisión</th>
								<th>Total doc.</th>
								<th>Total (${{$slp['total_slp']}})</th>
								<th>Subtotal doc.</th>
								<th>Subtotal (${{$slp['subtotal_slp']}})</th>
								<th>Comisión doc.</th>
								<th>Comisión (${{$slp['comision_slp']}})</th>
								<th>Comisión vencida doc.</th>
								<th>Comisión vencida (${{$slp['half_comision_slp']}})</th>
							</tr>
						</thead>
						<tbody>
							@foreach($slp['documents'] as $document )
							<tr>
								<td>{{$document['cardname']}}</td>
								<td>{{$document['docnum']}}</td>
								<td>{{$document['date']}}</td>
								<td>{{$document['limit']}}</td>
								<td>{{$document['due']}}</td>
								<td>${{$document['total_doc']}}</td>
								<td style="background-color: rgba(142,218,255, 0.3);font-size: 16px;"><strong>
									${{$document['total']}}</strong></td>
								<td>${{$document['subtotal_doc']}}</td>
								<td style="background-color: rgba(142,218,255, 0.3);font-size: 16px;"><strong>${{$document['subtotal']}}</strong></td>
								<td>${{$document['commision_doc']}}</td>
								<td style="background-color: rgba(142,218,255, 0.3);font-size: 16px;"><strong>${{$document['commision']}}</strong></td>
								<td>${{$document['due_commision_doc']}}</td>
								<td style="background-color: rgba(142,218,255, 0.3);font-size: 16px;"><strong>${{$document['half_commision']}}</strong></td>
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