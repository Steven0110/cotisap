<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tools', function (Blueprint $table) {
            $table->increments('id');
            $table->String('categoria', 100);
            $table->String('marca', 100);
            $table->String('titulo', 100);
            $table->String('descripcion');
            $table->String('archivo', 100);
            $table->String('link', 100);
            $table->boolean('status');
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
        Schema::dropIfExists('Tools');
    }
}
