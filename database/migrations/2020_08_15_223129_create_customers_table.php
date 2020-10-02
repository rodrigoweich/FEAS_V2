<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('contract_number');
            $table->string('name', 20);
            $table->string('surname', 30);
            $table->string('phone', 20);
            $table->decimal('m_lat', 10, 8);
            $table->decimal('m_lng', 11, 8);
            $table->integer('m_zoom');
            $table->string('m_icon');
            $table->foreign('service_boxes_id')->references('id')->on('service_boxes')->onDelete('set null');
            $table->unsignedBigInteger('service_boxes_id')->unsigned()->nullable(true);
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
        Schema::dropIfExists('customers');
    }
}
