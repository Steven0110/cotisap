<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
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
    	'clienteNombre',
    	'clienteEmail',
    	'clienteTelefono',
        'clienteRazon',
        'clienteLimit'
    ];

    public function __construct() {
        $this->table = session('Company').'_customers';
    }
}
