<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    //
    protected $table;
    protected $primaryKey = 'key';
    protected $connection = 'datos';
    protected $fillable = [
    	'key',
    	'value',
    	'desc'
    ];

    public function __construct() {
        $this->table = session('Company').'_colors';
    } 
}
