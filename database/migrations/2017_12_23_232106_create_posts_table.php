<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
          $table->engine = 'InnoDB';
          $table->increments('id');
          $table->string('title');
          $table->text('body');
          $table->integer('user_id')->unsigned()->index();
          $table->integer('topic_id')->unsigned()->index();
          $table->timestamps();


        });
        Schema::table('posts', function($table) {
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // when user deleted delete post
          $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');

  });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
