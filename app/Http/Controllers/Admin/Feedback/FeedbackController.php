<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller {

  public function index() {

    $feedback = Feedback::orderBy('id', 'ASC')->paginate(15);

    return view('admin.feedback.index', compact('feedback'));
  }

  public function edit(Feedback $feedback) {

    return view('admin.feedback.edit', compact('feedback'));
  }

  public function destroy(Feedback $feedback) {

    $feedback->delete();

    return redirect()->back();
  }

  public function update(Feedback $feedback, Request $request) {

    $feedback->update($request->all());

    return redirect()->back();
  }
}