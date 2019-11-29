<?php

include_once 'admin.php';

//Route::get('/', 'MainController@index');

Route::get('setlocale/{locale}', function ($locale) {

  if (in_array($locale, \Config::get('app.locales'))) {   # Проверяем, что у пользователя выбран доступный язык
    Session::put('locale', $locale);                    # И устанавливаем его в сессии под именем locale
  }

  return redirect()->back();                              # Редиректим его <s>взад</s> на ту же страницу

});

Auth::routes(['verify' => true]);

/*Route::group(['middleware'=>['auth', 'checkBan', 'verified']],function(){

  Route::get('/home', 'HomeController@index')->name('home');
});*/

Route::get('/email/success', function () {
  return view('emails.success');
});

Route::group(['namespace' => 'Home'], function () {

  Route::get('/', 'HomeController@index')->name('public.home');
});

Route::group(['namespace' => 'Posts', 'prefix' => 'posts'], function () {

  Route::get('/', 'PostController@index')->name('public.posts');
  Route::get('/create', 'PostController@create')->middleware('auth')->name('public.posts.create');
  Route::get('/{post}', 'PostController@show')->name('public.posts.show');
  Route::post('/', 'PostController@store')->middleware('auth')->name('public.posts.store');

});

Route::group(['namespace' => 'Reviews', 'prefix' => 'reviews', 'middleware'=>['auth', 'checkBan']], function () {

  Route::post('/', 'ReviewController@store')->middleware('auth')->name('public.reviews.store');
});

/*Route::group(['namespace' => 'Slug'], function () {

  Route::get('/{slug}', 'SlugController@show')->name('public.slug');
});*/

Route::group(['namespace' => 'Categories', 'prefix' => 'category'], function () {

  Route::get('/{slug}', 'CategoryController@show')->name('public.categories.show');
});

Route::group(['namespace' => 'Pages', 'prefix' => 'page'], function () {

  Route::get('/{slug}', 'PageController@show')->name('public.pages.show');
});

Route::group(['namespace' => 'Search', 'prefix' => 'search'], function () {

  Route::get('/', 'SearchController@show')->name('public.search.show');
});

Route::group(['namespace' => 'Feedback', 'prefix' => 'feedback'], function () {

  Route::post('/', 'FeedbackController@store')->name('public.feedback.store');
});
