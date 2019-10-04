<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('review_id')->unsigned()->index();
            $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
            $table->string('src');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_images');
    }
}
