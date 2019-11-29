<?php

namespace App\Http\Controllers\Home;

use App\BlackList;
use App\Http\Controllers\Controller;
use App\Post;
use App\Settings;
use Illuminate\Http\Request;


class HomeController extends Controller {

  public function index() {

    $posts = Post::published()->with('reviews')->paginate(15);

    $blackListItems = BlackList::paginate(15);

    $title = Settings::getValue('TITLE');
    $description = Settings::getValue('DESCRIPTION');

    return view('public.home.index', compact('posts', 'title', 'description', 'blackListItems'));
  }
}
