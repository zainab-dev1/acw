<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPublicFilesToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'public_file_1_path')) {
                $table->string('public_file_1_path')->nullable()->after('has_feedback');
            }
            if (!Schema::hasColumn('events', 'public_file_2_path')) {
                $table->string('public_file_2_path')->nullable()->after('public_file_1_path');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'public_file_2_path')) {
                $table->dropColumn('public_file_2_path');
            }
            if (Schema::hasColumn('events', 'public_file_1_path')) {
                $table->dropColumn('public_file_1_path');
            }
        });
    }
}
