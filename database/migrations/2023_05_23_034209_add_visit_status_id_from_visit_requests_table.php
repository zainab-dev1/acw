<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVisitStatusIdFromVisitRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visit_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('visit_status_id')->after('is_conducted');
            $table->foreign('visit_status_id')->references('id')->on('visit_status');
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
            $table->dropColumn('visit_status_id');
            $table->dropColumn('visit_status_id');
        });
    }
}
