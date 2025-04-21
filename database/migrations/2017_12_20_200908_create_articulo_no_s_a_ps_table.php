<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticuloNoSAPsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 20);
            $table->string('nombre', 50);
            $table->string('descripcion', 250);
            $table->string('clase', 5);
            $table->integer('grupo');
            $table->decimal('precio', 8, 2);
            $table->string('UMV', 10);
            $table->string('moneda', 5);
            $table->string('comentarios', 250);
            $table->integer('user_id');
            $table->string('status', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('articulos');
    }
}
