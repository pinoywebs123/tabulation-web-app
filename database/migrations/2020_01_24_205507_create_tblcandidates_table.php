<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblcandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->bigIncrements('cdt_id');
            $table->string('cdt_fname');
            $table->string('cdt_mname');
            $table->string('cdt_lname');
            $table->string('cdt_gender');
            $table->date('cdt_bod');
            $table->string('cdt_place'); // where the candidate come from
            $table->string('cdt_organization'); // the organization the candidate is representing 
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
        Schema::dropIfExists('candidates');
    }
}
