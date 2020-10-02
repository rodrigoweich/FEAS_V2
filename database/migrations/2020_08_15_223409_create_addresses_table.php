<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->string('complement', 100);
            $table->string('end_description', 255);
            $table->foreign('cities_id')->references('id')->on('cities');
            $table->unsignedBigInteger('cities_id')->unsigned();
            $table->foreign('customers_id')->references('id')->on('customers');
            $table->unsignedBigInteger('customers_id')->unsigned();
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
        Schema::dropIfExists('addresses');
    }
}
