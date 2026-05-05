<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // New fields for Activities
            $table->dateTime('time')->nullable()->after('training_date');
            $table->string('location')->nullable()->after('time');
            $table->string('award_type')->default('none')->after('location');
            $table->text('award_details')->nullable()->after('award_type');

            // Remove old Event-specific fields
            if (Schema::hasColumn('events', 'day_option')) {
                $table->dropColumn('day_option');
            }
            if (Schema::hasColumn('events', 'trainor')) {
                $table->dropColumn('trainor');
            }
            if (Schema::hasColumn('events', 'position')) {
                $table->dropColumn('position');
            }
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Restore old fields (nullable to avoid failures)
            if (!Schema::hasColumn('events', 'day_option')) {
                $table->string('day_option')->nullable()->after('training_date');
            }
            if (!Schema::hasColumn('events', 'trainor')) {
                $table->string('trainor')->nullable()->after('day_option');
            }
            if (!Schema::hasColumn('events', 'position')) {
                $table->string('position')->nullable()->after('trainor');
            }

            // Drop new fields
            if (Schema::hasColumn('events', 'time')) {
                $table->dropColumn('time');
            }
            if (Schema::hasColumn('events', 'location')) {
                $table->dropColumn('location');
            }
            if (Schema::hasColumn('events', 'award_type')) {
                $table->dropColumn('award_type');
            }
            if (Schema::hasColumn('events', 'award_details')) {
                $table->dropColumn('award_details');
            }
        });
    }
};
