<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\Libraries as Lib;

class AccountController extends Controller
{
    //
    public function index(){
    	return View('theme.administracion.profile');
    }
    public function getInfo(Request $request){
    	$info = Lib::querySQLSRV("SELECT A.*, B.SlpName AS Gerente FROM 
				(
					SELECT SlpName, SlpCode, Commission, ISNULL(Telephone, 'N/A') AS Telephone, ISNULL(Email, 'N/A') AS Email, 
					(CASE 
						WHEN U_manager = '0' THEN SlpCode 
						WHEN U_manager IS NULL THEN SlpCode 
						ELSE U_manager END) AS 'ManagerCode' 
					FROM OSLP
					WHERE Email = ?
				) A, OSLP B
				WHERE A.ManagerCode = B.SlpCode", [$request->email]);
    	return response()->json([
    		'general_info' => $info
    	]);
    }
}
