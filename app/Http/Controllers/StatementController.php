<?php


/**
* 
*
* @author GerardoSteven (Steven0110)
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\Libraries as Lib;

class StatementController extends Controller{
    //
    public function getStatement(Request $request) {
    	
    	$toDate = date('Y-m-d H:i:s');;
		$fromDate = strtotime ( '-45 day' , strtotime ( $toDate ) ) ;
		$fromDate = date ( 'Y-m-j' , $fromDate );
    	$repDate = date('Y-m-d H:i:s');
    	$bPartner = $request->idSocio;
		return Lib::querySQLSRV(
			   "DECLARE @P1 varchar(30) = '$fromDate'; --fecha de contabilización desde
				DECLARE @P2 varchar(30) = '$toDate'; --fecha de contabilización hasta
				DECLARE @P6 varchar(10) = '$bPartner' --'00625' --Socio de negocios
				DECLARE @P3 varchar(30) = '$repDate'; --fecha de reconciliación (vencimiento)
				SELECT          T0.[transid], 
							T0.[line_id], 
							Max(T0.[account]), 
							Max(T0.[shortname]), 
							Max(T0.[transtype]), 
							Max(T0.[createdby]), 
							Max(T0.[baseref]) AS Documento, 
							Max(T0.[sourceline]), 
							Max(T0.[refdate]), 
							Max(T0.[duedate]) AS fechavencimiento, 
							Max(T0.[taxdate]) AS fechadocumento, 
							Max(T0.[balduecred]) + Sum(T1.[reconsum]) AS TotaldocMN, 
							Max(T0.[balfccred])  + Sum(T1.[reconsumfc]), 
							Max(T0.[balsccred])  + Sum(T1.[reconsumsc]), 
							Max(T0.[linememo]) AS comentario, 
							Max(T3.[foliopref]), 
							Max(T3.[folionum]), 
							Max(T0.[indicator]) AS indicador, 
							Max(T4.[cardname]), 
							Max(T5.[cardcode]) AS CodeSN, 
							Max(T5.[cardname]) AS SocioNegocios, 
							Max(T4.[balance]), 
							Max(T5.[numatcard]), 
							Max(T5.[slpcode]) AS CodVend, 
							Max(T0.[project]) AS Proyecto, 
							Max(T0.[debit])   - Max(T0.[credit]) AS SaldodocMN, 
							Max(T0.[fcdebit]) - Max(T0.[fccredit]), 
							Max(T0.[sysdeb])  - Max(T0.[syscred]), 
							Max(T4.[pymcode]), 
							Max(T5.[blockdunn]), 
							Max(T5.[dunnlevel]), 
							Max(T5.[transtype]), 
							Max(T5.[issales]) AS EsVenta, 
							Max(T4.[currency]), 
							Max(T0.[fccurrency]), 
							Max(T6.[slpname]) AS Vendedor, 
							Max(T4.[dunterm]), 
							Max(T0.[dunnlevel]), 
							T0.[bplname] 
				FROM            [dbo].[jdt1] T0 
				INNER JOIN      [dbo].[itr1] T1 
				ON              T1.[transid] = T0.[transid] 
				AND             T1.[transrowid] = T0.[line_id] 
				INNER JOIN      [dbo].[oitr] T2 
				ON              T2.[reconnum] = T1.[reconnum] 
				INNER JOIN      [dbo].[ojdt] T3 
				ON              T3.[transid] = T0.[transid] 
				INNER JOIN      [dbo].[ocrd] T4 
				ON              T4.[cardcode] = T0.[shortname] 
				LEFT OUTER JOIN [dbo].[b1_journaltranssourceview] T5 
				ON              T5.[objtype] = T0.[transtype] 
				AND             T5.[docentry] = T0.[createdby] 
				AND             ( 
											T5.[transtype] <> N'I' 
							OR              ( 
															T5.[transtype] = N'I' 
											AND             T5.[instlmntid] = T0.[sourceline] )) 
				LEFT OUTER JOIN [dbo].[oslp] T6 
				ON              T6.[slpcode] = T5.[slpcode] 
				OR              ( 
											T6.[slpname] = N'-Ningún empleado del departament'
							AND             ( 
															T0.[transtype] = N'30' 
											OR              T0.[transtype] = N'321' 
											OR              T0.[transtype] = N'-5' 
											OR              T0.[transtype] = N'-2' 
											OR              T0.[transtype] = N'-3' 
											OR              T0.[transtype] = N'-4' )) 
				WHERE           T0.[refdate] <= (@P2) --To
				AND             T0.[refdate] >= (@P1) --From
				AND             T0.[refdate] <= (@P3) 
				AND             T4.[cardtype] = ('C') --(@P4) 
				AND             T4.[balance] <> 0 --(@P5) 
				AND             T5.[cardcode] = (@P6) 
				AND             T2.[recondate] > (@P3) 
				AND             T1.[iscredit] = 'D' --(@P10) 
				GROUP BY        T0.[transid], 
							T0.[line_id], 
							T0.[bplname] 
				HAVING          Max(T0.[balfccred]) <> - Sum(T1.[reconsumfc]) 
				OR              Max(T0.[balduecred]) <>- Sum(T1.[reconsum]) 
				UNION ALL 
				SELECT          T0.[transid], 
							T0.[line_id], 
							Max(T0.[account]), 
							Max(T0.[shortname]), 
							Max(T0.[transtype]), 
							Max(T0.[createdby]), 
							Max(T0.[baseref]), 
							Max(T0.[sourceline]), 
							Max(T0.[refdate]), 
							Max(T0.[duedate]), 
							Max(T0.[taxdate]), 
							- Max(T0.[balduedeb]) - Sum(T1.[reconsum]), 
							- Max(T0.[balfcdeb]) - Sum(T1.[reconsumfc]), 
							- Max(T0.[balscdeb]) - Sum(T1.[reconsumsc]), 
							Max(T0.[linememo]), 
							Max(T3.[foliopref]), 
							Max(T3.[folionum]), 
							Max(T0.[indicator]), 
							Max(T4.[cardname]), 
							Max(T5.[cardcode]), 
							Max(T5.[cardname]), 
							Max(T4.[balance]), 
							Max(T5.[numatcard]), 
							Max(T5.[slpcode]), 
							Max(T0.[project]), 
							Max(T0.[debit])   - Max(T0.[credit]), 
							Max(T0.[fcdebit]) - Max(T0.[fccredit]), 
							Max(T0.[sysdeb])  - Max(T0.[syscred]), 
							Max(T4.[pymcode]), 
							Max(T5.[blockdunn]), 
							Max(T5.[dunnlevel]), 
							Max(T5.[transtype]), 
							Max(T5.[issales]), 
							Max(T4.[currency]), 
							Max(T0.[fccurrency]), 
							Max(T6.[slpname]), 
							Max(T4.[dunterm]), 
							Max(T0.[dunnlevel]), 
							T0.[bplname] 
				FROM            [dbo].[jdt1] T0 
				INNER JOIN      [dbo].[itr1] T1 
				ON              T1.[transid] = T0.[transid] 
				AND             T1.[transrowid] = T0.[line_id] 
				INNER JOIN      [dbo].[oitr] T2 
				ON              T2.[reconnum] = T1.[reconnum] 
				INNER JOIN      [dbo].[ojdt] T3 
				ON              T3.[transid] = T0.[transid] 
				INNER JOIN      [dbo].[ocrd] T4 
				ON              T4.[cardcode] = T0.[shortname] 
				LEFT OUTER JOIN [dbo].[b1_journaltranssourceview] T5 
				ON              T5.[objtype] = T0.[transtype] 
				AND             T5.[docentry] = T0.[createdby] 
				AND             ( 
											T5.[transtype] <> N'I' 
							OR              ( 
															T5.[transtype] = N'I' 
											AND             T5.[instlmntid] = T0.[sourceline] )) 
				LEFT OUTER JOIN [dbo].[oslp] T6 
				ON              T6.[slpcode] = T5.[slpcode] 
				OR              ( 
											T6.[slpname] = N'-Ningún empleado del departamento de ventas-'
							AND             ( 
															T0.[transtype] = N'30' 
											OR              T0.[transtype] = N'321' 
											OR              T0.[transtype] = N'-5' 
											OR              T0.[transtype] = N'-2' 
											OR              T0.[transtype] = N'-3' 
											OR              T0.[transtype] = N'-4' )) 
				WHERE           T0.[refdate] <= (@P2) --(@P11) --To
				AND             T0.[refdate] >= (@P1) --(@P12) --From
				AND             T0.[refdate] <= (@P3) 
				AND             T4.[cardtype] = ('C') --(@P14) 
				AND             T4.[balance] <> 0 --(@P15) 
				AND             T5.[cardcode] = (@P6)
				AND             T2.[recondate] > (@P3) 
				AND             T1.[iscredit] = 'D'--(@P20) 
				GROUP BY        T0.[transid], 
							T0.[line_id], 
							T0.[bplname] 
				HAVING          Max(T0.[balfcdeb]) <> - Sum(T1.[reconsumfc]) 
				OR              Max(T0.[balduedeb]) <>- Sum(T1.[reconsum]) 
				UNION ALL 
				SELECT          T0.[transid], 
							T0.[line_id], 
							Max(T0.[account]), 
							Max(T0.[shortname]), 
							Max(T0.[transtype]), 
							Max(T0.[createdby]), 
							Max(T0.[baseref]), 
							Max(T0.[sourceline]), 
							Max(T0.[refdate]), 
							Max(T0.[duedate]), 
							Max(T0.[taxdate]), 
							Max(T0.[balduecred]) - Max(T0.[balduedeb]), 
							Max(T0.[balfccred])  - Max(T0.[balfcdeb]), 
							Max(T0.[balsccred])  - Max(T0.[balscdeb]), 
							Max(T0.[linememo]), 
							Max(T1.[foliopref]), 
							Max(T1.[folionum]), 
							Max(T0.[indicator]), 
							Max(T2.[cardname]), 
							Max(T3.[cardcode]), 
							Max(T3.[cardname]), 
							Max(T2.[balance]), 
							Max(T3.[numatcard]), 
							Max(T3.[slpcode]), 
							Max(T0.[project]), 
							Max(T0.[debit])   - Max(T0.[credit]), 
							Max(T0.[fcdebit]) - Max(T0.[fccredit]), 
							Max(T0.[sysdeb])  - Max(T0.[syscred]), 
							Max(T2.[pymcode]), 
							Max(T3.[blockdunn]), 
							Max(T3.[dunnlevel]), 
							Max(T3.[transtype]), 
							Max(T3.[issales]), 
							Max(T2.[currency]), 
							Max(T0.[fccurrency]), 
							Max(T4.[slpname]), 
							Max(T2.[dunterm]), 
							Max(T0.[dunnlevel]), 
							T0.[bplname] 
				FROM            [dbo].[jdt1] T0 
				INNER JOIN      [dbo].[ojdt] T1 
				ON              T1.[transid] = T0.[transid] 
				INNER JOIN      [dbo].[ocrd] T2 
				ON              T2.[cardcode] = T0.[shortname] 
				LEFT OUTER JOIN [dbo].[b1_journaltranssourceview] T3 
				ON              T3.[objtype] = T0.[transtype] 
				AND             T3.[docentry] = T0.[createdby] 
				AND             ( 
											T3.[transtype] <> N'I' 
							OR              ( 
															T3.[transtype] = N'I' 
											AND             T3.[instlmntid] = T0.[sourceline] )) 
				LEFT OUTER JOIN [dbo].[oslp] T4 
				ON              T4.[slpcode] = T3.[slpcode] 
				OR              ( 
											T4.[slpname] = N'-Ningún empleado del departamento de ventas-'
							AND             ( 
															T0.[transtype] = N'30' 
											OR              T0.[transtype] = N'321' 
											OR              T0.[transtype] = N'-5' 
											OR              T0.[transtype] = N'-2' 
											OR              T0.[transtype] = N'-3' 
											OR              T0.[transtype] = N'-4' )) 
				WHERE           T0.[refdate] <= (@P2) --(@P21) --To
				AND             T0.[refdate] >= (@P1) --(@P22) --From
				AND             T0.[refdate] <= (@P3) 
				AND             T2.[cardtype] = ('C') --(@P24) 
				AND             T2.[balance] <> 0 --(@P25) 
				AND             T2.[cardcode] = (@P6)
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
									   --AND        U1.[recondate] > (@P29) 
									   GROUP BY   U0.[transid], 
												  U0.[transrowid]) 
				GROUP BY        T0.[transid], 
							T0.[line_id], 
							T0.[bplname]
				ORDER BY MAX(T4.[CardName]), Max(T0.[taxdate]) DESC");
    }
}
