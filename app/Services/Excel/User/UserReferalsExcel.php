<?php

namespace App\Services\Excel\User;

use App\Bid;
use App\User;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class UserReferalsExcel {

  private $user;

  static public function getExcel($operations, $user) {

    $time = spaceToUnderscore(Carbon::now()->toDateTimeString());

    $spreadsheet = new Spreadsheet();

    $sheet = $spreadsheet->getActiveSheet();

    $arr = [
        'A' => 'Логин Реферала',
        'B' => 'Дата подачи заявки Рефералов',
        'C' => 'Дата совершенной операции Рефералом',
        'D' => 'Сумма (UAH) совершенной операции Рефералом',
        'E' => 'Реферальное вознаграждение (%)',
        'F' => 'Реферальное вознаграждение (UAH)',
    ];

    foreach ($arr as $key => $value) {

      $sheet->setCellValue($key . '1', $value);
    }

    $i = 2;

    $operations = $operations->where('confirmed_at', '<>', null)->all();

    foreach ($operations as $operation) {
      $sheet->setCellValue("A$i", $operation->login);
      $sheet->setCellValue("B$i", spaceToUnderscore($operation->created_at));
      $sheet->setCellValue("C$i", spaceToUnderscore($operation->confirmed_at));
      $sheet->setCellValue("D$i", toNormalNumber($operation->uah));
      $sheet->setCellValue("E$i", toNormalNumber($operation->ref) ?? '0');
      $sheet->setCellValue("F$i", toNormalNumber($operation->ref_balance) ?? '0');
      $i++;
    }

    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="операции_рефералов_пользователя_' . $user->login . '_' .colonToDash($time) . '.Xlsx"');
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit;
  }
}