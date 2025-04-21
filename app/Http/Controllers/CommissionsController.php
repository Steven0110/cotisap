<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\Libraries as Lib;
class CommissionsController extends Controller
{
    //
    public function index(){
    	return View('theme.administracion.commissions');
    }
    public function getEstimateReport(Request $request){
        $slp_codes = $request->slp_codes;
        $from = $request->from;
        $to = $request->to;
        $salesperson = array();
        foreach( $slp_codes as $slp ){
        	$doc = Lib::querySQLSRV("
        		DECLARE @P1 varchar(30) = '$from'
				DECLARE @P2 varchar(30) = '$to'
				DECLARE @P3 varchar(2) = '$slp'
				SELECT T2.SlpCode, T2.SlpName, T2.Commission, T1.CardCode, T1.CardName, 
				T1.NumAtCard, T1.Series, T1.DocNum, T1.DocDate, 
				T1.ExtraDays, T1.DocTotal, * FROM OINV T1, OSLP T2 WHERE 
				T1.DocDate >= (@P1) AND T1.DocDate <= (@P2) AND T1.SlpCode = (@P3) AND T1.SlpCode = T2.SlpCode ORDER BY 5, T1.DocDate DESC");
			if( count($doc) === 0 ) continue;

			$info = array();
			$total_slp = 0;
			$subtotal_slp = 0;
			$comision_slp = 0;
			$half_comision_slp = 0;
			foreach( $doc as $row ){
				$payment = strtotime ( '+'.$row->ExtraDays.' day' , strtotime ( $row->DocDate ) );
				$payment = date ( 'Y-m-j' , $payment);
				$total_doc = floatval($row->DocTotal);
				$subtotal_doc = floatval( $total_doc/1.16 );
				$slp_commission = floatval( $row->Commission );
				$commission = ($subtotal_doc / 100)*$slp_commission;
				$half_commission = $commission / 2;

				$total_slp += $total_doc;
				$subtotal_slp += $subtotal_doc;
				$comision_slp += $commission;
				$half_comision_slp += $half_commission;

				$document_totals = self::getCommissionTotals( $doc, $row->CardName);
				array_push( $info, [
					'docnum' => $row->DocNum,
					'cardname' => $row->CardName,
					'date' => substr($row->DocDate, 0, 10),
					'limit' => $payment,
					'due' => date('Y-m-j', strtotime ( '+15 day' , strtotime ( $payment ) )),
					'total_doc' => number_format($total_doc, 2),
					'subtotal_doc' => number_format($subtotal_doc, 2),
					'commision_doc' => number_format($commission, 2),
					'due_commision_doc' => number_format($half_commission, 2),
					'total' => number_format($document_totals['total'], 2),
					'subtotal' => number_format($document_totals['subtotal'], 2),
					'commision' => number_format($document_totals['comision'], 2),
					'half_commision' => number_format($document_totals['half_comision'], 2),
				]);
			}
			array_push( $salesperson, [
				'name' => $doc[0]->SlpName,
				'total_slp' => number_format($total_slp, 2),
				'subtotal_slp' => number_format($subtotal_slp, 2),
				'comision_slp' => number_format($comision_slp, 2),
				'half_comision_slp' => number_format($half_comision_slp, 2),
				'documents' => $info
			]);


        }
        return View('theme.comisiones.reporte2')->with(compact('salesperson'));
        
    }
    public function getCommissionTotals( $array, $name ){
    	$total = 0;
    	$subtotal = 0;
    	$comision = 0;
    	$half_comision = 0;
    	foreach( $array as $row ){
    		if( $row->CardName === $name ){
    			$sub_aux = floatval($row->DocTotal)/1.16;
    			$comision += ($sub_aux/100)*floatval($row->Commission);
    			$half_comision += (($sub_aux/100)*floatval($row->Commission))/2;
    			$subtotal += $sub_aux; 
    			$total += floatval($row->DocTotal);
    		}
    	}
    	return [
    		'total' => $total,
    		'subtotal' => $subtotal,
    		'comision' => $comision,
    		'half_comision' => $half_comision
    	];    	
    }
    public function getTotal( $array, $name ){
    	$total = 0;
    	$subtotal = 0;
    	$comision = 0;
    	foreach( $array as $row ){
    		if( $row->NombreSN === $name ){
    			$sub_aux = floatval($row->PagoMN)/1.16;
    			$comision += ($sub_aux/100)*floatval($row->Comision);

    			$subtotal += $sub_aux; 
    			$total += floatval($row->PagoMN);
    		}
    	}
    	return [
    		'total' => $total,
    		'subtotal' => $subtotal,
    		'comision' => $comision
    	];
    }
    public function getResumeReport(Request $request){
        $slp_codes = $request->slp_codes;
        $from = $request->from;
        $to = $request->to;
        $salesperson = array();
        foreach( $slp_codes as $slp ){
        	$doc = Lib::querySQLSRV("DECLARE @P1 varchar(30) = '$from'; --fecha de contabilización desde
					DECLARE @P2 varchar(30) = '$to'; --fecha de contabilización hasta
					DECLARE @P3 varchar(2) = '$slp'; --Vendedor
					
					SELECT          T0.[transid] AS Documento,
				                Max(T0.[shortname]) as CodSN, 
				                Max(T0.[transtype]) as Tipodoc,
				                Max(T0.[createdby]) as NoPago,
				                Max(T0.[refdate]) as [Fecha Contabilización],
				                Max(T0.[duedate])as fechavencimiento,
				                Max(T0.[taxdate]) as fechadocumento,
				                Max(T0.[balduecred]) + Sum(T1.[reconsum]) as PagoMN,
								Max(T0.[balsccred])  + Sum(T1.[reconsumsc]) as PagoUSD,
				                Max(T5.[cardname]) as NombreSN,
				                Max(T7.[slpcode]) as CodVend,
				                Max(T4.[currency]) as Moneda,
				                Max(T7.[slpname] )as Vendedor,
				                Max(T7.[commission] )as Comision
				FROM            [dbo].[jdt1] T0
								INNER JOIN      [dbo].[itr1] T1 ON T1.[transid] = T0.[transid] AND T1.[transrowid] = T0.[line_id]
								INNER JOIN      [dbo].[oitr] T2 ON T2.[reconnum] = T1.[reconnum]
								INNER JOIN      [dbo].[ojdt] T3 ON T3.[transid] = T0.[transid]
								INNER JOIN      [dbo].[ocrd] T4 ON T4.[cardcode] = T0.[shortname]
								INNER  JOIN [dbo].[OSLP]/**empleados de Ventas**/ T7  ON  T7.[SlpCode] = T4.[SlpCode]
						        LEFT OUTER JOIN [dbo].[b1_journaltranssourceview] T5 ON T5.[objtype] = T0.[transtype]
								AND              T5.[docentry] = T0.[createdby]
								AND             (T5.[transtype] <> N'I'
				                OR              (T5.[transtype] = N'I'
				                AND              T5.[instlmntid] = T0.[sourceline] ))
								LEFT OUTER JOIN [dbo].[oslp] T6 ON T6.[slpcode] = T5.[slpcode]
								OR              (
				                                T6.[slpname] = N'-Ningún empleado del departament'
				                AND             (
				                                                T0.[transtype] = N'30'
				                                OR              T0.[transtype] = N'321'
				                                OR              T0.[transtype] = N'-5'
				                                OR              T0.[transtype] = N'-2'
				                                OR              T0.[transtype] = N'-3'
				                                OR              T0.[transtype] = N'-4' ))
				                                
				 WHERE T0.[RefDate] >= (@P1)  --fecha de contabilización
				 AND  T0.[RefDate] <= (@P2)  --fecha de contabilización
				 AND  T4.[CardType] = ('C')  --tipo de socio de negocio C(cliente) (s)Proveedor
				 AND  T0.[TransType] = '24'
				 AND  T1.[IsCredit] = 'C'
				 AND  T4.[SlpCode] = (@P3)



				GROUP BY        T0.[transid],
				                T0.[line_id],
				                T0.[bplname]
				                
				HAVING          Max(T0.[balfccred]) <> - Sum(T1.[reconsumfc])
				OR              Max(T0.[balduecred]) <>- Sum(T1.[reconsum])
				
				UNION ALL

				SELECT          T0.[transid],
				                Max(T0.[shortname]),
				                Max(T0.[transtype]),
				                Max(T0.[createdby]),
				                Max(T0.[refdate]),
				                Max(T0.[duedate]),
				                Max(T0.[taxdate]),
				                Max(T0.[balduecred]) - Max(T0.[balduedeb]) as [Pago MN],
				                Max(T0.[balsccred])  - Max(T0.[balscdeb]),
				                Max(T3.[cardname]),
				                Max(T7.[slpcode]),
				                Max(T2.[currency]),
				                Max(T7.[slpname]),
				                Max(T7.[commission] )
				FROM            [dbo].[jdt1] T0
							INNER JOIN      [dbo].[ojdt] T1 ON T1.[transid] = T0.[transid]
							INNER JOIN      [dbo].[ocrd] T2 ON T2.[cardcode] = T0.[shortname]
							INNER  JOIN [dbo].[OSLP]/**empleados de Ventas**/ T7  ON  T7.[SlpCode] = T2.[SlpCode]
							LEFT OUTER JOIN [dbo].[b1_journaltranssourceview] T3 ON T3.[objtype] = T0.[transtype]
							AND             T3.[docentry] = T0.[createdby]
							AND             (T3.[transtype] <> N'I'  OR     (T3.[transtype] = N'I'   AND   T3.[instlmntid] = T0.[sourceline] ))
							LEFT OUTER JOIN [dbo].[oslp] T4 ON T4.[slpcode] = T3.[slpcode]
							OR              (    T4.[slpname] = N'-Ningún empleado del departament'
				                AND             (
				                                                T0.[transtype] = N'30'
				                                OR              T0.[transtype] = N'321'
				                                OR              T0.[transtype] = N'-5'
				                                OR              T0.[transtype] = N'-2'
				                                OR              T0.[transtype] = N'-3'
				                                OR              T0.[transtype] = N'-4' ))


				WHERE T0.[RefDate] >= (@P1)  --fecha de contabilización--
				 AND  T0.[RefDate] <= (@P2)  --fecha de contabilización
				 AND  T2.[CardType] = ('C')  --socio de negocio
				 AND  T0.[TransType] = '24'
				 AND  T7.[SlpCode] = (@P3)
				 AND             (
				                                T0.[balduecred] <> T0.[balduedeb]
				                OR              T0.[balfccred] <> T0.[balfcdeb] )
				AND             NOT EXISTS
				                (
				                           SELECT     U0.[transid],
				                                      U0.[transrowid]
				                           FROM       [dbo].[itr1] U0
				                           INNER JOIN [dbo].[oitr] U1
				                           ON         U1.[reconnum] = U0.[reconnum]
				                           WHERE      T0.[transid] = U0.[transid]
				                           AND        T0.[line_id] = U0.[transrowid]

				                           GROUP BY   U0.[transid],
				                                      U0.[transrowid])
				                                      
				group BY        T0.[transid] ORDER BY 2");
			if( count($doc) === 0 ) continue;
			$info = array();
			$total_slp = 0;
			$subtotal_slp = 0;
			$comision_slp = 0;
			foreach( $doc as $row ){
				$subtotal = floatval($row->PagoMN)/1.16;
				$comision = floatval($row->Comision);
				$comision_res = ($subtotal/100)*$comision;
				$total = floatval($row->PagoMN);

				$total_slp += $total;
				$subtotal_slp += $subtotal;
				$comision_slp += $comision_res;
				$document_totals = self::getTotal( $doc, $row->NombreSN);
				array_push( $info, [
					'transaccion' => $row->Documento,
					'name' => $row->NombreSN,
					'no_pago' => $row->NoPago,
					'fecha_doc' => substr( $row->fechadocumento, 0, 10),
					'fecha_vencimiento' => substr( $row->fechavencimiento, 0, 10),
					'total' => number_format($total, 2),
					'subtotal' => number_format($subtotal, 2),
					'comision' => number_format($comision_res, 2),
					'total_doc' => number_format( $document_totals['total'], 2),
					'subtotal_doc' => number_format( $document_totals['subtotal'], 2),
					'com_doc' => number_format( $document_totals['comision'], 2)
				]);
			}
			array_push( $salesperson, [
				'name' => $doc[0]->Vendedor,
				'total_slp' => number_format($total_slp, 2),
				'subtotal_slp' => number_format($subtotal_slp, 2),
				'comision_slp' => number_format($comision_slp, 2),
				'documents' => $info
			]);
        }
        return View('theme.comisiones.reporte')->with(compact('salesperson'));
    }
}
