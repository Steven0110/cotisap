<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncrementFilenameSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        //
        Schema::table('sliders', function(Blueprint $table){
            $table->String('archivo', 150)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        //
        Schema::table('sliders', function($table){
            $table->String('archivo', 50)->change();
        });
    }
}
