<?php

namespace App\Repositories\LanguageRepository;

use App\Language;
use App\Repositories\Repository;

class LanguageRepository extends Repository {

  public function listItems() {

    return Language::all();
  }
}