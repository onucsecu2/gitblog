<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostResponseEditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('post_response_edits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('postId')->unsigned();
            $table->bigInteger('userId')->unsigned();
            $table->integer('start');
            $table->integer('end');
            $table->text('body');
            $table->text('ref');
            $table->timestamps();
        });
        Schema::table('post_response_edits', function(Blueprint $table){
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
        Schema::dropIfExists('post_response_edits');
    }
}
