<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblsubeventCriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subevent_criteria_judge', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('svnt_ID_FK');
            $table->integer('crit_ID_FK');
            $table->integer('jdg_ID_FK');
            $table->integer('score');
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
        Schema::dropIfExists('subevent_criteria');
    }
}
