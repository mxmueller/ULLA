<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHumanResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('human_resources', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('executive')->nullable();
            $table->timestamps();

            $table->foreign('id')->references('id')->on('requests');
            $table->foreign('creator')->references('id')->on('users');
            $table->foreign('executive')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('human_resources');
    }
}
