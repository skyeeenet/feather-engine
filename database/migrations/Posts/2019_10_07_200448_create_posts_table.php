<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('posts', function (Blueprint $table) {

      $table->bigIncrements('id');
      $table->bigInteger('user_id')->unsigned()->index();
      $table->string('name')->nullable();
      $table->text('short')->nullable();
      $table->string('slug')->unique();
      $table->bigInteger('category_id')->index()->nullable()->unsigned();
      $table->string('seo_title')->nullable();
      $table->string('seo_description')->nullable();
      $table->string('seo_h1')->nullable();
      $table->string('image')->nullable();
      $table->longText('content')->nullable();
      $table->string('status')->default('pending');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('posts');
  }
}
