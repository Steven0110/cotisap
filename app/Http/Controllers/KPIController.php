<?php


/**
* Clase de Librerias Generales en cotiSAP
*
* @author GerardoSteven (Steven0110)
*/

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

use App\company;
use App\Quotation;
use App\ArtQuotation;
use App\ArticuloNoSAP;
use App\User;
//use App\KPIController;
use App\Lib\Libraries as Lib;

class KPIController extends Controller{
    public function getGeneralInfo(Request $request){

      $prefix = session('Company');

      
      // Get Sales Persons
      $slp = Auth::user()->SlpCode;
      $actives = Lib::querySQLSRV("SELECT SlpCode as id, SlpName AS text FROM OSLP WHERE U_manager = ? AND Active = 'Y' UNION SELECT SlpCode as id, SlpName AS text FROM OSLP WHERE SlpCode = ? AND Active = 'Y'",
          [ $slp, $slp ] );
      $inactives = Lib::querySQLSRV("SELECT SlpCode as id, SlpName AS text FROM OSLP WHERE U_manager = ? AND Active = 'N' UNION SELECT SlpCode as id, SlpName AS text FROM OSLP WHERE SlpCode = ? AND Active = 'N'",
          [ $slp, $slp ] );

      //Total Quotations
      $total = Quotation::where('idVendedor', Auth::user()->email )->count();

      //Last Quotation
      $last_quotation = Quotation::where('idVendedor', Auth::user()->email )
        ->orderBy('created_at', 'desc')
        ->take(1)
        ->first();

      // General top 10 quotations
      $top_quotations = Quotation::where('total', '>', 100000)
        ->where('nombreCliente', '<>', '')
        ->where('numCotizacion', '<>', '0')
        ->orderBy('total', 'desc')
        ->take(10)
        ->get();

      // General Hitrate
      $q = Quotation::where('estatus', 'Q')->count();
      $g = Quotation::where('estatus', 'G')->count();
      $p = Quotation::where('estatus', 'P')->count();
      $n = Quotation::where('estatus', 'N')->count();

      //  Quotations Frecuency
      $fch = Lib::querySQLMYSQL("SELECT CONVERT(AVG(F.DiffMin)/60.0, DECIMAL(10,2)) AS FrecuenciaCotizacionesHoras FROM
                (
                  SELECT  
                      CONVERT(ABS((TIME_TO_SEC(TIMEDIFF(T1.a, T1.b))/60.0)), DECIMAL(10.2)) AS DiffMin FROM
                    (
                    SELECT A.created_at AS a, B.created_at AS b
                    FROM ".$prefix."_quotations A, ".$prefix."_quotations B
                    WHERE A.id=(B.id-1) 
                    ) AS T1
                ) AS F")[0]->FrecuenciaCotizacionesHoras;


      return response()->json([
        'status'          => true,
        'hitrate'         => [ $q, $n, $g, $p ],
        'top_quotations'  => $top_quotations,
        'last_quotation'  => $last_quotation,
        'total_quotations'=> $total,
        'actives'         => $actives,
        'inactives'       => $inactives,
        'FCH'             => $fch
      ]);
    }


    public function getSLPInfo(Request $request){
      $user = User::where('SlpCode', $request->slpcode )->first();
      $email = $user->email;

      // SalesPerson Top 10 Quotations
      $top_quotations = Quotation::where('total', '>', 100000)
        ->where('nombreCliente', '<>', '')
        ->where('numCotizacion', '<>', '0')
        ->where('idVendedor', $email)
        ->orderBy('total', 'desc')
        ->take(10)
        ->get();

      // SalesPerson Top 10 Products
      $quotations = Quotation::where('idVendedor', $email)->pluck('numCotizacion')->all();
      $top_products = ArtQuotation::whereIn('numCotizacion', $quotations)
          ->select('nombreArt', DB::raw('COUNT(*) AS total'))
          ->groupBy('nombreArt')
          ->orderBy('total', 'desc')
          ->take(10)
          ->get();

      // SalesPerson Hitrate
      $q = Quotation::where('estatus', 'Q')->where('idVendedor', $email)->count();
      $g = Quotation::where('estatus', 'G')->where('idVendedor', $email)->count();
      $p = Quotation::where('estatus', 'P')->where('idVendedor', $email)->count();
      $n = Quotation::where('estatus', 'N')->where('idVendedor', $email)->count();

      return response()->json([
          'top_quotations' => $top_quotations,
          'top_products' => $top_products,
          'hitrate' => [ $q, $n, $g, $p ],
          'status' => true
        ]);
    }



    public function getPartners(Request $request){
      return Lib::querySQLSRV("SELECT T1.cardcode, T1.cardname
        FROM 
          [dbo].[jdt1] T0, 
          [dbo].[b1_journaltranssourceview] T1,
          [dbo].[itr1] T2,
          [dbo].[oitr] T3,
          [dbo].[ocrd] T4,
          [dbo].[oslp] T6
        WHERE DueDate >= '2018-01-01'
          AND T0.transid = T2.transid
          AND T0.transtype = T1.objtype
          AND T3.reconnum = T2.reconnum
          AND T4.cardcode = T0.shortname
          AND T1.docentry = T0.createdby
          AND T6.slpcode = T1.slpcode
          AND T2.transrowid = T0.line_id
          AND T2.iscredit = 'D'
          --AND T6.slpcode = ?
          AND(
            T1.transtype <> N'I'
            OR(
              T1.transtype = N'I' AND T1.instlmntid = T0.sourceline 
            )
          )
          AND( 
            T0.[transtype] = N'30' 
            OR T0.[transtype] = N'321' 
            OR T0.[transtype] = N'-5' 
            OR T0.[transtype] = N'-2' 
            OR T0.[transtype] = N'-3' 
            OR T0.[transtype] = N'-4' 
          )
        GROUP BY T1.cardcode, T1.cardname
      ORDER BY 1", [Auth::user()->SlpCode]);
    }
    public function getSPQuotation(Request $request){
      $user = User::where('SlpCode', $request->slpcode )->first();
      $email = $user->email;
      $quotations = Quotation::where('total', '>', 100000)
        ->where('nombreCliente', '<>', '')
        ->where('numCotizacion', '<>', '0')
        ->where('idVendedor', $email)
        ->orderBy('total', 'desc')
        ->take(10)
        ->get();
      return response()->json([
          'data' => $quotations,
          'status' => true
        ]);
    }
    public function getSPProducts(Request $request){
      $user = User::where('SlpCode', $request->slpcode )->first();
      $email = $user->email;
      $quotations = Quotation::where('idVendedor', $email)->pluck('numCotizacion')->all();
      $art_quot = ArtQuotation::whereIn('numCotizacion', $quotations)
          ->select('nombreArt', DB::raw('COUNT(*) AS total'))
          ->groupBy('nombreArt')
          ->orderBy('total', 'desc')
          ->take(10)
          ->get();
      return response()->json([
        'status' => true,
        'data' => $art_quot
      ]);
    }
    public function getSPHitRate(Request $request){
      $user = User::where('SlpCode', $request->slpcode )->first();
      $email = $user->email;
      $q = Quotation::where('estatus', 'Q')->where('idVendedor', $email)->count();
      $g = Quotation::where('estatus', 'G')->where('idVendedor', $email)->count();
      $p = Quotation::where('estatus', 'P')->where('idVendedor', $email)->count();
      $n = Quotation::where('estatus', 'N')->where('idVendedor', $email)->count();
      return response()->json([
        'status' => true,
        'data' => [ $q, $n, $g, $p ]
      ]);
    }
    public function getGeneralHitRate(Request $request){
      $q = Quotation::where('estatus', 'Q')->count();
      $g = Quotation::where('estatus', 'G')->count();
      $p = Quotation::where('estatus', 'P')->count();
      $n = Quotation::where('estatus', 'N')->count();
      return response()->json([
        'status' => true,
        'data' => [ $q, $n, $g, $p ]
      ]);
    }
    public function getGeneralQuotation(Request $request){
        $quotations = Quotation::where('total', '>', 100000)
          ->where('nombreCliente', '<>', '')
          ->where('numCotizacion', '<>', '0')
          ->orderBy('total', 'desc')
          ->take(10)
          ->get();
        return response()->json([
            'data' => $quotations,
            'status' => true
          ]);
    }
    public function getQuotationsFrequency(Request $request){
      $prefix = session('Company');
      $fch = Lib::querySQLMYSQL("SELECT CONVERT(AVG(F.DiffMin)/60.0, DECIMAL(10,2)) AS FrecuenciaCotizacionesHoras FROM
                (
                  SELECT  
                      CONVERT(ABS((TIME_TO_SEC(TIMEDIFF(T1.a, T1.b))/60.0)), DECIMAL(10.2)) AS DiffMin FROM
                    (
                    SELECT A.created_at AS a, B.created_at AS b
                    FROM ".$prefix."_quotations A, ".$prefix."_quotations B
                    WHERE A.id=(B.id-1) 
                    ) AS T1
                ) AS F");

        return response()->json([
          'FCH' => $fch[0]->FrecuenciaCotizacionesHoras
        ]);
             
    }
}
