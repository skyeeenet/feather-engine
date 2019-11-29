<?php

namespace App\Services\Excel\Operations;

use App\Bid;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class OperationExcel {

  static public function getExcel($operations) {

    $time =  spaceToUnderscore(Carbon::now()->toDateTimeString());

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $arr = [
        'A' => 'Логин Пользователя',
        'B' => 'Дата подачи заявки Пользователя',
        'C' => 'Номер операции',
        'D' => 'Сумма операции (UAH)',
        'E' => 'Дата совершения операции Пользователем',
    ];

    foreach ($arr as $key => $value) {

      $sheet->setCellValue($key.'1', $value);
    }

    $i = 2;

    $operations = $operations->where('confirmed_at', '<>', null)->all();

    foreach ($operations as $operation) {
      $sheet->setCellValue("A$i", $operation->user['login']);
      $sheet->setCellValue("B$i", spaceToUnderscore($operation->created_at));
      $sheet->setCellValue("C$i", $operation->number);
      $sheet->setCellValue("D$i", $operation->uah);
      $sheet->setCellValue("E$i", $operation->confirmed_at);
      $i++;
    }

    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="операции_'.colonToDash($time).'.Xlsx"');
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');

    exit;
  }
}