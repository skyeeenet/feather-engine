<?php

namespace App\Http\Controllers\Categories;

use App\BlackList;
use App\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller {

  public function show($slug) {

    $category = Category::whereSlug($slug)->first();

    $posts = $category->posts()->paginate(15);

    $blackListItems = BlackList::paginate(15);

    return view('public.home.index', compact('posts', 'category', 'blackListItems'));
  }
}