<?php

use App\Company;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $company = App\Company::all();

        Schema::connection('datos')->create($company[0]->Company.'_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('condiciones', 500);
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
        Schema::dropIfExists($company[0]->Company.'_notes');
    }
}
