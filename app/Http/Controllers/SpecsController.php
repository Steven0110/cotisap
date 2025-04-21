<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Spec;

class SpecsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('theme.administracion.specs');
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
        $spec = new Spec();
        $spec->nombre = $request->title;
        $spec->descripcion = $request->desc;
        $spec->tipo = $request->type;
        return response()->json([
            'status' => $spec->save(),
            'id' => $spec->id
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
                'data' => Spec::all() 
            ]);
        } else {

            return response()->json([
                'status' => (Spec::find($id)) ? true : false,
                'data' => Spec::find($id)
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
    public function update(Request $request, $id)
    {
        //
        $spec = Spec::find($id);
        $spec->nombre = $request->title;
        $spec->descripcion = $request->desc;
        return response()->json([
            'status' => $spec->save()
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
        $spec = Spec::find($id);
        return response()->json([
            'status' => $spec->delete()
        ]);
    }
}
