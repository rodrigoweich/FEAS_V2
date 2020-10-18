<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->foreign('customers_id')->references('id')->on('customers');
            $table->unsignedBigInteger('customers_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');
            $table->unsignedBigInteger('users_id')->unsigned();
            $table->foreign('responsible_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('responsible_id')->unsigned()->nullable(true);
            $table->tinyInteger('stage')->default(0);
            $table->integer('meters')->nullable(true);
            $table->integer('real_meters')->nullable(true);
            $table->text('route')->nullable(true);
            $table->foreign('cables_id')->references('id')->on('cables');
            $table->unsignedBigInteger('cables_id')->unsigned()->nullable(true);
            $table->integer('difficulty')->nullable(true);
            $table->text('comments')->nullable(true);
            $table->foreign('users_id_finished')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('users_id_finished')->unsigned()->nullable(true);
            $table->tinyInteger('notified')->nullable(true);
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('processes');
    }
}
