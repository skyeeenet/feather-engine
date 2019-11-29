<?php

namespace App\Helpers\Facades;

use Illuminate\Support\Facades\Facade;

class SettingsFacade extends Facade {

  public static function getFacadeAccessor() {
    return 'settings';
  }
}