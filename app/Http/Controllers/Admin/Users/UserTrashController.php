<?php

namespace App\Http\Controllers\Admin\Users;

use App\Bid;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Cookie;

class UserTrashController extends Controller {

    private $paginate = 10;

    public function __construct()
    {
        if (Cookie::get('number_records') !== null) {
            $this->paginate = Cookie::get('number_records');
        }
    }

  public function index() {
    $users = User::onlyTrashed()->paginate($this->paginate);
    return view('admin.users.trash', compact('users'));
  }

  public function restore(Request $request) {

    $user = User::getTrashedById($request->user);
    $user->restore();
    return redirect()->back();
  }

  public function destroy(Request $request) {

    $user = User::getTrashedById($request->user);
    $user->operations()->forceDelete();
    $user->forceDelete();
    return redirect()->back();
  }

    public function deleteChecked(Request $request)
    {
        $users = $request->input('checkbox');

        foreach ($users as $user) {
            $deleteUser=User::getTrashedById($user);
            $deleteUser->forceDelete();
        }
        return redirect()->back();
    }
}