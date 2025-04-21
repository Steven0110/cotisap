<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policy;
class PolicyController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    	return view('theme.administracion.polizas');
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(!strcmp($id, 'all')) {
            return response()->json([
                'status' => true,
                'data' => Policy::all() 
            ]);
        } else {

            return response()->json([
                'status' => (Policy::find($id)) ? true : false,
                'data' => Policy::find($id)
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $policy = new Policy();
        $policy->titulo = $request->title;
        $policy->descripcion = $request->desc;
        $policy->precio = $request->price;

        return response()->json([
            'status' => $policy->save(),
            'id' => $policy->id
        ]);
    }
    public function update(Request $request, $id){
        $policy = Policy::find($id);
        $policy->titulo = $request->title;
        $policy->descripcion = $request->desc;
        $policy->precio = $request->price;

        return response()->json([
            'status' => $policy->save()
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
        $policy = Policy::find($id);
        return response()->json([
            'status' => $policy->delete()
        ]);

    }
}
