<?php

namespace App\Http\Controllers;

use App\Lib\Libraries as Lib;
use Illuminate\Http\Request;


class testController extends Controller
{
    public function index () 
    {
    	dd(Lib::querySQLSRV('SELECT * FROM OSLP'));
    }
}
