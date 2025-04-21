<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = [
    	'id',
    	'status',
    	'Nombre',
    	'Company',
    	'logo',
    	'dominio',
    	'HOST_Sap',
    	'USER_Sap',
    	'PASS_Sap',
    	'DB_Sap',
    	'HOST_cotiSap',
    	'USER_cotiSap',
    	'PASS_cotiSap',
    	'DB_cotiSap',
    	'SMTP_host',
    	'SMTP_port',
    	'SMTP_user',
    	'SMTP_pass'
    ];
}