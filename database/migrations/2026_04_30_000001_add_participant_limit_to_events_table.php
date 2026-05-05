<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'has_participant_limit')) {
                $table->boolean('has_participant_limit')->default(0)->after('award_details');
            }

            if (!Schema::hasColumn('events', 'participant_limit')) {
                $table->unsignedInteger('participant_limit')->nullable()->after('has_participant_limit');
            }
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'participant_limit')) {
                $table->dropColumn('participant_limit');
            }
            if (Schema::hasColumn('events', 'has_participant_limit')) {
                $table->dropColumn('has_participant_limit');
            }
        });
    }
};
