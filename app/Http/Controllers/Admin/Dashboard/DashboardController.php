<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Page;
use App\Post;

class DashboardController extends Controller {

  public function index() {

    $pages_count = Page::count();
    $posts_count = Post::count();
    return view('admin.dashboard.index', compact('pages_count', 'posts_count'));
  }
}