<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStandInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_stand_ins', function (Blueprint $table) {
            $table->unsignedBigInteger('request_stand_in_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->bigInteger('over_handing_tstmp')->nullable();
            $table->timestamps();

            $table->foreign('request_stand_in_id')->references('id')->on('requests');
            $table->foreign('user_id')->references('id')->on('users');

            $table->primary(['request_stand_in_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_stand_ins');
    }
}
