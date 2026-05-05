<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameSurveyTablesToEventTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Rename tables
        Schema::rename('survey_types', 'event_types');
        Schema::rename('surveys', 'events');
        Schema::rename('survey_results', 'event_results');
        Schema::rename('survey_attendances', 'event_attendances');
        Schema::rename('survey_other_attendance', 'event_other_attendance');
        Schema::rename('survey_assignatories', 'event_assignatories');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Reverse rename
        Schema::rename('event_types', 'survey_types');
        Schema::rename('events', 'surveys');
        Schema::rename('event_results', 'survey_results');
        Schema::rename('event_attendances', 'survey_attendances');
        Schema::rename('event_other_attendance', 'survey_other_attendance');
        Schema::rename('event_assignatories', 'survey_assignatories');
    }
}
