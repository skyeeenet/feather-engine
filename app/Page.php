<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

  protected $guarded = [];

  public function template() {

    return $this->belongsTo(Template::class);
  }

  public function posts() {

    return $this->belongsToMany(Post::class);
  }

  public function text() {

    return $this->hasMany(Text::class);
  }
}
