<?php

namespace App\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {

    return [
        'template_id' => 'required',
        'slug' => 'required',
        'seo_title' => 'required',
        'seo_description' => 'required',
        'seo_h1' => 'required',
        'content' => 'required',
    ];
  }
}
