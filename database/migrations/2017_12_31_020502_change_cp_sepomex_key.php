<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCpSepomexKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ////
        Schema::table('cp', function(BLueprint $table){
            $table->dropColumn('id');
        });
        DB::statement("ALTER TABLE cp ADD PRIMARY KEY (codigo_postal)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::statement("ALTER TABLE cp DROP PRIMARY KEY");
        Schema::table('cp', function(BLueprint $table){
            $table->increments('id');
        });
    }
}
