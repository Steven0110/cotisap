<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lib\Libraries as Lib;
use App\Quotation;
use App\User;


class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return View('theme.administracion.monitor');
    }
    public function searchSalesPersons(Request $request){
        $slp = Auth::user()->SlpCode;
        //return Auth::user();
        return Lib::querySQLSRV("SELECT SlpCode as id, SlpName AS text FROM OSLP WHERE U_manager = ? AND SlpName LIKE ? UNION SELECT SlpCode as id, SlpName AS text FROM OSLP WHERE SlpCode = ? AND SlpName LIKE ?", 
            [ $slp, '%'.$request->q.'%', $slp, '%'.$request->q.'%' ]);
    }
    public function getSalesPersons(Request $request){
        $slp = Auth::user()->SlpCode;
        $actives = Lib::querySQLSRV("SELECT SlpCode as id, SlpName AS text FROM OSLP WHERE U_manager = ? AND Active = 'Y' UNION SELECT SlpCode as id, SlpName AS text FROM OSLP WHERE SlpCode = ? AND Active = 'Y'", 
            [ $slp, $slp ] );
        $inactives = Lib::querySQLSRV("SELECT SlpCode as id, SlpName AS text FROM OSLP WHERE U_manager = ? AND Active = 'N' UNION SELECT SlpCode as id, SlpName AS text FROM OSLP WHERE SlpCode = ? AND Active = 'N'", 
            [ $slp, $slp ] );
        return response()->json([
            'actives' => $actives,
            'inactives' => $inactives
        ]);
    }
    public function getProgress(Request $request){
        $user = User::where('SlpCode', $request->slp )->first();
        $email = $user->email;

        $quotations = Quotation::where('created_at', '>=', $request->from)
                ->where('created_at', '<=', $request->to)
                ->where('idVendedor', $email)
                ->get();
        /*$quotations = Lib::querySQLMYSQL("SELECT numCotizacion, created_at FROM quotations WHERE idVendedor = ? AND created_at >= ? AND created_at <= ? ORDER BY 2 DESC", 
            [ $request->email, $request->from, $request->to ]
        );*/

        $progress = array();
        foreach( $quotations as $quotation ){
            array_push( $progress, [
                    'progress' => Lib::querySQLSRV("DECLARE @cotID varchar(30) = ?;
                        SELECT (SELECT COUNT(*) FROM OQUT WHERE NumAtCard LIKE @cotID AND DocDate > '2016-01-01 00:00:00.000') Q,
                        (SELECT COUNT(*) FROM ORCT WHERE CounterRef LIKE @cotID AND DocDate > '2016-01-01 00:00:00.000') P,
                        (SELECT COUNT(*) FROM ORDR WHERE NumAtCard LIKE @cotID AND DocDate > '2016-01-01 00:00:00.000') R,
                        (SELECT TOP 1 DocNum FROM ORDR WHERE NumAtCard LIKE @cotID AND DocDate > '2016-01-01 00:00:00.000') Rnum,
                        (SELECT COUNT(*) FROM ODLN WHERE NumAtCard LIKE @cotID AND DocDate > '2016-01-01 00:00:00.000') D,
                        (SELECT TOP 1 DocNum FROM ODLN WHERE NumAtCard LIKE @cotID AND DocDate > '2016-01-01 00:00:00.000') Dnum,
                        (SELECT COUNT(*) FROM ODLN WHERE NumAtCard LIKE @cotID AND DocStatus = 'C' AND DocDate > '2016-01-01 00:00:00.000') C,
                        (SELECT TOP 1 DocNum FROM ODLN WHERE NumAtCard LIKE @cotID AND DocStatus = 'C' AND DocDate > '2016-01-01 00:00:00.000') Cnum,
                        (SELECT COUNT(*) FROM OINV WHERE NumAtCard LIKE @cotID AND DocDate > '2016-01-01 00:00:00.000') I,
                        (SELECT TOP 1 DocNum FROM OINV WHERE NumAtCard LIKE @cotID AND DocDate > '2016-01-01 00:00:00.000') Inum", ["%".$quotation->numCotizacion."%"])[0],
                    'quotation' => $quotation
                ]
            );
        }
        return response()->json([
            'progress' => $progress,
            'quotations' => $quotations,
            'status' => true
        ]);
    }
    public function getOrdersInfo(Request $request){
        $slp = implode(',', $request->slp);
        return response()->json([
            'orders' => Lib::querySQLSRV("SELECT T1.NumAtCard, (T1.CardName + ' - ' + T1.CardCode) AS Cliente, T2.SlpName, T2.SlpCode, T1.DocDate, T1.DocTotal FROM ORDR T1, OSLP T2 WHERE T1.SlpCode = T2.SlpCode AND T1.DocStatus = 'O' AND T1.SlpCode IN (".$slp.") ORDER BY T2.SlpName ASC, T1.DocDate DESC")
            //'orders' => Lib::querySQLSRV("SELECT TOP 10 SlpName FROM OSLP")
        ]);
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
