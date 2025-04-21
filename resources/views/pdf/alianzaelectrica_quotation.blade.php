<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Cotizacion de Alianza</title>
  <style>
  </style>

  <style type="text/css">
    table  {border-collapse:collapse;border-spacing:0;margin-top: 5px;}
    table td{font-family:Helvetica, sans-serif;font-size:9.5px;padding:2px;overflow:hidden;word-break:normal;}
    table th{font-family:Helvetica, sans-serif;font-size:9.5px;padding:2px;overflow:hidden;word-break:normal;}
    table td, table th{border: 1px solid black;}
    hr{height: 1px;border-bottom: 1px solid rgba(230,94,37, 0.9);border-top:none;border-left:none;border-right: none;}
    table td, table th{border: none;}
    footer { text-align: center; position: fixed; width: 800px; bottom: -70px; left: -50px; right: 0px; background: rgba(230,94,37, 0.9); height: 50px; color: white;}
    .articles-header td{border-bottom: 2px solid rgba(230,94,37, 0.9);}
    .left{text-align: left;}
    .right{text-align: right;}
    .center{text-align: center;}
    .justify{text-align: justify;}
    .mini{font-size: 7px;}
    .title{font-size: 10px; font-weight: bold;}
    .uppercase{text-transform: uppercase;}
  </style>
</head>
<body style="padding-right: 500px; padding-left: 10px; margin-left: -30px;">
  <footer>{{ $data['company']->dominio }}</footer>
  <div style="height:200px;">
    <div style="display: inline-block">    
      <table style="width: 480px;">
        <tr>
          <td colspan="4"><img height="50" src="assets/img/alianza-logo.png"></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" class="title">Cliente:</td>
        </tr>
        <tr>
          <td colspan="4" class="uppercase">{{ $data['Cliente'][0][0]->CardName }}</td>
        </tr>
        <tr>
          <td class="title">No. Cliente</td>
          <td class="title">RFC</td>
          <td colspan="2" class="title">Moneda</td>
        </tr>
        <tr>
          <td>{{ $data['Cliente'][0][0]->CardCode }}</td>
          <td>{{ $data['Cliente'][0][0]->LicTradNum }}</td>
          <td colspan="2">MXN</td>
        </tr>
        <tr>
          <td colspan="4" class="title">Domicilio:</td>
        </tr>
        <tr>
          <td colspan="4" rowspan="2" class="uppercase">
            {{ $data['Cliente'][2][0]->fStreet }},
            COL. {{ $data['Cliente'][2][0]->fCol }},
            {{ $data['Cliente'][2][0]->fCity }},
            {{ $data['Cliente'][2][0]->fCity2 }},
            C.P {{ $data['Cliente'][2][0]->fZip }},
            {{ $data['Cliente'][2][0]->fState }},
            {{ $data['Cliente'][2][0]->fCountry }}.
          </td>
        </tr>
      </table>
    </div>

    <div style="display: inline-block">   
      <table style="width: 270px;">
        <tr>
          <td class="right" colspan="2">FO-VTA-02 R0</td>
        </tr>
        <tr>
          <td class="right" colspan="2" style="font-size: 18px;font-weight: bold;padding-bottom: 13px;border-bottom: 2px solid rgba(230,94,37, 0.9);">Cotización #{{ $data['Quotation']->numCotizacion }}</td>
        </tr>
        <tr>
          <td class="title">Fecha de documento:</td>
          <td class="title">Tipo de cambio:</td>
        </tr>
        <tr>
          <td>{{ $data['Quotation']->created_at }}</td>
          <td>20.0</td>
        </tr>
        <tr>
          <td class="title" colspan="2">Vendedor comisionista:</td>
        </tr>
        <tr>
          <td colspan="2" class="uppercase">{{ $data['Vendedor']->name }}</td>
        </tr>
        <tr>
          <td class="title" colspan="2">Email:</td>
        </tr>
        <tr>
          <td colspan="2">{{ $data['Vendedor']->email }}</td>
        </tr>
        <tr>
          <td colspan="2" class="title">Teléfono:</td>
        </tr>
        <tr>
          <td colspan="2">{{ $data['Vendedor']->Telephone }}</td>
        </tr>
      </table>
    </div>
    
  </div>


  <div style="width: 750px;">
  </div>


  <table style="width: 750px;">
    <tr class="center articles-header">
      <td class="title" style="width: 15px;">#</td>
      <td class="title" style="width: 90px;">Código</td>
      <td class="title">Descripción</td>
      <td class="title" style="width: 40px;">Cantidad</td>
      <td class="title" style="width: 60px;">U. Medida</td>
      <td class="title" style="width: 80px;">P. Unitario</td>
      <td class="title" style="width: 80px;">Importe</td>
    </tr>
    @foreach ($data['ArtQuotation'] as $article)
    <tr>
      <td class="center">{{ $loop->iteration }}</td>
      <td class="center">{{ $article->codigoArt }}</td>
      <td class="justify">{{ $article->nombreArt }}</td>
      <td class="center">{{ $article->cantidad }}</td>
      <td class="center">{{ $article->UMV }}</td>
      <td class="center">{{ $article->precioUnidad }}</td>
      <td class="center">{{ $article->subTotalLinea }}</td>
    </tr>
    @endforeach
    <tr>
      <td colspan="5">&nbsp;</td>
      <td colspan="2" class="title center" style="border-bottom: 2px solid rgba(230,94,37, 0.9);">TOTALES (MXN)</td>
    </tr>
    <tr>
      <td colspan="5"></td>
      <td class="title right">IVA:</td>
      <td>16%</td>
    </tr>
    <tr>
      <td colspan="5"></td>
      <td class="title right">Total:</td>
      <td>{{ $data['Quotation']->total }}</td>
    </tr>
  </table>

</body>
</html>