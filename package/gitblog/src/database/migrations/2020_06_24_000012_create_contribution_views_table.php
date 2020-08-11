<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribution_views', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contribution_id')->unsigned();
            $table->integer('views');
            $table->timestamps();
        });
        Schema::table('contribution_views', function(Blueprint $table){
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
        Schema::dropIfExists('contribution_views');
    }
}
