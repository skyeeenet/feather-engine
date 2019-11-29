<?php

namespace App\Http\Controllers\Admin\BlackList;

use App\BlackList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlackListController extends Controller {

  public function index() {

    $users = BlackList::paginate(15);

    return view('admin.blackList.index', compact('users'));
  }

  public function create() {

    return view('admin.blackList.create');
  }

  public function store(Request $request) {

    $user = new BlackList($request->all());

    $user->save();

    return redirect(route('admin.blackList'));
  }

  public function edit(BlackList $blackList) {

    $user = $blackList;

    return view('admin.blackList.edit', compact('user'));
  }

  public function update(Request $request, BlackList $blackList) {

    $blackList->update($request->all());

    return redirect()->back();
  }

  public function destroy(BlackList $blackList) {

    $blackList->delete();

    return redirect()->back();
  }

}