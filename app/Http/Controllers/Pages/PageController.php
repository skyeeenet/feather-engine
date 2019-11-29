<?php

namespace App\Http\Controllers\Pages;

use App\BlackList;
use App\Http\Controllers\Controller;
use App\Page;
use Session;

class PageController extends Controller {

  public function show($slug) {

    $locale = Session::get('locale');

    $page = Page::whereSlug($slug)->first();

    if ($locale == 'ru')
      $seo_h1 = $page->seo_h1;
    else $seo_h1 = $page->seo_h1_ua;

    if ($locale == 'ru')
      $description = $page->seo_description;
    else $description = $page->seo_description_ua;

    if ($locale == 'ru')
      $title = $page->seo_title;
    else $title = $page->seo_title_ua;

    if ($locale == 'ru')
      $content = $page->content;
    else $content = $page->content_ua;

    $template = $page->template['path'];

    return view('public.templates.'.$template, compact('seo_h1', 'description', 'title', 'content'));
  }
}