<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Convert existing datetime values in `events.time` to time-only (HH:MM:SS)
        if (Schema::hasColumn('events', 'time')) {
            // Extract time portion while keeping NULLs
            DB::statement("UPDATE events SET time = TIME(time) WHERE time IS NOT NULL");

            // Change column type to TIME (avoid requiring doctrine/dbal)
            DB::statement('ALTER TABLE events MODIFY time TIME NULL');
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('events', 'time')) {
            // Change back to DATETIME (date part will be 1970-01-01 if only time was stored)
            DB::statement('ALTER TABLE events MODIFY time DATETIME NULL');
        }
    }
};
