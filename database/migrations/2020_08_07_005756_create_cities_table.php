<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->decimal('m_lat', 10, 8);
            $table->decimal('m_lng', 11, 8);
            $table->integer('m_zoom');
            $table->foreign('states_id')->references('id')->on('states');
            $table->unsignedBigInteger('states_id')->unsigned();
            $table->tinyInteger('shortcut')->default(0);
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
        Schema::dropIfExists('cities');
    }
}
