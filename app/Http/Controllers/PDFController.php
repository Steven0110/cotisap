<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use PDF;
use Blade;
use App\User;
use App\ArtQuotation;
use App\Quotation;
use App\Template;
use App\Company;
use App\Notes;
use App\Spec;
use App\SpecsType;
use App\Lib\Libraries as Lib;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Illuminate\View\Compilers\BladeCompiler as LaravelBladeCompiler;

class PDFController extends Controller
{

    protected $cotizacionController;

    public function __construct(){

    }

    public function pdfQuotation($numCotizacion){

        $Quotation = Quotation::where('numCotizacion', $numCotizacion)->first();
        $ArtQuotation = ArtQuotation::where('numCotizacion', $numCotizacion)->get();
        $Vendedor = User::where('email', $Quotation->idVendedor)->first();   
        $Notes = Notes::find($Quotation->notasCotizacion);

        $rowArts = [];
        //$usd_Rate = self::getUSDRate();
        $total_cotizacion_usd = 0;
        $total_cotizacion_mxn = 0;


        foreach($ArtQuotation as $aq){
          $aux_descuento = empty($aq->desc) ? 0.0 : floatval($aq->desc);
          $aux_pu = $aq->PrecioVenta;
          $aux_iva = $aux_pu * $aq->factor / 100 * $aq->cantidad;
          $aux_subtotal = $aux_pu * intval($aq->cantidad);
          $aux_total = $aux_subtotal + $aux_iva;
          $aux_total_mxn = $aux_total;
          //$aux_total_usd = $aq->moneda == 'MXN' ? $aux_total / $usd_Rate : $aux_total;

          $total_cotizacion_mxn += $aux_total_mxn;
          //$total_cotizacion_usd += $aux_total_usd;

          $rowArts[] = 
            [
              'codigo' => $aq->codigoArt,
              'nombre' => $aq->nombreArt,
              'cantidad' => $aq->cantidad,
              'precio_lista' => number_format($aq->precioLista, 2, '.', ','),
              'descuento' => number_format($aux_descuento, 2, '.', ','),
              'precio_unitario' => number_format($aux_pu, 2, '.', ','),
              'subtotal' => number_format($aux_subtotal, 2, '.', ','),
              'iva' => number_format($aux_iva, 2, '.', ','),
              'total_mxn' => number_format($aux_total_mxn, 2, '.', ','),
              //'total_dolares' => number_format($aux_total_usd, 2, '.', ',')
            ];
        }
        $email = Auth::user()->email;

        $company = Company::where('dominio' ,explode('@', $email)[1])
                        ->get();


        /*Especificaciones*/
        $spectypes = SpecsType::all();
        if (!strcmp($Quotation->especificaciones, 'null') || $Quotation->especificaciones == null){
            $specs_json = [];
        } else {
            $specs_json = json_decode($Quotation->especificaciones);
        }

        /*Define Types Array*/
        $types_aux = [];
        foreach($spectypes as $type)
          $types_aux []= $type->name;

        /*Initialise arrays in array*/
        $types = [];
        foreach($types_aux as $e){
          $types[$e] = [];
        }

        foreach ($specs_json as $spec) {
            $aux = Spec::find($spec);
            switch($aux->tipo){
              case 0:
              $types['Condiciones comerciales'] []= $aux;
                break;
              case 1:
              $types['Consideraciones especiales'] []= $aux;
                break;
              case 2:
              $types['Factores a considerar'] []= $aux;
                break;
              case 3:
              $types['Entrega Express'] []= $aux;
                break;
              case 4:
              $types['Viáticos de consultores'] []= $aux;
                break;
              case 5:
              $types['Alcance de implementación'] []= $aux;
                break;
              case 6:
              $types['Otra'] []= $aux;
                break;
            }
          }

        $data = [
            'Quotation' => $Quotation,
            'Cliente' => self::getClienteData( $Quotation->numCliente ),
            'ArtQuotation' => $ArtQuotation,
            'Vendedor' => $Vendedor,
            'company' => $company,
            'Articles' => $rowArts,
            'Moneda' => $Quotation->Moneda,
            'Totals' => [
              'MXN' => number_format($total_cotizacion_mxn, 2, '.', ','),
              //'USD' => number_format($total_cotizacion_usd, 2, '.', ',')
            ],
            'Notes' => $Notes,
            'Specs' => $types
        ];
        //dd($data);
        // $template = Template::find(1);

       // $pdf = PDF::loadHTML(CustomBladeCompiler::render($template->data, $data))->setPaper('a4');


        
        $pdf = PDF::loadView('pdf.'.session('Company').'_quotation', compact('data'))->setPaper('a4');
        
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(530, 10, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 8, array(0, 0, 0));
        //dd($data);
        return $pdf->stream('Cotización.pdf');
    }


