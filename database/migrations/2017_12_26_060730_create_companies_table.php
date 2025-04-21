<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            
            $table->increments('id');

            $table->boolean('status',1);

            $table->string('Nombre');
            $table->string('Company');
            $table->string('logo');
            $table->string('dominio');
            
            $table->string('HOST_Sap');
            $table->string('USER_Sap');
            $table->string('PASS_Sap');
            $table->string('DB_Sap');
            
            $table->string('HOST_cotiSap');
            $table->string('USER_cotiSap');
            $table->string('PASS_cotiSap');
            $table->string('DB_cotiSap');

            $table->string('SMTP_host');
            $table->string('SMTP_port');
            $table->string('SMTP_user');
            $table->string('SMTP_pass');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
