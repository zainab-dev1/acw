<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExhibitionSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibition_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_open')->default(true);
            $table->timestamps();
        });

        // Ensure there's always a single row.
        Schema::table('exhibition_settings', function (Blueprint $table) {
            // no-op
        });

        \DB::table('exhibition_settings')->insert([
            'is_open' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exhibition_settings');
    }
}
