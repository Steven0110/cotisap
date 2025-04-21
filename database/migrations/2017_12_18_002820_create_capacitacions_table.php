<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapacitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capacitacions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 50);
            $table->string('categoria', 50);
            $table->string('descripcion', 100);
            $table->string('archivo', 150);
            $table->boolean('status', 1);
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
        Schema::dropIfExists('capacitacions');
    }
}
