<?php

namespace App\Services\Excel\User;

use App\User;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class UserOperationsExcel {


   static public function getExcel($operations ,$user) {

    $time = spaceToUnderscore(Carbon::now()->toDateTimeString());

    $spreadsheet = new Spreadsheet();

    $sheet = $spreadsheet->getActiveSheet();

    $arr = [
        'A' => 'Дата подачи заявки',
        'B' => 'Дата совершенной операции',
        'C' => 'Сумма совершенной операции (UAH)',
        'D' => 'Партнерская скидка (%)',
        'E' => 'Партнерская скидка (UAH)',
        'F' => 'Статус',
    ];

    foreach ($arr as $key => $value) {

      $sheet->setCellValue($key . '1', $value);
    }

    $operations = $operations->where('confirmed_at', '<>', null)->all();

    $i = 2;

    foreach ($operations as $operation) {
      $sheet->setCellValue("A$i", spaceToUnderscore($operation->created_at));
      $sheet->setCellValue("B$i", spaceToUnderscore($operation->confirmed_at));
      $sheet->setCellValue("C$i", toNormalNumber($operation->uah));
      $sheet->setCellValue("D$i", $operation->discount);
      $sheet->setCellValue("E$i", toNormalNumber($operation->discount_balance));
      $sheet->setCellValue("F$i", $operation->confirmed_at ?? 'Не подтвержден');
      $i++;
    }

    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="операции_' . $user->login . '_' . $time . '.Xlsx"');
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
     exit;
  }
}