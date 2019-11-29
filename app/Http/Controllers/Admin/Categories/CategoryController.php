<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller {

  public function index() {

    $categories = Category::orderBy('sort')->paginate(15);

    return view('admin.categories.index', compact('categories'));
  }

  public function store(Request $request) {

    $category = new Category($request->all());

    $category->save();

    return redirect()->back();
  }

  public function create() {

    return view('admin.categories.create');
  }

  public function edit(Category $category) {

    return view('admin.categories.edit', compact('category'));
  }

  public function update(Category $category, Request $request) {

    $category->update($request->all());

    return redirect(route('admin.categories'));
  }

  public function destroy(Category $category) {

    $category->delete();

    return redirect()->back();
  }
}