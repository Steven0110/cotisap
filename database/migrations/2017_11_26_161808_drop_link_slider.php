<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropLinkSlider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        //
        Schema::table('sliders', function(Blueprint $table){
            $table->dropColumn('link');
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
            $table->string('link', 100);
        });
    }
}
