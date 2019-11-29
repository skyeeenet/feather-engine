<?php

namespace App\Listeners;

use App\Events\onOperationConfirmed;
use App\Helpers\Traits\Coefficient;
use App\Paid;
use App\Referal;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ConfirmOperation {

  use Coefficient;

  public function __construct() {
    //
  }


  public function handle(onOperationConfirmed $event) {

    $bid = $event->bid;
    $calculator = $event->calculator;

    //Получаю пользователя операции
    $user = $bid->user;
    //Получаю его владельца
    $owner = $user->owner;
    //считаем для реферала
    if ($owner != null) {
      //получаю всех рефералов владельца
      //$owner_refers = $owner->refers;
      //считаю сумму операций рефералов владельца
      //$refers_sum = $calculator->getUsersOperationsSum($owner_refers);
      //$ref = $this->getRefersCoefficientBySumAndNewOperation($refers_sum, $bid->uah);
      $refers_sum = $calculator->getProcent($bid->uah, $bid->ref);
      //получить процент
      //посчитать процент и получить сумму
      //записываем в bid реферальную сумму
      $bid->update([

        //'ref' => $ref,
          'ref_balance' => $refers_sum,
      ]);
      $old_ref_balance = $owner->ref_balance;
      $owner->update([
          'ref_balance' => $old_ref_balance + $refers_sum
      ]);

      //создаю новый paid для поступления
      $paid = new Paid([
          'user_id' => $owner->id,
          'uah' => $refers_sum,
      ]);
      $paid->save();
    }
    //считаю сумму всех операций пользователя, который создал заявку
    $operations_sum = $calculator->getOperationsSum($user->confirmedOperations);
    $user->update([
        'balance' => $operations_sum + $bid->uah,
    ]);
    //$discount = $this->getDiscountCoefficientBySumAndNewOperation($operations_sum, $bid->uah);
    $discount_balance = $calculator->getProcent($bid->uah, $bid->discount);
    $bid->update([

      //'discount' => $discount,
        'discount_balance' => $discount_balance,
    ]);
    $timeNow = Carbon::now();
    //подтверждаем заявку
    $bid->update([
        'confirmed_at' => $timeNow->toDateTimeString(),
    ]);

  }
}
