<?php

namespace App\Services\Excel\Paid;

use App\Paid;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class PaidExcel {

  static public function getExcel($paid) {

    $time =  spaceToUnderscore(Carbon::now()->toDateTimeString());

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $arr = [
        'A' => 'Логин Пользователя',
        'B' => 'Начислено (дата)',
        'C' => 'Начислено (сумма UAH)',
        'D' => 'Выплачено (дата)',
        'E' => 'Выплачено (сумма UAH)',
        'F' => 'Валюта выплаты',
        'G' => 'Номер эл. кошелька',
        'H' => 'Номер транзакции',
        'I' => 'Остаток (сумма UAH)',
    ];

    foreach ($arr as $key => $value) {

      $sheet->setCellValue($key.'1', $value);
    }

    $paid = $paid->where('confirmed_at', '<>', null)->all();

    $i = 2;

    foreach ($paid as $item) {
      $sheet->setCellValue("A$i", $item->user['login']);
      $sheet->setCellValue("B$i", spaceToUnderscore($item->created_at));
      $sheet->setCellValue("C$i", toNormalNumber($item->uah));
      $sheet->setCellValue("D$i", spaceToUnderscore($item->confirmed_at));
      $sheet->setCellValue("E$i", toNormalNumber($item->uah));
      $sheet->setCellValue("F$i", $item->currency['name']);
      $sheet->setCellValue("G$i", strval($item->wallet));
      $sheet->setCellValue("H$i", strval($item->transaction_num));
      $sheet->setCellValue("I$i", toNormalNumber($item->user->balance - $item->uah));
      $i++;
    }

    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="баланс_вознаграждений_'.colonToDash($time).'.Xlsx"');
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');

    exit;
  }
}