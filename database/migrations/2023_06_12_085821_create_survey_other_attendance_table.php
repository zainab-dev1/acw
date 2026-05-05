<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyOtherAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_other_attendance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('survey_attendance_id');
            $table->unsignedBigInteger('survey_id');
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
        Schema::dropIfExists('survey_other_attendance');
    }
}
