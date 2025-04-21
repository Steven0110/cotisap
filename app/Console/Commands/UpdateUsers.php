<?php

namespace App\Console\Commands;

Use DB;
Use Cache;
use App\User;
use App\Company;
use App\Lib\Libraries as Lib;
use Illuminate\Console\Command;

class UpdateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'Command:UpdateUsers';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Actualiza la lista de usuarios activos en la plataforma';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle()
    {

        /*** Obtenermos los usuarios actuales en SAP ***/
        print('1');
        $Usuarios = User::all();

        /*** Obtenermos los usuarios actuales en CotiSAP ***/

        print('2');
        $companies = Company::all();

        print('3');
        foreach ($companies as $company) {
            if($company->Nombre == 'Alianza Electrica') continue;
            if($company->Nombre == 'MBR Hosting') continue;
            if($company->Nombre == 'idited') continue;
            print($company->Nombre);
           $users_SAP = Lib::querySQLSRV_TER($company->HOST_Sap, $company->USER_Sap, $company->PASS_Sap, $company->DB_Sap,
            "SELECT * FROM OSLP WHERE Active = 'Y' AND SlpCode > 0 AND Email <> ''"
           );

           self::deleteUsers($Usuarios, $users_SAP, $company->dominio);
           self::addUsers($Usuarios, $users_SAP, $company->dominio);
           
        }

    }


    /**
     *
     *
     *
     *@return Array NewUsers
     */

    public function deleteUsers($db_cotiSAP, $db_SAP, $dominio){

        $diff = [];
        $break = false;
        foreach( $db_cotiSAP as $cotiSAPUser ){
            /*Exceptuamos cotisap.com del borrado*/
            if( !strcmp('cotisap.com', explode('@', $cotiSAPUser->email)[1]) || strcmp($dominio, explode('@', $cotiSAPUser->email)[1]) )
                continue;
            foreach( $db_SAP as $SAPUser ){
                if(!strcmp($SAPUser->Email, $cotiSAPUser->email)){
                    $break = true;
                    break;
                }
            }
            if( $break ){
                $break = false;
            }else{

                $diff[][] = $cotiSAPUser->email;
            
            }
        }
        
        $usuarioDelete = User::whereIn('email', $diff )->delete();

    }




    public function addUsers($db_cotiSAP, $db_SAP, $dominio){

        $diff = [];
        $break = false;

        foreach( $db_SAP as $SAPUser ){
            foreach( $db_cotiSAP as $cotiSAPUser ){
                if(!strcmp($SAPUser->Email, $cotiSAPUser->email)){
                    $break = true;
                    break;
                }
            }
            if( $break ){
                $break = false;
            }else{
                /*Este usuario se tiene qué agregar*/
               if(!strcmp($dominio, explode('@', $SAPUser->Email)[1])){
                    DB::table('users')->insert([
                        'name'  => $SAPUser->SlpName,
                        'email'     => $SAPUser->Email,
                        'password' => \Hash::make($SAPUser->U_pass),
                        'Commission' => $SAPUser->Commission,
                        'GroupCode' => $SAPUser->GroupCode,
                        'Locked' => $SAPUser->Locked,
                        'DataSource' => $SAPUser->DataSource,
                        'UserSign' => $SAPUser->UserSign,
                        'EmpID' => $SAPUser->EmpID,
                        'Active' => $SAPUser->Active,
                        'Telephone' => $SAPUser->Telephone,
                        'Mobil' => $SAPUser->Mobil,
                        'SlpCode' => $SAPUser->SlpCode,
                        'U_admin' => $SAPUser->U_admin,
                        'U_branch' => $SAPUser->U_branch,
                        'U_salt' => $SAPUser->U_salt,
                        'U_priceList' => $SAPUser->U_priceList,
                        'U_manager' => $SAPUser->U_manager,
                        'U_export' => $SAPUser->U_export,
                        'U_discounts' => $SAPUser->U_discounts
                    ]);  
               }
                
            }
        }

    }

    public function updateUsers($db_cotiSAP, $db_SAP, $dominio){



    }


}
