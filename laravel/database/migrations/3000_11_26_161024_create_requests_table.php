<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('request_type_id')->nullable();
        $table->unsignedBigInteger('request_comment_id')->nullable();
        $table->unsignedBigInteger('granted_comment_id')->nullable();
        $table->unsignedBigInteger('rejected_comment_id')->nullable();
        $table->boolean('granted')->nullable();
        $table->boolean('rejected')->nullable();
        $table->timestamps();

        $table->foreign('request_type_id')->references('id')->on('request_types')
            ->onDelete('cascade');

        $table->foreign('request_comment_id')->references('id')->on('comments')
            ->onDelete('cascade');

        $table->foreign('granted_comment_id')->references('id')->on('comments')
            ->onDelete('cascade');

        $table->foreign('rejected_comment_id')->references('id')->on('comments')
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
        Schema::dropIfExists('requests');
    }
}
