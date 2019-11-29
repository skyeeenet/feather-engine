<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model {

  protected $guarded  = [];

  public $timestamps = false;

  protected $table = 'subscribe';
}
