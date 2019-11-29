<?php

namespace App\Helpers\Traits;

use App\Referal;

trait Coefficient {

  protected function getRefersCoefficientBySumAndNewOperation($sum, $new_operation) {

    $new_sum = $sum + $new_operation;

    $coef = Referal::where([
        ['sum', '>=', $new_sum],
        ['min_sum', '<', $new_sum],
    ])->first()->reward;

    return $coef;
  }

  protected function getDiscountCoefficientBySumAndNewOperation($sum, $new_operation) {

    $new_sum = $sum + $new_operation;

    $coef = Referal::where([
        ['sum', '>=', $new_sum],
        ['min_sum', '<', $new_sum],
    ])->first()->discount;
    return $coef;
  }
}