<?php

namespace App\Http\Controllers;

use DB;
use View;
use Input;
use App\Lib\Libraries as Lib;
use App\Http\Controllers\Config;
use App\User;
use App\Rol;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    /*
     * Controladores para la autenticacion de los usuarios
     */

    /**
     *
     * @param void
     * @return view
     */

    public function showLogin()
    {
    	
    	if (Auth::check()) {
    		
            if( !strcmp('cotisap.com', explode('@', Auth::user()->email)[1]) ){
                return redirect()->route('sDashboard');
            }else return redirect()->route('dashboard');
    	}    	
    
    	return \View::make('login');
    }

    /**
     *
     * @param void
     * @return view
     */

    public function postLogin(Request $request) 
    {

    	$userData = array(
    		'email' => $request->username,
    		'password' => $request->password
    	);
        
        if($request->username == 'admin'){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('sDashboard');
        }

    	if(Auth::attempt($userData)) {
            if( !strcmp('cotisap.com', explode('@', Auth::user()->email)[1]) ){
                return redirect()->route('sDashboard');
            } else {

                $email = Auth::user()->email;

                $company = Company::where('dominio' ,explode('@', $email)[1])
                        ->get();


                session([
                    'HOST_Sap' => $company[0]->HOST_Sap,
                    'PORT_Sap' => $company[0]->PORT_Sap,
                    'DB_Sap' => $company[0]->DB_Sap,
                    'USER_Sap' => $company[0]->USER_Sap,
                    'PASS_Sap' => $company[0]->PASS_Sap,
                    'HOST_SAP_API' => $company[0]->HOST_SAP_API,
                    'USER_SAP_API' => $company[0]->USER_SAP_API,
                    'PASS_SAP_API' => $company[0]->PASS_SAP_API,
                    //'access_token' => $dataToken,
                    'DB_SAP_API' => $company[0]->DB_SAP_API,
                    'Company' => $company[0]->Company,
                    'factClave' => $company[0]->factClave,
                    'FatherNum' => $company[0]->FatherNum,
                    'domain' => $company[0]->dominio
                ]);

                /*Set Theme Colors in Cookies*/
                $sql = 'SELECT * FROM '.$company[0]->Company.'_colors';
                $colors = Lib::querySQLMYSQL($sql);
                $cookie = cookie()->forever('colors', json_encode($colors));
                
                return redirect()->route('dashboard')->withCookie($cookie);;
            } 
    	}

    	return redirect()
    			->route('login')
    			->with('mensaje_error', 'Tus datos son incorrectos');

    }

    /**
     *
     * @param void
     * @return view
     */

    public function logOut()
    {
        
        Auth::logout();

        return redirect()
                ->route('login')
                ->with('mensaje_error', 'Tu sesión ha sido cerrada.');


    }


    public function ShowUsers(Request $request){

        $Usuarios = User::where(
            'email',
            'like',
            '%@'.explode('@',Auth::user()->email)[1]
        )->get();
        
        $roles = Rol::all();

        return view('theme.administracion.usuarios', [
            'usuarios' => $Usuarios,
            'roles' => $roles
        ]);
    }


    public function setRol(Request $request){

        $rol = Rol::find($request->id);
        $rol->dataConfig = json_encode($request->dataConfig);

        return response()->json([ 
            'status' => $rol->save() === true ? "true" : "false"
            ]);

    }

    public function getRol(Request $request){

        $rol = Rol::find($request->id);

        return $rol;

    }


}
