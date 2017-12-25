<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
          $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('likeable_id')->unsigned();
            $table->string('likeable_type');
            $table->integer('user_id')->unsigned()->index();
            $table->timestamps();


        });
        Schema::table('likes', function($table) {
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

  });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
