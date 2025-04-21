<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            
            $table->string('Commission')->nullable();
            $table->string('GroupCode')->nullable();
            $table->string('Locked')->nullable();
            $table->string('DataSource')->nullable();
            $table->string('UserSign')->nullable();
            $table->string('EmpID')->nullable();
            $table->string('Active')->nullable();
            $table->string('Telephone')->nullable();
            $table->string('Mobil')->nullable();
            $table->string('Fax')->nullable();
            $table->string('U_admin')->nullable();
            $table->string('U_branch')->nullable();
            $table->string('U_salt')->nullable();
            $table->string('U_priceList')->nullable();
            $table->string('U_manager')->nullable();
            $table->string('U_export')->nullable();
            $table->string('U_discounts')->nullable();

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
