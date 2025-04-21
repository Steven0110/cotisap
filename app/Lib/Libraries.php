<?php 

namespace App\Lib;

/**
* Clase de Librerias Generales en cotiSAP
*
* @author sergiomireles.com
*/

use Auth;
use App;
use Config;
use DB;
use \Crypt;
use App\Company;
use Illuminate\Http\Request;

class Libraries
{

	/**
	 * Funcion para ejecutar queries a SAP dependiendo del ususario conectado
	 *
	 * @param String QueryToMSSQL
	 * @return Array DataOfMSSQL
	 */

  	public static function querySQLSRV ($sql = null, $param = null) {
  		
        $connectionName = \Crypt::encryptString(str_random(80));
        
        DB::purge("$connectionName");

        Config::set("database.connections.$connectionName", [
            "driver" => "sqlsrv",
            "port" => session('PORT_Sap'),
            "host" => session('HOST_Sap'),
            "database" => session('DB_Sap'),
            "username" => session('USER_Sap'),
            "password" => session('PASS_Sap')
        ]);        

        if($param){
          $query = DB::connection("$connectionName")->select($sql, $param);
        } else {
          $query = DB::connection("$connectionName")->select($sql);
        }
          
        return self::convert_from_latin1_to_utf8_recursively($query);
    }


  /**
   * Funcion para ejecutar queries a SAP dependiendo del ususario conectado
   *
   * @param String QueryToMSSQL
   * @return Array DataOfMSSQL
   */

    public static function querySQLSRV2 ($sql = null, $param = null) {
      
        $connectionName = \Crypt::encryptString(str_random(80));
        
        DB::purge("$connectionName");

        Config::set("database.connections.$connectionName", [
            "driver" => "sqlsrv",
            "port" => session('PORT_Sap'),
            "host" => session('HOST_Sap'),
            "database" => session('DB_Sap'),
            "username" => session('USER_Sap'),
            "password" => session('PASS_Sap')
        ]);        

        if($param){
          $query = DB::connection("$connectionName")->select($sql, $param);
        } else {
          $query = DB::connection("$connectionName")->select($sql);
        }
          
        return $query;
    }


	/**
	 * Funcion para ejecutar queries a la DB correspodiente en MySQL dependiendo del ususario conectado
	 *
	 * @param String QueryToMySQL
	 * @return Array DataOfMySQL
	 */

    public static function querySQLMYSQL ($sql = null, $param = null) {

        if($param){
          $query = DB::connection("datos")->select($sql, $param);
        } else {
          $query = DB::connection("datos")->select($sql);
        }
        return $query;
    }

  /**
   * Funcion para ejecución de stored procedure
   *
   * @param String QueryToMySQL
   * @return Array DataOfMySQL
   */
  	public static function executeStoredProcedure($sql = null, $param = null) {

        $connectionName = \Crypt::encryptString(str_random(80));
        
        DB::purge("$connectionName");

        Config::set("database.connections.$connectionName", [
            "driver" => "mysql",
            "port" => "3306",
            "host" => '104.40.75.128',
            "database" => 'cotisap_01',
            "username" => 'cotisap_01',
            "password" => '060OXDW0OQ3Z'
        ]);        

        $query = DB::connection("$connectionName")->select($sql, $param);
        return $query;

    }

  /**
   * Funcion para ejecutar Encripacion de contraseña
   *
   * @param String QueryToMySQL
   * @return Array DataOfMySQL
   */


    public static function getGUID(){

      if (function_exists('com_create_guid')){
        return com_create_guid();
      }
      else {
        mt_srand((double)microtime()*10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);
        $uuid = 
             substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4);
            
        return $uuid;
      }
    }

  /**
   * Funcion para ejecutar Encripacion de contraseña
   *
   * @param String QueryToMySQL
   * @return Array DataOfMySQL
   */

  public static function querySQLSRV_TER($host, $user, $pass, $db_name, $sql = null, $param = null){

        $connectionName = \Crypt::encryptString(str_random(80));
        
        DB::purge("$connectionName");

        Config::set("database.connections.$connectionName", [
            "driver" => "sqlsrv",
            "port" => "1433",
            "host" => $host,
            "database" => $db_name,
            "username" => $user,
            "password" => $pass
        ]);        

        if($param){
          $query = DB::connection("$connectionName")->select($sql, $param);
        } else {
          $query = DB::connection("$connectionName")->select($sql);
        }
          
        return $query;   
  }

  public static function testSQLSRVConnection($host, $user, $pass, $db_name){

        $connectionName = \Crypt::encryptString(str_random(80));
        
        DB::purge("$connectionName");
        Config::set("database.connections.$connectionName", [
            "driver" => "sqlsrv",
            "port" => "1433",
            "host" => $host,
            "database" => $db_name,
            "username" => $user,
            "password" => $pass
        ]);
        try{
          DB::connection("$connectionName")->getPdo();
            return true;
        }catch(\Exception $e){
          return false;
        }

  }
  
  public static function testMySQLConnection($host, $user, $pass, $db_name){

        $connectionName = \Crypt::encryptString(str_random(80));
        
        DB::purge("$connectionName");
        Config::set("database.connections.$connectionName", [
            "driver" => "mysql",
            "port" => "3306",
            "host" => $host,
            "database" => $db_name,
            "username" => $user,
            "password" => $pass
        ]);
        try{
          DB::connection("$connectionName")->getPdo();
            return true;
        }catch(\Exception $e){
          return false;
        }

  }
  
  public static function getSlpCodeByEmail($email){
    $slp = self::querySQLSRV('SELECT SlpCode FROM OSLP WHERE Email = ?', [ $email ]);
    return $slp[ 0 ];
  }
  public static function checkU_Sigla03(){
    $u_sigla = self::querySQLSRV("SELECT COUNT(*) AS n FROM sys.columns WHERE Name = N'U_Sigla03' AND Object_ID = Object_ID(N'INV1');");
    return $u_sigla[0]->n != 0;
  }


  public static function convert_from_latin1_to_utf8_recursively($dat)
   {
      if (is_string($dat)) {
         return utf8_encode($dat);
      } elseif (is_array($dat)) {
         $ret = [];
         foreach ($dat as $i => $d) $ret[ $i ] = self::convert_from_latin1_to_utf8_recursively($d);

         return $ret;
      } elseif (is_object($dat)) {
         foreach ($dat as $i => $d) $dat->$i = self::convert_from_latin1_to_utf8_recursively($d);

         return $dat;
      } else {
         return $dat;
      }
   }

}