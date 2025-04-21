<?php

use App\Company;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $company = App\Company::all();

        Schema::connection('datos')->create($company[0]->Company.'_art_quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numCotizacion', 250)->unique();
            $table->string('numLine');
            $table->string('codigoArt');
            $table->string('nombreArt');
            $table->integer('cantidad');
            $table->string('moneda');
            $table->string('precioLista');
            $table->string('UMV');
            $table->string('precioUnidad');
            $table->string('factor');
            $table->string('subTotalLinea');
            $table->string('almacen');
            $table->string('tiempoEntrega');
            $table->string('observaciones');
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
        Schema::dropIfExists('art_quotations');
    }
}
