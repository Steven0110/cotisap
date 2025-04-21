<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Quotation as Cotizacion;
use App\Lib\Libraries as Lib;
use App\User;

class SearcherController extends Controller
{
    //
    public function search(Request $request){
    	/*Busca cotizaciones*/
    	$quotations = Cotizacion::where('numCotizacion', 'LIKE', '%'.$request->q.'%')
    		->orWhere('nombreCliente', 'LIKE', '%'.$request->q.'%')
    		->orWhere('comentarios', 'LIKE', '%'.$request->q.'%')
    		->orWhere('idVendedor', 'LIKE', '%'.$request->q.'%')
            ->limit(10)
            ->get();
    	/*Busca Pedidos*/
    	/*Busca Facturas*/
    	$invoices = Lib::querySQLSRV("SELECT TOP 10 DocNum as id, CardCode, CardName, Comments FROM OINV WHERE DocNum LIKE ? OR CardCode LIKE ? OR CardName LIKE ? OR Comments LIKE ?", 
    		['%'.$request->q.'%',
    		'%'.$request->q.'%',
    		'%'.$request->q.'%',
    		'%'.$request->q.'%']
    	);

    	/*Busca Entregas*/
    	$delivers = Lib::querySQLSRV("SELECT TOP 10 T1.DocNum as id, T1.NumAtCard, T1.DocEntry, CONVERT(VARCHAR(10),T1.DocDate,103) DocDate, CONVERT(VARCHAR(10),T1.DocDueDate,103) DocDueDate, T1.CardCode, T1.CardName, T2.E_Mail, T1.Comments, T1.DocTotal, (CASE T1.DocStatus WHEN 'O' THEN 'Abierto' WHEN 'C' THEN 'Cerrado' END)DocStatus FROM ODLN T1, OCRD T2 WHERE T2.CardCode = T1.CardCode AND (T1.CardName LIKE ? OR T1.Comments LIKE ? OR T1.CardCode LIKE ?)",
            ['%'.$request->q.'%',
    		'%'.$request->q.'%',
    		'%'.$request->q.'%',
    		'%'.$request->q.'%']
        );
        $data = [
            'quotations' => $quotations,
            'invoices' => $invoices,
            'delivers' => $delivers,
            'q' => $request->q,
            'empty' => count($invoices) == 0 && count($delivers) == 0 && count($quotations),
            'total' => count($invoices) + count($delivers) + count($quotations)
        ];
        //dd($data);
    	return View('theme.administracion.resultados')->with($data);
    }
}
