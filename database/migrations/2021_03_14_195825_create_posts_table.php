<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('author_id')->index();
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->string('title_tm');
            $table->string('title_ru')->nullable();
            $table->string('title_en')->nullable();
            $table->string('slug')->index();
            $table->string('image')->nullable();
            $table->text('body_tm');
            $table->text('body_ru')->nullable();
            $table->text('body_en')->nullable();
            $table->boolean('main')->default(0);
            $table->boolean('recommended')->default(0);
            $table->integer('viewed')->default(0);
            $table->boolean('active')->default(0);
            $table->dateTime('published_at');
            $table->timestamps();
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
