<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tools;
use App\Http\Requests\ToolsPost;

class ToolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme.administracion.herramientas');
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
    public function store(ToolsPost $request)
    {

        $tool = new Tools();
        $tool->categoria = $request->categoria;
        $tool->marca = $request->marca;
        $tool->titulo = $request->titulo;
        $tool->descripcion = $request->descripcion;
        $tool->archivo = $request->archivo != "" ? $request->archivo->store('public') : "";
        $tool->link = $request->link == null ? "" : $request->link;
        $tool->status = true;
        
        return response()->json([ 
            'status' => $tool->save() 
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

        if(!strcmp($id, 'all')) {
            
            return response()->json([
                'status' => true,
                'data' => Tools::all() 
                ]);
        } else {

            return response()->json([
                'status' => (Tools::find($id)) ? true : false,
                'data' => Tools::find($id)
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ToolsPost $request, $id)
    {
        $tool = Tools::find($id);
        $tool->marca = $request->marca;
        $tool->titulo = $request->titulo;
        $tool->descripcion = $request->descripcion;
        $tool->status = $request->status == "true" ? true : false;

        return response()->json([
            'status' => $tool->save()
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
        $tool = Tools::find($id);
        return response()->json([
            'status' => $tool->delete()
        ]);
    }
}
