<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('survey_id');
            $table->foreign('survey_id')->references('id')->on('surveys');
            $table->string('participant_name')->nullable();
            $table->string('participant_department')->nullable();
            $table->string('participant_section')->nullable();
            $table->integer('q1')->default(0);
            $table->integer('q2')->default(0);
            $table->integer('q3')->default(0);
            $table->integer('q4')->default(0);
            $table->integer('q5')->default(0);
            $table->integer('q6')->default(0);
            $table->integer('q7')->default(0);
            $table->integer('q8')->default(0);
            $table->integer('q9')->default(0);
            $table->integer('q10')->default(0);
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('survey_results');
    }
}
