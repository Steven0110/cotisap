<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteSAPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('theme.solicitudes.alta-cliente');
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
        $raw_body = "";
        
        $raw_body .= "<h1>Se ha agregado un cliente</h1>";
        //  INFORMACIÓN GENERAL
        $raw_body .= '<h2>Información general</h2>';
        $raw_body .= '<p>'.$request->nombre_gral.'</p>';
        $raw_body .= '<p>'.$request->rfc_gral.'</p>';
        $raw_body .= '<p>'.$request->tel_gral.'</p>';
        $raw_body .= '<p>'.$request->email_gral.'</p>';
        $raw_body .= '<p>'.$request->web_gral.'</p>';
        $raw_body .= '<p>'.$request->persona_gral.'</p>';

        //  INFORMACIÓN FISCAL
        $raw_body .= '<h2>Dirección fiscal</h2>';
        $raw_body .= '<p>'.$request->calle_fiscal.'</p>';
        $raw_body .= '<p>'.$request->colonia_fiscal.'</p>';
        $raw_body .= '<p>'.$request->ciudad_fiscal.'</p>';
        $raw_body .= '<p>'.$request->municipio_fiscal.'</p>';
        $raw_body .= '<p>'.$request->pais_fiscal.'</p>';
        $raw_body .= '<p>'.$request->cp_fiscal.'</p>';

        //  INFORMACIÓN DE ENVIO
        $raw_body .= '<h2>Dirección envio</h2>';
        $raw_body .= '<p>'.$request->calle_envio.'</p>';
        $raw_body .= '<p>'.$request->colonia_envio.'</p>';
        $raw_body .= '<p>'.$request->ciudad_envio.'</p>';
        $raw_body .= '<p>'.$request->municipio_envio.'</p>';
        $raw_body .= '<p>'.$request->pais_envio.'</p>';
        $raw_body .= '<p>'.$request->cp_envio.'</p>';

        //  PERSONAS DE CONTACTO
        $personas = json_decode($request->personas);
        foreach($personas as $p){
            $raw_body .= '<h2>Persona de contacto ('.$p->tipo.')</h2>';
            $raw_body .= '<p>Nombre: '.$p->nombre.'</p>';
            $raw_body .= '<p>Email: '.$p->email.'</p>';
            $raw_body .= '<p>Telefono: '.$p->telefono.'</p>';
        }


        /************************** GUARDAR CLIENTE EN BASE DE DATOS ********************************/

        return response()->json([ 
            'status' => MailController::sendMail(
                            "DATOS REGISTRADOS",
                            $raw_body,
                            false,
                            "Registro de cliente realizado",
                            [$request->email_gral, 'gcabello@mbrhosting.com']
                        )
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
