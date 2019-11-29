<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('texts', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('page_id')->index()->unsigned()->nullable();
      $table->bigInteger('post_id')->index()->unsigned()->nullable();
      $table->bigInteger('language_id')->index()->unsigned()->nullable();
      $table->string('seo_title')->nullable();
      $table->string('seo_keywords')->nullable();
      $table->string('seo_description')->nullable();
      $table->string('seo_h1')->nullable();
      $table->longText('content')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('texts');
  }
}
