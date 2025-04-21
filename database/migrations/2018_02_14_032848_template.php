<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Template extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $company = App\Company::all();

        Schema::connection('datos')->create($company[0]->Company.'_template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('tipo');
            $table->string('categoria');
            $table->string('data');
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
