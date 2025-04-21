
<!DOCTYPE html>
<html>
<head>
	<title>Cotización | Nutriservicios</title>
	<style type="text/css">
		html, body{
			margin: 10px;
			margin-top: 20px;
			box-sizing: border-box;
		}
		*, table {
			font-family: Arial, Helvetica, sans-serif;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		table tr td {
    		vertical-align: top;
		}

		table.bordered tr td {
    		border: 1px solid rgba(211, 101, 4, 0.4);
		}

		/*Estilos de Nutriservicios*/
		.logo{
			text-align: center;
			width: 20%;
		}
		.logo img{
			width: 90px;
			margin-top: 0px;
			margin-bottom: 0px;
			display: inline-block;
		}
		.label{
			background-color: #e56c02;
			color: white;
			font-size: 0.7em;
			font-weight: bold;
			text-align: center;
		}
		.quotation-detail .label{
			font-size: 0.6em;
		}
		.field{
			text-align: center;
			background-color: white;
			color: black;
			font-size: 0.7em;
		}
		.quotation-detail .field{
			font-size: 0.5em;
		}
		h5{
			margin-top: 5px;
			margin-bottom: 5px;
		}
		.small-text p{
			font-size: 0.65em;
			margin-top: 0px;
			margin-bottom: 0px;
		}
		.xs{
			font-size: 0.4em;
		}
		.center{
			text-align: center;
		}
		.left{
			text-align: left;
			padding-left: 10px;
		}
		.v-align{
			vertical-align: middle;
		}

		/*	Column Grid  */
		.col-2{
			width: 50%;
		}
		.col-6{
			width: 16.66667%;
		}

	</style>
</head>
<body>

<!-- Header -->
<table>
	<tr>
		<td class="logo v-align" rowspan="5">
			<img src="https://secure.porcicultura.com/autores/Autor_5947e9aaefed5_19062017.PNG" class="v-align" alt=""/>
		</td>
		<td rowspan="5" class="small-text col-2 center v-align">
			<h5>PRUEBAS - NS EQUIPO E IMPLEMENTOS SA DE CV</h5>
			<p>R.F.C. NEE120227DF4</p>
			<p>Antiguo Camino A La Resurreccion No.10428 Int. Bodega 77</p>
			<p>Col. Parque Industrial Resurreccion, Puebla, Puebla, Mexico</p>
			<p>C.P. 72228</p>
		</td>
		<td class=""></td>
	</tr>
	<tr>
		<td class="label v-align">Cotización</td>
	</tr>
	<tr>
		<td class="field v-align">{{$data['Quotation']->numCotizacion}}</td>
	</tr>
	<tr>
		<td class="label v-align">Fecha</td>
	</tr>
	<tr>
		<td class="field v-align">{{$data['Quotation']->created_at}}</td>
	</tr>
</table>

<h5>Datos de cliente</h5>

<table class="bordered">
	<tr>
		<td class="label v-align">Nombre</td>
		<td class="label v-align">Código</td>
		<td class="label v-align">RFC</td>
		<td class="label v-align">Teléfono</td>
		<td class="label v-align">Email</td>
	</tr>
	<tr>
		<td class="field v-align">{{$data['Cliente'][0][0]->CardName}}</td>
		<td class="field v-align">{{$data['Cliente'][0][0]->CardCode}}</td>
		<td class="field v-align">{{$data['Cliente'][0][0]->LicTradNum}}</td>
		<td class="field v-align">{{$data['Cliente'][0][0]->Phone1}}</td>
		<td class="field v-align">{{$data['Cliente'][0][0]->E_Mail}}</td>
	</tr>
	<tr>
		<td class="label v-align">Calle</td>
		<td class="label v-align">Colonia</td>
		<td class="label v-align">Estado</td>
		<td class="label v-align">País</td>
		<td class="label v-align">CP</td>
	</tr>
	<tr>
		<td class="field v-align">{{$data['Cliente'][2][0]->fStreet}}</td>
		<td class="field v-align">{{$data['Cliente'][2][0]->fCol}}</td>
		<td class="field v-align">{{$data['Cliente'][2][0]->fState}}</td>
		<td class="field v-align">{{$data['Cliente'][2][0]->fCountry}}</td>
		<td class="field v-align">{{$data['Cliente'][2][0]->fZip}}</td>
	</tr>
</table>

<h5>Datos de cotización</h5>

<!-- Detalle de productos -->
<table class="quotation-detail bordered">
		<tr>
			<td class="label">
				Descripción
			</td>
			<td class="label">
				N°. Parte
			</td>
			<td class="label">
				Cantidad
			</td>
			<td class="label">
				P. Lista
			</td>
			<td class="label">
				Desc
			</td>
			<td class="label">
				P.Unitario
			</td>
			<td class="label">
				Subtotal
			</td>
			<td class="label">
				IVA 16%
			</td>
			<td class="label">
				Total Por producto
			</td>
		</tr>
		@foreach($data['Articles'] as $a)
		<tr>
			<td class="field v-align">
				<b>{{$a['codigo']}}</b> => {{$a['nombre']}}
			</td>
			<td class="field v-align">
				{{$a['codigo']}}
			</td>
			<td class="field v-align">
				{{$a['cantidad']}}
			</td>
			<td class="field v-align">
				$ {{$a['precio_lista']}}
			</td>
			<td class="field v-align">
				{{$a['descuento']}}%
			</td>
			<td class="field v-align">
				$ {{$a['precio_unitario']}}
			</td>
			<td class="field v-align">
				$ {{$a['subtotal']}}
			</td>
			<td class="field v-align">
				$ {{$a['iva']}}
			</td>
			<td class="field v-align">
				$ {{$a['total_mxn']}}
			</td>
		</tr>
		@endforeach
	
		<tr>
			<td class="field v-align" colspan="5">
				
			</td>
			<td class="field v-align" colspan="3">
				<strong>INVERSIÓN TOTAL EN {{ $data['Moneda'] }}</strong>
			</td>
			<td class="field v-align">
				<strong>$ {{$data['Totals']['MXN']}} {{ $data['Moneda'] }}</strong>
			</td>
		</tr>
</table>

<!-- Conciones y notas comerciales aviso -->
<br>

<table class="bordered">
	<tr>
		<td class="col-6 label">Comentarios:</td>
		<td class="field left">{{$data['Quotation']->comentarios}}</td>
	</tr>
</table>

<p class="xs">
	*** Checar condiciones y notas comerciales
</p>

<br>
<!-- Notas comerciales -->

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