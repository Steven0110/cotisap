<?php

namespace App;

use Auth;
use App;
use App\Company;
use Illuminate\Database\Eloquent\Model;

class ArtQuotation extends Model
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
    	'numLine',
    	'codigoArt',
    	'nombreArt',
    	'cantidad',
    	'moneda',
    	'precioLista',
    	'UMV',
    	'precioUnidad',
    	'factor',
    	'subTotalLinea',
    	'almacen',
    	'tiempoEntrega',
    	'observaciones'
    ];

    public function __construct() {
        $this->table = session('Company').'_art_quotations';
    }

}
