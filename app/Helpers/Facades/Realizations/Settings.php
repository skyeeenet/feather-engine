<?php

namespace App\Helpers\Facades\Realizations;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model {

  protected $guarded = [];

  public $timestamps = false;

  public function getValue($key) {

    $res = Settings::whereName($key)->first();

    if ($res) return $res->value;
    return null;
  }

  public function setValue($key, $value) {

    Settings::updateOrCreate(
        ['name' => $key],
        ['value' => $value]
    );

    return true;
  }
}