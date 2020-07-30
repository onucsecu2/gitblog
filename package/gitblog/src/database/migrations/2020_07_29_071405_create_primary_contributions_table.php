<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimaryContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primary_contributions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id')->unsigned();
            $table->bigInteger('contribution_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('primary_contributions', function(Blueprint $table){
            $table->foreign('contribution_id')->references('id')->on('contributions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('postId')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('primary_contributbutes');
    }
}
