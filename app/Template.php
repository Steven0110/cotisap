<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
        private $company;

    protected $connection = 'datos';
    protected $table = ''; 

    protected $fillable = [
    	'id',
    	'name',
    	'tipo',
    	'categoria',
    	'data',
    	'dataConfig'
    ];
    public function __construct() {
        $this->table = session('Company').'_template';
    }  
}
