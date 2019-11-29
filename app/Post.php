<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

  protected $guarded = [];

  public function pages() {

    return $this->belongsToMany(Page::class);
  }

  public function scopePublished() {

    return Post::whereStatus('published');
  }

  public function user() {

    return $this->belongsTo(User::class);
  }

  public function reviews() {

    return $this->hasMany(Review::class);
  }

  public function subscribers() {

    return $this->hasMany(Subscribe::class);
  }
}
