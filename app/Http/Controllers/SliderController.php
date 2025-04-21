<?php


/**
*   @author Gerardo Steven
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Http\Requests\SlidersPost;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('theme.administracion.slider');
        //
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
     * @return \App\AuxiliarClasses\JSONResponse
     */
    public function store(SlidersPost $request){
    	$slider = new Slider();
    	$slider->titulo = $request->titulo;
    	$slider->archivo = $request->archivo->store('public');
    	$slider->interno = $request->esInterno == "true" ? true : false;
        $slider->cliente = $request->esExterno == "true" ? true : false;
        $slider->status = true;
        return response()->json([ 
            'status' => $slider->save() === true ? "true" : "false"
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
                'data' => Slider::all() 
                ]);
        } else {

            return response()->json([
                'status' => (Slider::find($id)) ? true : false,
                'data' => Slider::find($id)
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
    public function update(SlidersPost $request, $id)
    {
        //
        $slider = Slider::find($id);
        $slider->titulo = $request->titulo;
        $slider->interno = $request->esInterno == "true" ? true : false;
        $slider->cliente = $request->esExterno == "true" ? true : false;
        $slider->status = $request->status == "true" ? true : false;
        return response()->json([
            'status' => $slider->save()
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
        $slider = Slider::find($id);
        return response()->json([
            'status' => $slider->delete()
        ]);

    }
}
