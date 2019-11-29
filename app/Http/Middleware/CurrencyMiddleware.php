<?php

namespace App\Http\Middleware;

use App\Currency;
use App\Helpers\Contracts\CurrenciesCourse;
use Carbon\Carbon;
use Closure;
use Settings;

class CurrencyMiddleware {

  private $course = false;

  public function __construct(CurrenciesCourse $course) {

    $this->course = $course;
  }

  public function handle($request, Closure $next) {

    $last_time = 0;
    $new_time = Carbon::now()->minute;
    $offset = 5;

    try {

      $last_time = (int) Settings::getValue('LAST_CURRENCY_UPDATED_TIME');

    } catch (\Exception $ex) {

      Settings::setValue('LAST_CURRENCY_UPDATED_TIME', $new_time - $offset);
      $last_time = $new_time - $offset;
    }

    if (abs($last_time - $new_time) >= 5) {

      $courses = $this->course->get();

      foreach ($courses as $key => $value) {

        Currency::updateOrCreate(
            ['name' => $key],
            ['value' => $value->UAH]
        );
      }

      Settings::setValue('LAST_CURRENCY_UPDATED_TIME', $new_time);
    }

    return $next($request);
  }
}
