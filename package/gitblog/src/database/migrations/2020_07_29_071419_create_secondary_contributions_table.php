<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondaryContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secondary_contributions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contribution_for_id')->unsigned();
            $table->bigInteger('contribution_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('secondary_contributions', function(Blueprint $table){
            $table->foreign('contribution_for_id')->references('id')->on('contributions')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('secondary_contributions');
    }
}
