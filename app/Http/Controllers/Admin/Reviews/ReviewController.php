<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Http\Controllers\Controller;
use App\Mail\PostUpdated;
use App\Post;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller {

  public function index() {

    $reviews = Review::with('user')->paginate();

    return view('admin.reviews.index', compact('reviews'));
  }

  public function edit(Review $review) {

    return view('admin.reviews.edit', compact('review'));
  }

  public function update(Request $request, Review $review) {

    $review->update($request->all());

    /* Отправить в экшен */

    $post = Post::whereId($review->post_id)->first();

    $emails = $post->subscribers;

    foreach ($emails as $email) {

      Mail::to($email)->send(new PostUpdated($post));
    }

    return redirect()->back();
  }

  public function destroy(Review $review) {

    $review->delete();

    return redirect()->back();
  }


}