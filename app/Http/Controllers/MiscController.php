<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Lib\Libraries as Lib;
use App\company;
use App\Colors;
use Cookie;

class MiscController extends Controller
{
    //
    public function getCustomisationIndex(Request $request){
    	return View('theme.administracion.colores');
    }
        /*Custom Color changes*/
        /**
         *
         *  0   =>  Main Dashboard Header
         *  1   =>  Sidebar
         *  2   =>  SIdebar KPI
         *  3   =>  SIdebar Color (fuente)
         *  4   =>  Header Background
         *  5   =>  Searchbox Background
         *  6   =>  Btn primary
         *  7   =>  Btn Success
         *  8   =>  Btn Info
         *  9   =>  Btn Warning
         *  10   =>  Btn Danger
         *
         *
         **/
    public function loadColors(Request $request){
    	$company = session('Company');
        $sql = 'SELECT * FROM '.$company.'_colors';
        $colors = Lib::querySQLMYSQL($sql);
        return response()->json([
        	'colors' => $colors,
        	'status' => true
        ]);
    }
    public function saveColors(Request $request){
    	$company = session('Company');

    	$color = Colors::find('header_background');
    	$color->value = $request->header_background;
    	$color->save();

    	$color = Colors::find('header_color');
    	$color->value = $request->header_color;
    	$color->save();

    	$color = Colors::find('sidebar_background');
    	$color->value = $request->sidebar_background;
    	$color->save();

    	$color = Colors::find('sidebar_color');
    	$color->value = $request->sidebar_color;
    	$color->save();

    	$color = Colors::find('sidebar_kpi_background');
    	$color->value = $request->sidebar_kpi_background;
    	$color->save();

    	$color = Colors::find('searchbox_background');
    	$color->value = $request->searchbox_background;
    	$color->save();

    	$color = Colors::find('btn_primary');
    	$color->value = $request->btn_primary;
    	$color->save();

    	$color = Colors::find('btn_success');
    	$color->value = $request->btn_success;
    	$color->save();

    	$color = Colors::find('btn_info');
    	$color->value = $request->btn_info;
    	$color->save();

    	$color = Colors::find('btn_warning');
    	$color->value = $request->btn_warning;
    	$color->save();

    	$color = Colors::find('btn_danger');
    	$color->value = $request->btn_danger;
    	$color->save();

    	/*Set COOKIE*/
        $sql = 'SELECT * FROM '.$company.'_colors';
        $colors = Lib::querySQLMYSQL($sql);
        $cookie = cookie()->forever('colors', json_encode($colors));

        return response()->json([
        	'status' => true
        ])->withCookie($cookie);
    }
}
