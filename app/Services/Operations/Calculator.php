<?php

namespace App\Services\Operations;

class Calculator {

  //считаю операции пользователей
  public function getUsersOperationsSum($users) {

    $sum = 0;

    foreach ($users as $user) {

      $operations = $user->confirmedOperations;

      /*foreach ($operations as $operation) {

        $sum += $operation->uah;
      }*/

      $sum += $this->getOperationsSum($operations);
    }

    return $sum;
  }

  public function getOperationsSum($operations) {

    $sum = 0;

    foreach ($operations as $operation) {

      $sum += $operation->uah;
    }

    return $sum;
  }

  public function getProcent($value, $procent) {

    return ($value * $procent) / 100;
  }

}