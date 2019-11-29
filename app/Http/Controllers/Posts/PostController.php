<?php

namespace App\Http\Controllers\Posts;

use App\Category;
use App\Helpers\Libraries\FileProcessor;
use App\Helpers\Libraries\ImageProcessor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {

  public function index() {

    $posts = Post::paginate(15);

    return view('public.posts.index', compact('posts'));
  }

  public function show($post) {

    $post = Post::whereSlug($post)->firstOrFail();

    $reviews = $post->reviews()->published()->limit(3)->get();

    $reviews_count = $post->reviews()->published()->count();

    return view('public.posts.show', compact('post', 'reviews', 'reviews_count'));
  }

  public function reviews(Post $post) {

    $reviews = $post->reviews()->published()->with('user')->skip(3)->take(999)->get();

    $content = [];

    foreach ($reviews as $review) {

      $content[] = [

          'login' => $review->user['login'],
          'content' => $review->content,
      ];
    }

    return response([

        'status' => 'success',
        'content' => $content,
    ], 200);
  }

  public function create() {

    $categories = Category::all();

    return view('public.posts.create', compact('categories'));
  }

  public function store(PostRequest $request) {

    if ($request->image) {
      $fileProcessor = new FileProcessor();
      $imageProcessor = new ImageProcessor();
      $path_full_images = $fileProcessor->saveImage($request, 'image', 'images/', 800, 800);
      $imageProcessor->compress('storage' . $path_full_images, 800, 800);
    }


    $post = new Post([
        'user_id' => Auth::id(),
        'slug' => translit($request->seo_h1),
        'status' => 'pending',
        'name' => 'seo_h1',
        'seo_description' => 'seo_h1',
        'seo_title' => 'seo_h1',
        'category_id' => $request->category_id,
        'short' => $request->short,
        'content' => $request->input('content'),
        'seo_h1' => $request->seo_h1,
    ]);

    $post->save();

    if ($request->image) {
      $post->update([
          'image' => $path_full_images,
      ]);
    }

    return redirect('/');
  }
}