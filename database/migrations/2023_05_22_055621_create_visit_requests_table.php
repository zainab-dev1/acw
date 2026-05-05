<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('visit_activity_type_id');
            $table->foreign('visit_activity_type_id')->references('id')->on('visit_activity_types');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->unsignedBigInteger('visit_participant_id');
            $table->foreign('visit_participant_id')->references('id')->on('visit_participants');
            $table->datetime('proposed_date');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('committee_course_name');
            $table->text('title_visit')->nullable();
            $table->text('industry_experts')->nullable();
            $table->string('cv_link')->nullable();
            $table->boolean('is_transport')->default(0);
            $table->boolean('is_conducted')->default(0);
            $table->boolean('is_approved_adaa')->default(0);
            $table->unsignedBigInteger('requested_by_user_id');
            $table->foreign('requested_by_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('visit_requests');
    }
}
