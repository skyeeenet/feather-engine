<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

  protected $guarded = [];

  public function post() {

    return $this->belongsTo(Post::class);
  }

  public function scopePublished() {

    return Review::whereStatus('published');
  }

  public function user() {

    return $this->belongsTo(User::class);
  }
}