<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('house_id')->after('id');
			$table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');
			$table->foreignId('advert_id')->after('id');
            $table->foreign('advert_id')->references('id')->on('adverts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['house_id']);
			$table->dropColumn('house_id');
			$table->dropForeign(['advert']);
            $table->dropColumn('advert');
        });
    }
}
