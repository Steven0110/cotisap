<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecsType extends Model
{
    private $company;

    protected $connection = 'datos';
    protected $table;
    protected $fillable = [
        'id',
        'tipo',
    	'name'
    ];
    
    public function __construct() {
        $this->table = session('Company').'_specs_tipo';
    }  
}
