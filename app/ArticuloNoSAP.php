<?php


/**
*
* @author GerardoSteven (Steven0110)
*/


namespace App;

use Auth;
use App;
use App\Company;
use Illuminate\Database\Eloquent\Model;

class ArticuloNoSAP extends Model
{
    //
    private $company;

    protected $connection = 'datos';
    protected $table;
    protected $fillable = [
    	'id',
    	'codigo',
    	'descripcion',
    	'clase',
    	'grupo',
    	'lista',
    	'UMV',
    	'precio',
    	'moneda',
    	'comentarios',
    	'user_id',
    	'status',
    ];
    
    public function __construct() {
        $this->table = session('Company').'_articulos';
    }    
}
