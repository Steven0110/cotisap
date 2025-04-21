<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\Libraries as Lib;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return View('theme.facturas.buscar-facturas');
    }
    /**
     * .
     *  
     *  
     * @return \Illuminate\Http\Response
     */
    public function getAllInvoices(Request $request){
        return Lib::querySQLSRV("SELECT DocNum as id, DocNum as text  FROM OINV WHERE DocNum LIKE ?", [ "%".$request->q."%" ]);
    }
    public function getInvoice(Request $request){
        $docNum = $request->docNum;
        $doc = Lib::querySQLSRV("SELECT NumAtCard, DocNum, DocEntry, EDocNum, CardCode, CardName, DocDate, DocDueDate, DocTotal, Comments FROM OINV WHERE DocNum = ?", [$docNum]);
        $document = $doc[0];
        $docEntry = $doc[0]->DocEntry;
        if( Lib::checkU_Sigla03() ){
            $articles = Lib::querySQLSRV("SELECT BaseAtCard, LineNum, ItemCode, Dscription, Quantity, LineTotal, U_Sigla03 FROM INV1 WHERE DocEntry = ? ORDER BY LineNum ASC", [$docEntry]);
        }else{
            $articles = Lib::querySQLSRV("SELECT BaseAtCard, LineNum, ItemCode, Dscription, Quantity, LineTotal  FROM INV1 WHERE DocEntry = ? ORDER BY LineNum ASC", [$docEntry]);
        }
        return response()->json([
            'document' => $document,
            'articles' => $articles
            ]);

    }
    public function getNewEDoc(Request $request ){
        return Lib::querySQLSRV("SELECT ReportID FROM ECM2 WHERE SrcObjAbs = (SELECT DocEntry FROM OINV WHERE DocNum = ?)", [$request->num]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
