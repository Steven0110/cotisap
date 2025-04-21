<?php

namespace App;

use Auth;
use App;
use App\Company;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{

	/**
	 * Funcion para ejecutar queries a SAP dependiendo del ususario conectado
	 *
	 * @param String 
	 * @return Array 
	 */

    private $company;

    protected $connection = 'datos';

    protected $table;

    protected $fillable = [
        'id',
        'name',
        'condiciones',
        'status'
    ];


    public function __construct() {
        $this->table = session('Company').'_notes';
    }    

}
