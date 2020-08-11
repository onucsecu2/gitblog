<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribution_comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contribution_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('contribution_comments', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('contribution_id')->references('id')->on('contributions')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contribution_comments');
    }
}
