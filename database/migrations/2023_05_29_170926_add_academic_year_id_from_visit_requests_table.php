<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAcademicYearIdFromVisitRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visit_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('academic_year_id')->after('id');
            $table->foreign('academic_year_id')->references('id')->on('academic_years');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visit_requests', function (Blueprint $table) {
            $table->dropColumn('academic_year_id');
            $table->dropColumn('academic_year_id');
        });
    }
}
