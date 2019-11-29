<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EmailMiddleware {

  public function handle($request, Closure $next, $redirectToRoute = null) {
    if (!$request->user() ||
        ($request->user() instanceof MustVerifyEmail &&
            !$request->user()->hasVerifiedEmail())) {
     /* return $request->expectsJson()
          ? abort(403, 'Your email address is not verified.')
          : Auth::logout();*/

      if ($request->expectsJson()) return abort(403, 'Your email address is not verified.');
      else {

        Auth::logout();
        return Redirect::to('/login')->with('confirm', 'Для начала вам необходимо подтвердить адрес электронной почты');
      }
    }

    return $next($request);
  }
}