    public function getClienteData($request){

        $data = array();

        array_push($data,
            Lib::querySQLSRV("SELECT TOP 1 T1.CardCode, T1.CardName, T1.CmpPrivate, T1.LicTradNum, T1.Phone1, T1.IntrntSite, T1.E_Mail, cast(T1.CreditLine as decimal(10,2)) cotiLimite, cast(T1.Balance as decimal(10,2)) cotiDeudor, cast((T1.CreditLine - T1.Balance) as decimal(10,2)) cotiDisp, T2.ExtraMonth + ' ' + T2.ExtraDays cotiDias, isSAP = 'Y' FROM OCRD T1 JOIN OCTG T2 ON T1.GroupNum = T2.GroupNum WHERE CardType = 'C' AND VatStatus = 'Y' AND CardCode = ? ", [ $request ]));

        array_push($data,
            Lib::querySQLSRV("SELECT TOP 1 T3.FirstName cpName, T3.Tel1 cpPhone, T3.E_MailL cpEmail FROM OCPR T3 JOIN OCRD T1 ON T3.CardCode = T1.CardCode WHERE T3.CardCode = ? ", [ $request ]));

        array_push($data,
            Lib::querySQLSRV("SELECT TOP 1 T2.Street fStreet, T2.Block fCol, T2.City fCity, T2.City fCity2, T2.ZipCode fZip, T2.County fCounty, T4.Name fState, T5.Name fCountry FROM CRD1 T2 JOIN OCRD T1 ON T2.CardCode = T1.CardCode JOIN OCST T4 ON T2.State = T4.Code JOIN OCRY T5 ON T2.Country = T5.Code WHERE T2.CardCode = ? AND T2.Address = 'FISCAL'", [ $request ]));

        array_push($data,
            Lib::querySQLSRV("SELECT TOP 1 T2.Street eStreet, T2.Block eCol, T2.City eCity, T2.City eCity2, T2.ZipCode eZip, T2.County eCounty, T4.Name eState, T5.Name eCountry FROM CRD1 T2 JOIN OCRD T1 ON T2.CardCode = T1.CardCode JOIN OCST T4 ON T2.State = T4.Code JOIN OCRY T5 ON T2.Country = T5.Code WHERE T2.CardCode = ? AND T2.Address = 'ENVIO'", [ $request ]));

        array_push($data,
            Lib::querySQLSRV("SELECT TOP 1 CONVERT(VARCHAR(10),T1.DocDate,103) DocDate, cast(T1.TrsfrSum as decimal(10, 2)) cotiMonto FROM ORCT T1 WHERE T1.CardCode = ? ORDER BY T1.DocDate DESC", [ $request ]));
        
        if(empty($data[0])){

                $data[0] = Lib::querySQLMYSQL("SELECT CONCAT(clienteNombre, ' | ' , clienteRazon) AS CardName FROM 
                ".session('Company')."_customers WHERE id LIKE ? ", [ $request ]);
    
                return $data;
        }

        return $data;
    }

    public function getUSDRate(){
      $row = Lib::querySQLSRV("SELECT T1.ISOCurrCod, CASE WHEN T1.ISOCurrCod = 'MXN' THEN 1 ELSE T2.Rate END Rate FROM OCRN T1 LEFT JOIN ORTT T2 ON T1.ISOCurrCod = T2.Currency
        WHERE T2.RateDate = CONVERT(DATE, GETDATE()) AND T1.ISOCurrCod = 'USD'");
      return floatval($row[0]->Rate);
    }




}



class CustomBladeCompiler
{   
   public static function render($string, $data)
   {
   

       $php = \Blade::compileString($string);

       $obLevel = ob_get_level();

       ob_start() and extract($data, EXTR_SKIP);

       try {
           eval('?' . '>' . $php);
       } catch (Exception $e) {
           while (ob_get_level() > $obLevel) ob_end_clean();
           throw $e;
       } catch (Throwable $e) {
           while (ob_get_level() > $obLevel) ob_end_clean();
           throw new FatalThrowableError($e);
       }

       return ob_get_clean();
   }
}

