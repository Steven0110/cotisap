
<!DOCTYPE html>
<html>
<head>
	<title>Cotización | MBR HOSTING</title>
	<style type="text/css">
		
		*, table {
			font-family: Arial, Helvetica, sans-serif;
		}

		table {
			width: 100%;
		}

		table tr td {
    		vertical-align: top;
		}

		#detalle{
			font-size: 7px;
		}
		
		.text1{
			font-size: 8px;
		}

		.text2{
			font-size: 6px;
		}

		#folio{
			color: red;
			font-size: 12px;
		}

		#detalle tr:nth-child(even) {
  			background: #c5d9f1;
		}
		#detalle tr:last-child{
			background: white !important;
		}
 
		#detalle th, .table-general th{
  			border-bottom: 2px solid #538dd5;
		}  
		
		#detalle tr td {
  		  vertical-align: middle;
		}

		body {
			background-image: url(http://localhost/cotisap/public/assets/img/background.jpg);
    		background-size: 100px;
    		background-repeat: no-repeat;
    		background-position: bottom;
		}

	</style>
</head>
<body>

<table>
  <tr>
    <td>			
    	<img width="90" src="http://account.cotisap.com/assets/img/logogrupo.png"><br><br>
			{{$data['Cliente'][0][0]->CardName}} <br>
	</td>
    <td>
    	&nbsp;
    </td>
    <td>
    	<font size="1">
    	México, D. F. -  {!! substr($data['Quotation']->updated_at, 0, 10) !!}
    	</font>
    </td>
    <td colspan="2">
    	<span id="folio">
    		Folio: {{$data['Quotation']->numCotizacion}}
    	</span>
    </td>
  </tr>
  <tr>
  	<td colspan="5">
  		<p class="text1">
  			Atendiendo a su solicitud, pongo a su consideración la siguiente propuesta, la cual incluye las características técnicas así como las condiciones comerciales de nuestra empresa.
  		</p>
  	</td>
  </tr>
</table>

<!-- Detalle de productos -->

<table id="detalle">
	<thead>
		<tr>
			<th>
				N°. Parte
			</th>
			<th>
				Descripción
			</th>
			
			<th>
				Cantidad
			</th>
			<th>
				P. Lista
			</th>
			<th>
				Desc
			</th>
			<th>
				P.Unitario
			</th>
			<th>
				Subtotal
			</th>
			<th>
				IVA 16%
			</th>
			<th>
				Total Por producto
			</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data['Articles'] as $a)
		<tr>
			
			<td>
				{{$a['codigo']}}
			</td>
			<td>
				{{$a['nombre']}}
			</td>
			<td>
				{{$a['cantidad']}}
			</td>
			<td>
				$ {{$a['precio_lista']}}
			</td>
			<td>
				{{$a['descuento']}}%
			</td>
			<td>
				$ {{$a['precio_unitario']}}
			</td>
			<td>
				$ {{$a['subtotal']}}
			</td>
			<td>
				$ {{$a['iva']}}
			</td>
			<td>
				$ {{$a['total_mxn']}}
			</td>
		</tr>
		@endforeach
	
		<tr>
			<td colspan="5">
				
			</td>
			<td colspan="3">
				INVERSIÓN TOTAL EN {{ $data['Moneda'] }}
			</td>
			<td>
				$ {{$data['Totals']['MXN']}} {{ $data['Moneda'] }}
			</td>
		</tr>
	</tbody>
</table>

<!-- Conciones y notas comerciales aviso -->

<p class="text2">
	*** Checar condiciones y notas comerciales
</p>

<br>

<!-- Notas comerciales -->

<table class="text1 table-general">
	<thead>
		<tr>
			<th>
				Notas comerciales
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				{!!$data['Notes']->condiciones!!}
			</td>
		</tr>
	</tbody>
</table>
<!--Condiciones comerciales-->
<br/>
@foreach($data['Specs'] as $key => $spec_type)
	@if(count($spec_type) === 0)
		@continue
	@endif
	<table class="text1 table-general">
		<thead>
			<tr>
				<th>
					{{$key}}
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach($spec_type as $spec)
			<tr>
				<td>
					{{$spec->descripcion}}				
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@endforeach

<br>
<br>

</body>
</html>