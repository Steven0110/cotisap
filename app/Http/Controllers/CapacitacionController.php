<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Capacitacion;
use App\Http\Requests\CapacitacionPost;

class CapacitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('theme.administracion.capacitacion');
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
    public function store(CapacitacionPost $request){
        //
        $capacitacion = new Capacitacion();
        $capacitacion->titulo = $request->titulo;
        $capacitacion->categoria = $request->categoria;
        $capacitacion->descripcion = $request->descripcion;
        $capacitacion->archivo = $request->archivo != "" ? $request->archivo->store('public') : "";
        $capacitacion->link = $request->link == null ? "" : $request->link ;
        $capacitacion->status = true;
        return response()->json([ 
            'status' => $capacitacion->save() === true ? "true" : "false"
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
        if(!strcmp($id, 'all')) {
            
            return response()->json([
                'status' => true,
                'data' => Capacitacion::all() 
                ]);
        } else {

            return response()->json([
                'status' => (Capacitacion::find($id)) ? true : false,
                'data' => Capacitacion::find($id)
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
    public function update(CapacitacionPost $request, $id)
    {
        //
        $capacitacion = Capacitacion::find($id);
        $capacitacion->titulo = $request->titulo;
        $capacitacion->descripcion = $request->descripcion;
        $capacitacion->status = $request->status == "true" ? true : false;
        return response()->json([
            'status' => $capacitacion->save()
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
        $capacitacion = Capacitacion::find($id);
        return response()->json([
            'status' => $capacitacion->delete()
        ]);
    }
}
