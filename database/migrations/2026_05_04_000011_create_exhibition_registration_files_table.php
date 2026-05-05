<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExhibitionRegistrationFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibition_registration_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registration_id');
            $table->string('original_name')->nullable();
            $table->string('path');
            $table->unsignedBigInteger('size')->nullable();
            $table->string('mime')->nullable();
            $table->timestamps();

            $table->foreign('registration_id')
                ->references('id')
                ->on('exhibition_registrations')
                ->onDelete('cascade');

            $table->index('registration_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exhibition_registration_files');
    }
}
