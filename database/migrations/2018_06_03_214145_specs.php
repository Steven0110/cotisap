<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Specs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $company = App\Company::all();

        Schema::connection('datos')->create($company[0]->Company.'_specs_quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numCotizacion');
            $table->integer('idEspecificacion');
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
        //
    }
}
