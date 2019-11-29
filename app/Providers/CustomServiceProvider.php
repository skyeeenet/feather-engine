<?php

namespace App\Providers;

use App\Helpers\Contracts\CurrenciesCourse;
use App\Helpers\Contracts\Realizations\CryptoCompareApi;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider {

  public function register() {

    $this->app->bind('settings', function() {
      return new \App\Helpers\Facades\Realizations\Settings;
    });

    $this->app->bind(CurrenciesCourse::class, CryptoCompareApi::class);
  }


  public function boot() {
    //
  }
}
