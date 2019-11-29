<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reviews\SubscribeRequest;
use App\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller {

  public function store(SubscribeRequest $request) {

    //dd($request->email);

    $post_id = $request->post_id;

    $check_if_exists = Subscribe::where([
        ['email', '=', $request->email],
        ['post_id', '=', $post_id],
    ])->first();


    if ($check_if_exists) {

      return response([
          'status' => 'failed',
          'review' => 'subscribe has already exists'
      ], 200);
    }

    $subscribe = new Subscribe([

        'email' => $request->email,
        'post_id' => $post_id,
    ]);

    $subscribe->save();

    return response([
        'status' => 'success',
        'review' => 'subscribe created'
    ], Response::HTTP_CREATED);
  }
}
