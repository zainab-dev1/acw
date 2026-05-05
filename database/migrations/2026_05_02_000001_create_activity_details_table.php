<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_details', function (Blueprint $table) {
            $table->id();

            // Link to existing activities (events table)
            $table->unsignedBigInteger('activity_id')->unique();

            // Extra fields from the spreadsheet
            $table->string('number')->nullable();
            $table->string('time_range')->nullable();
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('place')->nullable();
            $table->string('certificate_policy')->nullable();
            $table->string('prizes')->nullable();

            $table->timestamps();

            $table->foreign('activity_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_details');
    }
};
