<?php

namespace App\Http\Controllers\Feedback;

use App\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller {

  public function store(Request $request) {

    $feedback = new Feedback($request->all());

    $feedback->save();

    return redirect('/');
  }
}