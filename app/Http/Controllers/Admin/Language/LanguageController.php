<?php

namespace App\Http\Controllers\Admin\Language;

use App\Http\Controllers\RepositoryController;
use App\Language;
use App\Repositories\LanguageRepository\LanguageRepository;
use App\Text;
use Illuminate\Http\Request;

class LanguageController extends RepositoryController {

  public function __construct(Language $language, LanguageRepository $languageRepository) {

    $this->model = $language;
    $this->repository = $languageRepository;
  }

  public function index() {

    //получаю все языки
    $languages = $this->repository->all($this->model);

    return view('admin.language.index', compact('languages'));
  }

  public function edit(Language $language) {

    return view('admin.language.edit', compact('language'));
  }

  public function create() {

    return view('admin.language.create');
  }

  public function store(Request $request) {

    if ($this->repository->store($request, $this->model)) {

      return redirect(route('admin.languages'));

    } else {

      return redirect()->back()->withInput();
    }
  }

  public function update(Language $language, Request $request) {

    if ($this->repository->update($request, $language)) {

      return redirect(route('admin.languages'));

    } else {

      return redirect()->back()->withInput();
    }
  }

  public function destroy(Language $language) {

    if ($this->repository->delete($language)) {

      return redirect()->back();

    } else {

      return redirect()->back()->withInput();
    }
  }
}
