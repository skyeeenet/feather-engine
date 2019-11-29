<?php

namespace App\Http\Controllers\Reviews;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reviews\ReviewRequest;
use App\Mail\PostUpdated;
use App\Post;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller {

  public function store(ReviewRequest $request) {

    $review = new Review([

        'post_id' => $request->post_id,
        'user_id' => Auth::id(),
        'content' => $request->input('content'),
        'status' => 'pending',
    ]);

    $review->save();

    return redirect()->back();
  }
}