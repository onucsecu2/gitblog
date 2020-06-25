<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_contributions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userId')->unsigned();
            $table->bigInteger('postId')->unsigned();
            $table->longText('body');
            $table->timestamps();
        });
        Schema::table('request_contributions', function(Blueprint $table){
                $table->foreign('userId')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('requst_contributions');
    }
}
