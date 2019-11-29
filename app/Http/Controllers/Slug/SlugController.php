<?php

namespace App\Http\Controllers\Slug;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;

class SlugController extends Controller {

  public function show($slug) {

    $category = Category::whereSlug($slug)->first();

    if ($category) {

      $posts = $category->posts()->paginate(15);

      return view('public.home.index', compact('posts', 'category'));

    } else {

      $post = Post::whereSlug($slug)->first();

      return view('public.posts.show', compact('post'));
    }
  }
}