<?php

namespace App\Repositories\PageRepository;

use App\Language;
use App\Page;
use App\Repositories\LanguageRepository\LanguageRepository;
use App\Repositories\Repository;
use App\Repositories\TextRepository\TextRepository;
use App\Text;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PageRepository extends Repository {

  protected $languageRepository;
  protected $textRepository;

  public function __construct(LanguageRepository $languageRepository, TextRepository $textRepository) {

    $this->languageRepository = $languageRepository;

    $this->textRepository = $textRepository;
  }

  public function store(Request $request, Model $model) {

    //получить все языки, которые созданы в системе
    $languages = $this->languageRepository->listItems();

    $page = new Page([
        'slug' => $request->slug,
        'template_id' => $request->template_id,
        'name' => $request->name
    ]);

    $page->save();

    //прохожусь по массиву языков, попутно подставляя его ключи в конец имен inputов
    foreach ($languages as $language) {

      $text = new Text([
          'page_id' => $page->id,
          'language_id' => $language->id,
          'seo_h1' => $request->input('seo_h1_' . $language->key),
          'seo_title' => $request->input('seo_title_' . $language->key),
          'seo_description' => $request->input('seo_description_' . $language->key),
          'seo_keywords' => $request->input('seo_keywords_' . $language->key),
          'content' => $request->input('content_' . $language->key),
      ]);

      $text->save();
    }

    return true;

  }

  public function update(Request $request, Model $model) {

    //получить все языки, которые созданы в системе
    $languages = $this->languageRepository->listItems();

    $page = $this->getPageBySlug($request->page);

    $page->update([
        'slug' => $request->slug,
        'template_id' => $request->template_id,
        'name' => $request->name
    ]);

    //прохожусь по массиву языков, попутно подставляя его ключи в конец имен inputов
    foreach ($languages as $language) {

      $text = new Text([
          'page_id' => $page->id,
          'language_id' => $language->id,
          'seo_h1' => $request->input('seo_h1_' . $language->key),
          'seo_title' => $request->input('seo_title_' . $language->key),
          'seo_description' => $request->input('seo_description_' . $language->key),
          'seo_keywords' => $request->input('seo_keywords_' . $language->key),
          'content' => $request->input('content_' . $language->key),
      ]);

      $text->save();
    }

    return true;
  }

  public function getPageBySlug($slug) {

    return Page::where('slug', $slug)->first();
  }
}