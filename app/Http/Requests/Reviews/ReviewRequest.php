<?php

namespace App\Http\Requests\Reviews;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest {

  public function authorize() {
    return true;
  }

  public function rules() {
    return [

      'content' => 'required',
    ];
  }
}
