<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
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
    	'numCotizacion',
    	'metodo',
    	'monto',
    	'moneda',
    	'date',
    	'comprobante',
    	'status'
    ];

    public function __construct() {
        $this->table = session('Company').'_payment';
    }  
}
