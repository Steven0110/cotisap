<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\Libraries as Lib;
use App\company;
use App\Http\Requests\CompaniesPost;
class SuperadminController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCreate(){
        return View('clean-theme.modules.create');
    }
    public function indexRead(){
        return View('clean-theme.modules.read');
    }
    public function indexUpdate(){
        return View('clean-theme.modules.update');
    }
    public function indexDelete(){
        return View('clean-theme.modules.delete');
    }
    public function testSAP(Request $request){
        return response()->json([
            'status' => Lib::testSQLSRVConnection(
                $request->host,
                $request->user,
                $request->psw,
                $request->dbname
            )
        ]);
    }
    public function testMySQL(Request $request){
        return response()->json([
            'status' => Lib::testMySQLConnection(
                $request->host,
                $request->user,
                $request->psw,
                $request->dbname
            )
        ]);
    }
    public function getSQLFile(Request $request){
        $data = [
            'prefix' => $request->prefix,
            'dbname' => $request->dbname
        ];
        return View('sql.ddl_new_company')->with(compact('data'))->render();
    }
    public function createCompany(Request $request){
        $company = new company();
        $company->status = '1';
        $company->Nombre = $request->company_name;
        $company->Company = $request->company_prefix;
        $company->logo = $request->company_url_logo;
        $company->dominio = $request->company_domain;
        $company->HOST_Sap = $request->sap_host;
        $company->USER_Sap = $request->sap_user;
        $company->PASS_Sap = $request->sap_psw;
        $company->DB_Sap = $request->sap_dbname;
        $company->HOST_cotiSap = $request->mysql_host;
        $company->USER_cotiSap = $request->mysql_user;
        $company->PASS_cotiSap = $request->mysql_psw;
        $company->DB_cotiSap = $request->mysql_dbname;
        $company->SMTP_host = '0';
        $company->SMTP_port = '0';
        $company->SMTP_user = '0';
        $company->SMTP_pass = '0';
            //Si selecciona la base de MySQL[INTERNA]
        if($company->DB_cotiSap == '-1'){
            $company->HOST_cotiSap = '104.40.75.128';
            $company->DB_cotiSap = 'cotisap_01';
            $company->USER_cotiSap = 'cotisap_01';
            $company->PASS_cotiSap = '060OXDW0OQ3Z';
            Lib::executeStoredProcedure('CALL createCompany("'.$request->company_prefix.'")', [$request->company_prefix]);
        }
        return response()->json([
            'status' => $company->save()
        ]);
    }
    public function getUpdatePopup(){
        return View('clean-theme.parts.update-fragment');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(!strcmp($id, 'all')) {
            return response()->json([
                'status' => true,
                'data' => company::all() 
            ]);
        }else{
            return response()->json([
                'status' => (company::find($id)) ? true : false,
                'data' => company::find($id)
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompaniesPost $request, $id){
        $company = company::find($id);
        $company->Nombre = $request->name;
        $company->dominio = $request->domain;
        $company->HOST_Sap = $request->sap_host;
        $company->USER_Sap = $request->sap_user;
        $company->PASS_Sap = $request->sap_psw;
        $company->DB_Sap = $request->sap_dbname;
        $company->HOST_cotiSap = $request->mysql_host;
        $company->USER_cotiSap = $request->mysql_user;
        $company->PASS_cotiSap = $request->mysql_psw;
        $company->DB_cotiSap = $request->mysql_dbname;
        $company->logo = $request->url;
        return response()->json([
            'status' => $company->save()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
        $company = company::find($id);;
        $company->status = 0;
        return response()->json([
            'status' => $company->save()
        ]);
        
    }
}
