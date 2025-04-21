<?php

namespace App;

use Auth;
use App;
use App\Company;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
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
    	'nombreCliente',
    	'totalMXN',
    	'totalUSD',
    	'total',
    	'comentarios',
    	'idVendedor',
    	'tc',
    	'estatus',
    	'numCliente',
    	'notasCotizacion',
        'fechaEntrega',
    	'tipoEntrega',
    	'personaEntrega',
    	'telefonoEntrega',
    	'correoEntrega',
    	'direccionEntrega',
    	'fleteraEntrega',
    ];

    public function __construct() {
        $this->table = session('Company').'_quotations';
    }    

}
