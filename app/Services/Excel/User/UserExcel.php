<?php


namespace App\Services\Excel\User;


use App\User;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class UserExcel {

  static public function getExcel($users, $name) {

    $time =  spaceToUnderscore(Carbon::now()->toDateTimeString());

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $arr = [
        'A' => 'Логин Пользователя',
        'B' => 'Email Пользователя',
        'C' => 'Дата регистрации Пользователя',
        'D' => 'Активация пользователя через Email',
        'E' => 'Суммарный объем операций',
        'F' => 'Реферальное вознаграждение'
    ];

    foreach ($arr as $key => $value) {

      $sheet->setCellValue($key.'1', $value);
    }

    $users = $users->where('email_verified_at', '<>', null)->all();

    $i = 2;

    foreach ($users as $user) {
      $sheet->setCellValue("A$i", $user->login);
      $sheet->setCellValue("B$i", $user->email);
      $sheet->setCellValue("C$i", spaceToUnderscore($user->created_at));
      $sheet->setCellValue("D$i", spaceToUnderscore($user->confirmed_at));
      $sheet->setCellValue("E$i", $user->balance);
      $sheet->setCellValue("F$i", $user->ref_balance);
      $i++;
    }

    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;'.$name.'.Xlsx"');
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');

    exit;
  }
}