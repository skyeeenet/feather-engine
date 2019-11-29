<?php


namespace App\Http\Controllers\Admin\Roles;


use App\Http\Controllers\Controller;
use App\Settings;
use Illuminate\Http\Request;
use App\Role;
use Cookie;

class RoleController extends Controller {

    private $paginate = 10;

    public function __construct()
    {
        if (Cookie::get('number_records') !== null) {
            $this->paginate = Cookie::get('number_records');
        }
    }

  public function index() {
      $roles = Role::paginate($this->paginate);
      return view('admin.roles.index', compact('roles'));
  }

  public function create() {
        return view('admin.roles.create');
  }

  public function store(Request $request) {
      $role = new Role([
          'value'=> $request->value,
      ]);

      $role->save();
      return redirect(route('admin.roles'));
  }

  public function edit(Role $role) {
        return view('admin.roles.edit', compact('role'));
  }

  public function show(Role $role){
  }

  public function update(Role $role, Request $request) {
      $role->update($request->all());
      return redirect(route('admin.roles'));
  }

  public function destroy(Role $role) {
      Role::destroy($role->id);
      return redirect()->back();
  }
}