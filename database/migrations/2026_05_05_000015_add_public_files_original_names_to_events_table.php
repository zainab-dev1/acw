<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPublicFilesOriginalNamesToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'public_file_1_name')) {
                $table->string('public_file_1_name')->nullable()->after('public_file_1_path');
            }
            if (!Schema::hasColumn('events', 'public_file_2_name')) {
                $table->string('public_file_2_name')->nullable()->after('public_file_2_path');
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
            if (Schema::hasColumn('events', 'public_file_2_name')) {
                $table->dropColumn('public_file_2_name');
            }
            if (Schema::hasColumn('events', 'public_file_1_name')) {
                $table->dropColumn('public_file_1_name');
            }
        });
    }
}
