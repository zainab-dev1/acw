<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyAssignatoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_assignatories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_default')->default(0);
            $table->unsignedBigInteger('survey_id')->default(0);            
            $table->string('left_name')->nullable();
            $table->string('left_position')->nullable();
            $table->string('left_org')->nullable();
            $table->string('right_name')->nullable();
            $table->string('right_position')->nullable();
            $table->string('right_org')->nullable();
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
        Schema::dropIfExists('survey_assignatories');
    }
}
