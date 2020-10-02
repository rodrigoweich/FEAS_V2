<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('m_lat', 10, 8);
            $table->decimal('m_lng', 11, 8);
            $table->string('description', 200)->nullable(true);
            $table->integer('amount');
            $table->integer('busy');
            $table->foreign('cities_id')->references('id')->on('cities');
            $table->unsignedBigInteger('cities_id')->unsigned();
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
        Schema::dropIfExists('service_boxes');
    }
}
