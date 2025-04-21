<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\Libraries as Lib;

class DeliverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return View('theme.entregas.buscar-entregas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllDelivers(Request $request){
        return Lib::querySQLSRV("SELECT TOP 30 DocNum as id, DocNum as text FROM ODLN WHERE DocNum LIKE ? ORDER BY DocNum ASC",
                [ "%".$request->q."%" ]
            );
    }
    public function getDeliver(Request $request){
        $doc = Lib::querySQLSRV("SELECT T1.NumAtCard, T1.DocNum, T1.DocEntry, CONVERT(VARCHAR(10),T1.DocDate,103) DocDate, CONVERT(VARCHAR(10),T1.DocDueDate,103) DocDueDate, T1.CardCode, T1.CardName, T2.E_Mail, T1.Comments, T1.DocTotal, (CASE T1.DocStatus WHEN 'O' THEN 'Abierto' WHEN 'C' THEN 'Cerrado' END)DocStatus FROM ODLN T1, OCRD T2 WHERE T1.DocNum = ? AND T2.CardCode = T1.CardCode",
            [ $request->docNum ]
        );
        if( count( $doc ) === 0 ){
            return response()->json([
                "doc" => false
            ]);
        }else{
            $document = $doc[ 0 ];
            $docEntry = $document->DocEntry;
            $articles = Lib::querySQLSRV("SELECT BaseAtCard, LineNum, ItemCode, Dscription, Quantity, LineTotal FROM DLN1 WHERE DocEntry = ? ORDER BY LineNum ASC", [ $docEntry ]);
            return response()->json([
                "doc" => $document,
                "articles" => $articles
            ]);
        }
    }
    public function getReport(Request $request){
        $slp_codes = $request->slp_codes;
        $report = array();
        foreach( $request->slp_codes as $slp_code ){
            $aux_rows = Lib::querySQLSRV("SELECT TOP 10 T2.SlpName,T1.DocNum, T1.NumAtCard, (T1.CardName + ' - ' + T1.CardCode) AS Cliente, T1.DocDate, T1.SlpCode, T1.DocTotal 
                FROM ODLN T1, OSLP T2
                WHERE T1.SlpCode = ?
                AND T1.DocStatus = 'O'
                AND T1.SlpCode = T2.SlpCOde
                ORDER BY T1.DocDate DESC;", [ $slp_code ] );
            if(count( $aux_rows ) == 0)
                continue;
            $aux_delivery = array();
            $final_total = 0;
            foreach( $aux_rows as $delivery ){
                array_push( $aux_delivery, [
                    'docNum' => $delivery->DocNum,
                    'folio' => $delivery->NumAtCard,
                    'date' => substr( strval($delivery->DocDate), 0, 10),
                    'total' => number_format($delivery->DocTotal, 2)
                ]);
                $final_total += floatval($delivery->DocTotal);
            }
            $slp = [
                'name' => $aux_rows[ 0 ]->SlpName,
                'id' => $aux_rows[ 0 ]->SlpCode,
                'final_total' => number_format($final_total, 2),
                'info' => $aux_delivery
            ];
            array_push( $report, $slp );
        }
        return View('theme.entregas.reportes')->with(compact('report'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
