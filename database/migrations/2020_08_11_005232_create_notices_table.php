<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->text('description', 500);
            $table->timestamp('pub_date_time')->useCurrent();
            $table->tinyInteger('featured')->default(0);
            $table->tinyInteger('active')->default(1);
            $table->foreign('users_id')->references('id')->on('users');
            $table->unsignedBigInteger('users_id')->unsigned();
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
        Schema::dropIfExists('notices');
    }
}
