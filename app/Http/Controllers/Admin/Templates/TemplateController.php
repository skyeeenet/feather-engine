<?php

namespace App\Http\Controllers\Admin\Templates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Templates\TemplateRequest;
use App\Template;
use Cookie;

class TemplateController extends Controller {

    private $paginate = 10;

    public function __construct() {
        if (Cookie::get('number_records') !== null) {
            $this->paginate = Cookie::get('number_records');
        }
    }

  public function index() {

    $templates = Template::paginate($this->paginate);

    return view('admin.templates.index', compact('templates'));
  }

  public function create() {
    
    return view('admin.templates.create');
  }

  public function store(TemplateRequest $request) {

    $template = new Template($request->all());
    $template->save();

    return redirect(route('admin.templates'));
  }

  public function edit(Template $template) {

    return view('admin.templates.edit', compact('template'));
  }

  public function update(Template $template, TemplateRequest $request) {

    $template->update($request->all());
    return redirect(route('admin.templates'));
  }

  public function destroy(Template $template) {

    $template->delete();

    return redirect(route('admin.templates'));
  }
}