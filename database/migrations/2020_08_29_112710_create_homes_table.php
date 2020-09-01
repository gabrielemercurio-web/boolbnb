<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homes', function (Blueprint $table) {
          $table->id();
          $table->string('title', 250);
          $table->tinyInteger('nr_of_rooms');
          $table->tinyInteger('nr_of_beds');
          $table->tinyInteger('nr_of_bathrooms')->nullable();
          $table->smallInteger('square_mt')->nullable();
          $table->string('address');
          $table->decimal('latitude');
          $table->decimal('longitude');
          $table->string('image_path')->nullable();
          $table->boolean('visible')->default(true);
		  $table->boolean('advertised')->default(false);
		  $table->string('description', 2000)->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homes');
    }
}
