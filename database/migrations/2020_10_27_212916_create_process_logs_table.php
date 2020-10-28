<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_logs', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->foreign('users_id')->references('id')->on('users');
            $table->unsignedBigInteger('users_id')->unsigned();
            $table->foreign('processes_id')->references('id')->on('processes');
            $table->unsignedBigInteger('processes_id')->unsigned();
            $table->tinyInteger('stage');
            $table->tinyInteger('current_stage');
            $table->tinyInteger('next_stage');
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
        Schema::dropIfExists('process_logs');
    }
}
