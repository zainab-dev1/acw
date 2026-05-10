<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllowPublicFeedbackWithoutAttendanceToEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'allow_public_feedback_without_attendance')) {
                $table->boolean('allow_public_feedback_without_attendance')
                    ->default(0)
                    ->after('has_feedback');
            }
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'allow_public_feedback_without_attendance')) {
                $table->dropColumn('allow_public_feedback_without_attendance');
            }
        });
    }
}
