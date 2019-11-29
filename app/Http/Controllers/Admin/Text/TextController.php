<?php

namespace App\Http\Controllers\Admin\Text;

use App\Http\Controllers\RepositoryController;
use App\Repositories\TextRepository\TextRepository;
use App\Text;
use Illuminate\Http\Request;

class TextController extends RepositoryController {

  public function __construct(Text $text, TextRepository $textRepository) {

    $this->model = $text;
    $this->repository = $textRepository;
  }

  public function index() {

    $texts = $this->repository->all($this->model);

    return view('admin.text.index', compact('texts'));
  }

  public function store(Request $request) {

  }

  public function update(Text $text, Request $request) {

  }

  public function edit(Text $text) {

  }

  public function destroy(Text $text) {

  }
}
