<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model {

  protected $guarded = [];
  public $timestamps = false;

  public static function getValue($key) {

    return Settings::whereName($key)->first()['value'];
  }

  public static function setValue($key, $value) {

    Settings::updateOrCreate(
        ['name' => $key],
        ['value' => $value]
    );

    return true;
  }
}
