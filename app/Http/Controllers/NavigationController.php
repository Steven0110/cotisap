<?php

namespace App\Http\Controllers;

use App\Lib\Libraries as Lib;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    /**
     *
     *
     * @param String Currency
     * @return Array Data
     */

    public function getCurrency(){
    	return Lib::querySQLSRV("SELECT TOP 1 Currency, Rate FROM ORTT WHERE RateDate = CONVERT(date, getdate()) AND Currency = 'USD'", null);
    }
}
