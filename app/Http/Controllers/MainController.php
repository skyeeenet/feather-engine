<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Cookie\CookieJar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;


class MainController extends Controller
{
    public function __construct(){

    }

    public function index(CookieJar $cookieJar, Request $request){
        if($request->input('ref')!==null){
            Cookie::queue('ref', $request->input('ref'), 60);

            $user = User::where('ref_id', $request->input('ref'))->first();

            if ($user != null) {
              $user->update([
                 'ref_count' => ($user->ref_count + 1),
              ]);
            }
        }
        return view('welcome');
    }
}
