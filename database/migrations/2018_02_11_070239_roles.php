<?php

use App\Company;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Roles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $company = App\Company::all();

        Schema::connection('datos')->create($company[0]->Company.'_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rol');
            $table->string('dataConfig');
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
