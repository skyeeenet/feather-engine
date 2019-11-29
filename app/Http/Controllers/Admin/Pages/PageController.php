<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RepositoryController;
use App\Http\Requests\Pages\PageRequest;
use App\Language;
use App\Page;
use App\Repositories\LanguageRepository\LanguageRepository;
use App\Repositories\PageRepository\PageRepository;
use App\Settings;
use Cookie;
use App\Template;
use Illuminate\Http\Request;

class PageController extends RepositoryController {

  protected $languageRepository;

  public function __construct(Page $page, PageRepository $pageRepository, LanguageRepository $languageRepository) {

    $this->model = $page;
    $this->repository = $pageRepository;
    $this->languageRepository = $languageRepository;
  }

  public function index() {

    $pages = Page::with('template')->paginate(15);

    return view('admin.pages.index', compact('pages'));
  }

  public function create() {

    $templates = Template::all();

    $languages = Language::all();

    return view('admin.pages.create', compact('templates', 'languages'));
  }

  public function store(Request $request) {

    if ($this->repository->store($request, $this->model)) {

      return redirect(route('admin.pages'));

    } else {

      return redirect()->back()->withInput();
    }

  }

  public function edit(Page $page) {

    $templates = Template::all();

    $languages = $this->languageRepository->all(new Language());

    return view('admin.pages.edit', compact('page', 'templates', 'languages'));
  }

  public function update(Page $page, Request $request) {

    $page->update([
        'template_id' => $request->template_id,
        'name' => $request->name,
        'slug' => $request->slug,
        'seo_title' => $request->seo_title,
        'seo_title_ua' => $request->seo_title_ua,
        'seo_description' => $request->seo_description,
        'seo_description_ua' => $request->seo_description_ua,
        'seo_h1' => $request->seo_h1,
        'seo_h1_ua' => $request->seo_h1_ua,
        'content' => $request->input('content'),
        'content_ua' => $request->input('content_ua'),
    ]);

    return redirect(route('admin.pages'));
  }

  public function destroy(Page $page) {

    $page->delete();

    return redirect(route('admin.pages'));
  }
}