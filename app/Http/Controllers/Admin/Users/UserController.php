<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;

use App\Http\Requests\Bids\BidsRequest;
use App\Role;
use App\Services\Excel\Operations\OperationExcel;
use App\Services\Excel\User\UserExcel;
use App\Services\Excel\User\UserOperationsExcel;
use App\Services\Excel\User\UserReferalsExcel;
use App\Services\Operations\Calculator;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Cookie;
use Illuminate\Support\Facades\Hash;
use DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class UserController extends Controller {

  private $paginate = 10;

  public function __construct() {
    if (Cookie::get('number_records') !== null) {
      $this->paginate = Cookie::get('number_records');
    }
  }

  public function destroy(User $user) {

    User::destroy($user->id);
    return redirect()->back();
  }

  public function index(Request $request) {


    $users = User::paginate(10);

    $users_count = User::count();

    return view('admin.users.index', compact('users', 'users_count'));
  }

  public function update(User $user, Request $request) {
    if ($request->password != null) {
      $user->update(['password' => Hash::make($request->password)]);
    }
    $user->update(['login' => $request->login,
        'email' => $request->email,
        'role_id' => $request->role,
        'banned' => $request->ban,
    ]);
    return redirect(route('admin.users'));
  }

  public function edit(User $user) {

    $roles = Role::all();

    return view('admin.users.edit', compact('user', 'roles'));
  }

  public function inTrashChecked(Request $request) {
    $users = $request->input('checkbox');
    /* TODO удалить операции, которые свзяны с юзерами*/
    User::destroy($users);
    return redirect()->back();
  }

  public function store(Request $request) {

    $user = new User([
        'login' => $request->login,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $request->role
    ]);

    $user->save();

    return redirect()->back();
  }

  public function create() {

    $roles = Role::all();

    return view('admin.users.create', compact('roles'));
  }

  public function indexBlocked(Request $request) {
    $users = User::with('confirmedOperations', 'refers')->where('banned', '=', '1');

    if ($request->input('search') !== null) {
      $users = $users->where('login', 'like', '%' . $request->input('search') . '%');
    }

    if ($request->input('sort') !== null) {

      $users = $users->orderBy($request->input('field'), $request->input('sort'));
    } else {

      $users = $users->orderByDesc('id');
    }

    $users = $users->paginate($this->paginate);

    $users_count = User::count();

    return view('admin.users.blockedUsers', compact('users', 'users_count'));
  }

}
