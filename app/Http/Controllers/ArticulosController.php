<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use DB;
use Config;
use App\Lib\Libraries as Lib;
use App\ArticuloNoSAP;
use App\Http\Requests\ArticulosPost;
use Auth;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('theme.administracion.articulos');
    }

    public function newArticulo(){
        return view('theme.cotizaciones.nuevo-articulo',[
            'udm' => self::getUDM()
        ]);
    }


    /**
     * Unidades de medida
     */

    public function getUDM(){
        return Lib::querySQLSRV("SELECT UomCode, UomName FROM OUOM WHERE UomEntry > 0", null);
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
    public function getArticles(Request $request){
        $email = Auth::user()->email;
        $company = App\Company::where('dominio' ,explode('@', $email)[1])
                ->get();

        $connectionName = \Crypt::encryptString(str_random(80));
        DB::purge("$connectionName");
        Config::set("database.connections.$connectionName", [
            "driver" => "mysql",
            "port" => "3306",
            "host" => $company[0]->HOST_cotiSap,
            "database" => $company[0]->DB_cotiSap,
            "username" => $company[0]->USER_cotiSap,
            "password" => $company[0]->PASS_cotiSap
        ]);
        return DB::connection("$connectionName")->select("SELECT codigo as id, CONCAT(codigo, ' - ', descripcion ) as text FROM ".session('Company').'_articulos'." WHERE codigo LIKE ? OR descripcion LIKE ?", ['%'.$request->q.'%', '%'.$request->q.'%']);
    }
    public function getArticleInfo(Request $request){
        return ArticuloNoSAP::where('codigo', $request->code)->first();
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
        $slp = Auth::user()->SlpCode;
        $art = new ArticuloNoSAP();
        $art->codigo = $request->codigo;
        $art->descripcion = $request->desc;
        $art->clase = $request->clase;
        $art->grupo = $request->grupo;
        $art->lista = $request->lista;
        $art->UMV = $request->UMV;
        $art->precio = $request->precio;
        $art->moneda = $request->moneda;
        $art->comentarios = $request->comm == null ? '' : $request->comm ;
        $art->status = 1;
        $art->user_id = $slp;
        return response()->json([
            'status' => $art->save()
        ]);
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
        //
        if(!strcmp($id, 'all')) {
            
            return response()->json([
                'status' => true,
                'data' => ArticuloNoSAP::all() 
                ]);
        } else {

            return response()->json([
                'status' => (ArticuloNoSAP::find($id)) ? true : false,
                'data' => ArticuloNoSAP::find($id)
                ]);
        }
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
    public function update(ArticulosPost $request, $id)
    {
        //
        $articulo = ArticuloNoSAP::find($id);
        $articulo->descripcion = $request->descripcion;
        //$articulo->nombre = $request->nombre;
        $articulo->comentarios = $request->comentarios;
        $articulo->lista = $request->lista;
        $articulo->precio = $request->precio;
        $articulo->moneda = $request->moneda;
        $articulo->umv = $request->umv;
        $articulo->status = $request->status == "true" ? true : false;
        return response()->json([
            'status' => $articulo->save()
            ]);

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
        $articulo = ArticuloNoSAP::find($id);
        return response()->json([
            'status' => $articulo->delete()
        ]);
    }
}
