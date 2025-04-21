<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Payment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $company = App\Company::all();

        Schema::connection('datos')->create($company[0]->Company.'_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numCotizacion');
            $table->string('metodo');
            $table->string('monto');
            $table->string('moneda');
            $table->string('date');
            $table->string('comprobante');
            $table->string('status');
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
