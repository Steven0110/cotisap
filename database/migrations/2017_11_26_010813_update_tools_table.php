<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Tools', function(Blueprint $table){
            $table->String('descripcion')->nullable()->change();
            $table->String('archivo', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Tools', function($table){
            $table->dropColumn('descripcion');
            $table->dropColumn('archivo');
        });
    }
}
