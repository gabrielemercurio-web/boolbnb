<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hits', function (Blueprint $table) {
            $table->foreignId('house_id')->after('id')->nullable();
            // Foreign key reference
            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hits', function (Blueprint $table) {
            $table->dropForeign(['house_id']);
            $table->dropColumn('house_id');
        });
    }
}
