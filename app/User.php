<?php

namespace App;

use App\Helpers\Interfaces\Excelable;
use App\Notifications\UserRegister;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail {

  use Notifiable;

  protected $guarded = [];

  protected $hidden = [
    'password', 'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public static function getTrashedById($id) {

    return User::withTrashed()->whereId($id)->first();
  }

  public function scopeConfirmed() {

    return User::where('email_verified_at', '<>', null);
  }

  public function sendEmailVerificationNotification() {

    $this->notify(new UserRegister);
  }
}
