<?php

namespace App\Http\Controllers\Search;

use App\BlackList;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller {

  public function show(Request $request) {

    $query = $request->search;

    $blackListItems = BlackList::paginate(15);

    $title = 'Результаты поиска для ' . $query;

    $posts = Post::published()->where('seo_h1', 'like', '%'.$query.'%')
        ->orWhere('content', 'like', '%'.$query.'%')
        ->paginate(15);

    return view('public.home.index', compact('posts','title', 'blackListItems'));
  }
}