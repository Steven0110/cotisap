<?php

use App\Company;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $company = App\Company::all();   
        
        Schema::connection('datos')->create($company[0]->Company.'_quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numCotizacion', 250)->unique();
            $table->string('nombreCliente');
            $table->decimal('totalMXN', 20, 2);
            $table->decimal('totalUSD', 20, 2);
            $table->decimal('total', 20, 2);
            $table->string('comentarios');
            $table->string('idVendedor');
            $table->string('tc');
            $table->string('estatus');
            $table->string('numCliente');
            $table->integer('notasCotizacion');
            $table->date('fechaEntrega');
            $table->string('tipoEntrega');
            $table->string('personaEntrega');
            $table->string('telefonoEntrega');
            $table->string('correoEntrega');
            $table->string('direccionEntrega');
            $table->string('fleteraEntrega');
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
        $company = App\Company::all(); 
        Schema::dropIfExists($company[0]->Company.'quotations');
    }
}
