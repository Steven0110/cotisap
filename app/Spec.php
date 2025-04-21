<?php

namespace App;

use Auth;
use App;
use App\Company;
use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    //
	/*
		TIPOS:
		0 - Condiciones comerciales
		1 - Consideraciones especiales
		2 - Factores a considerar
		3 - Entrega Express
		4 - Viáticos de consultores
		5 - Alcance de implementación
	*/
    private $company;

    protected $connection = 'datos';
    protected $table;
    protected $fillable = [
    	'id',
    	'nombre',
    	'descripcion',
    	'tipo'
    ];
    
    public function __construct() {
        $this->table = session('Company').'_specs';
    }  
}
