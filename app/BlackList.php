<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlackList extends Model {

  protected $guarded = [];

  protected $table = 'blacklist';

  public $timestamps = false;
}
