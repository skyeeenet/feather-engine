<?php

namespace App\Http\Requests\Reviews;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest {

  public function authorize() {
    return true;
  }

  public function rules() {
    return [

      'email' => 'required|email',
    ];
  }
}
