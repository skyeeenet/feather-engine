<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Category;
use App\Helpers\Libraries\FileProcessor;
use App\Helpers\Libraries\ImageProcessor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostRequest;
use App\Post;

use Cookie;
use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {

  private $paginate = 10;

  public function __construct() {
    if (Cookie::get('number_records') !== null) {
      $this->paginate = Cookie::get('number_records');
    }
  }

  public function index() {

    $posts = Post::paginate($this->paginate);

    return view('admin.posts.index', compact('posts'));
  }

  public function create() {

    $categories = Category::all();

    return view('admin.posts.create', compact('categories'));
  }

  public function store(PostRequest $request) {

    $fileProcessor = new FileProcessor();
    $imageProcessor = new ImageProcessor();

    $image_size = Settings::getValue('IMAGE_SIZE');

    $path_full_images = $fileProcessor->saveImage($request, 'image', 'images/', $image_size, $image_size);

    //dd($request->file('image')->getRealPath());

    //$imageProcessor->compress('storage' . $path_full_images, $image_size, $image_size);


    $post = new Post([
        'name' => $request->name,
        'user_id' => Auth::id(),
        'slug' => $request->slug,
        'category_id' => $request->category_id,
        'image' => $path_full_images,
        'short' => $request->short,
        'status' => $request->status,
        'content' => $request->input('content'),
        'seo_title' => $request->seo_title,
        'seo_h1' => $request->seo_h1,
        'seo_description' => $request->seo_description,
    ]);

    $post->save();

    return redirect(route('admin.posts'));
  }

  public function edit(Post $post) {

    $categories = Category::all();

    return view('admin.posts.edit', compact('post', 'categories'));
  }

  public function update(Post $post, PostRequest $request) {

    if ($request->image) {

      $fileProcessor = new FileProcessor();
      $imageProcessor = new ImageProcessor();

      $path_full_images = $fileProcessor->saveImage($request, 'image', 'storage/images', 800, 800);

      //$imageProcessor->compress('storage' . $path_full_images, 800, 800);

      $post->update([

          'image' => $path_full_images,
      ]);
    }

    $post->update([
        'name' => $request->name,
        'slug' => $request->slug,
        'short' => $request->short,
        'category_id' => $request->category_id,
        'seo_title' => $request->seo_title,
        'status' => $request->status,
        'seo_h1' => $request->seo_h1,
        'seo_description' => $request->seo_description,
        'content' => $request->input('content'),
    ]);

    return redirect(route('admin.posts'));
  }

  public function destroy(Post $post) {

    $post->reviews()->delete();

    $post->delete();

    return redirect()->back();
  }
}