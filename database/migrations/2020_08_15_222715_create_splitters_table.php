<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSplittersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('splitters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('description', 200)->nullable(true);
            $table->integer('entrance');
            $table->integer('amount');
            $table->integer('available');
            $table->integer('busy');
            $table->foreign('service_boxes_id')->references('id')->on('service_boxes');
            $table->unsignedBigInteger('service_boxes_id')->unsigned();
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
        Schema::dropIfExists('splitters');
    }
}
