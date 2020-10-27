<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_rule', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rule_id')->unsigned();
            $table->bigInteger('role_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('rule_id')
                    ->references('id')
                    ->on('rules')
                    ->onDelete('cascade');
            $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_rule');
    }
}
