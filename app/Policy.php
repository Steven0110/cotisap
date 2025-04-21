<?php


/**
*
*
* @author GerardoSteven (Steven0110)
*/

namespace App;

use Auth;
use App;
use App\Company;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    private $company;

    protected $connection = 'datos';
    protected $table;
    protected $fillable = [
    	'id',
    	'titulo',
    	'descripcion',
    	'precio'
    ];
    
    public function __construct() {
        
        $this->table = session('Company').'_policies';
    }   
}
