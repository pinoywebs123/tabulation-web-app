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
            $table->integer('sub_event_id');
            $table->integer('criteria_id');
            $table->integer('judge_id');
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
