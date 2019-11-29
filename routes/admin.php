<?php
/* ADMIN BEGIN */

Route::group(['middleware' => []], function () {
  Route::get('admin/users/trash', function () {
    return view('admin.users.trash');
  });

  Route::group(['namespace' => 'Admin\Dashboard', 'prefix' => 'admin'], function () {

    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
  });

  Route::group(['namespace' => 'Admin\Users', 'prefix' => 'admin',], function () {
    Route::post('users/{user}', 'UserController@update')->name('admin.users.update');
    Route::get('/users', 'UserController@index')->name('admin.users');
    Route::get('/blockedUsers', 'UserController@indexBlocked')->name('admin.blockedUsers');
    Route::get('/create/user', 'UserController@create')->name('admin.users.create');

    Route::post('/store/user/', 'UserController@store')->name('admin.users.store');

    Route::get('/users/delete/{user}', 'UserController@destroy')->name('admin.users.delete');
    Route::get('/users/referals/{user}', 'UserController@referals')->name('admin.users.referals');
    Route::post('/users/inTrashChecked/', 'UserController@inTrashChecked')->name('admin.users.inTrash');
    Route::get('/users/{user}', 'UserController@edit')->name('admin.users.edit');
    Route::get('/users/referal/operations/{user}', 'UserController@refOperations')->name('admin.users.referal.operations');
    Route::get('/users/operations/{user}', 'UserController@operations')->name('admin.users.operations');


    Route::get('/trash/users', 'UserTrashController@index')->name('admin.users.trash');
    Route::get('/trash/users/{user}/restore', 'UserTrashController@restore')->name('admin.users.trashRestore');
    Route::post('/trash/users/deleteChecked/', 'UserTrashController@deleteChecked')->name('admin.users.deleteChecked');
    Route::post('/trash/users/{user}', 'UserTrashController@destroy')->name('admin.users.trashForceDelete');
  });

  Route::group(['namespace' => 'Admin\Reviews', 'prefix' => 'admin'], function () {

    Route::get('/reviews', 'ReviewController@index')->name('admin.reviews');
    Route::get('/reviews/{review}', 'ReviewController@show')->name('admin.reviews.show');
    Route::get('/create/reviews', 'ReviewController@create')->name('admin.reviews.create');
    Route::get('/reviews/{review}/edit', 'ReviewController@edit')->name('admin.reviews.edit');
    Route::post('/reviews/{review}', 'ReviewController@update')->name('admin.reviews.update');
    Route::post('/review/{review}/delete', 'ReviewController@destroy')->name('admin.reviews.destroy');
    Route::post('/', 'ReviewController@store')->name('admin.reviews.store');
  });

  Route::group(['namespace' => 'Admin\Feedback', 'prefix' => 'admin'], function () {

    Route::get('/feedback', 'FeedbackController@index')->name('admin.feedback');
    Route::get('/create/feedback', 'FeedbackController@create')->name('admin.feedback.create');
    Route::get('/feedback/{feedback}/edit', 'FeedbackController@edit')->name('admin.feedback.edit');
    Route::post('/feedback/{feedback}', 'FeedbackController@update')->name('admin.feedback.update');
    Route::post('/feedback/{feedback}/delete', 'FeedbackController@destroy')->name('admin.feedback.destroy');
  });

  Route::group(['namespace' => 'Admin\BlackList', 'prefix' => 'admin'], function () {

    Route::get('/black-list', 'BlackListController@index')->name('admin.blackList');
    //Route::get('/reviews/{review}', 'ReviewController@show')->name('admin.blackList.show');
    Route::get('/create/black-list', 'BlackListController@create')->name('admin.blackList.create');
    Route::get('/black-list/{blackList}/edit', 'BlackListController@edit')->name('admin.blackList.edit');
    Route::post('/black-list/{blackList}', 'BlackListController@update')->name('admin.blackList.update');
    Route::post('/black-list/{blackList}/delete', 'BlackListController@destroy')->name('admin.blackList.destroy');
    Route::post('/', 'BlackListController@store')->name('admin.blackList.store');
  });

  Route::group(['namespace' => 'Admin\Categories', 'prefix' => 'admin/categories'], function () {

    Route::get('/', 'CategoryController@index')->name('admin.categories');
    Route::get('/create', 'CategoryController@create')->name('admin.categories.create');
    Route::get('/{category}', 'CategoryController@show')->name('admin.categories.show');
    Route::get('/{category}/edit', 'CategoryController@edit')->name('admin.categories.edit');
    Route::post('/', 'CategoryController@store')->name('admin.categories.store');
    Route::post('/{category}', 'CategoryController@update')->name('admin.categories.update');
    Route::post('/delete/{category}', 'CategoryController@destroy')->name('admin.categories.destroy');
  });

  Route::group(['namespace' => 'Admin\Templates', 'prefix' => 'admin/templates'], function () {

    Route::get('/', 'TemplateController@index')->name('admin.templates');
    Route::get('/create', 'TemplateController@create')->name('admin.templates.create');
    Route::get('/edit/{template}', 'TemplateController@edit')->name('admin.templates.edit');
    Route::post('/{template}', 'TemplateController@update')->name('admin.templates.update');
    Route::post('/', 'TemplateController@store')->name('admin.templates.store');
    Route::post('/delete/{template}', 'TemplateController@destroy')->name('admin.templates.destroy');
  });

  Route::group(['namespace' => 'Admin\Pages', 'prefix' => 'admin/pages'], function () {

    Route::get('/', 'PageController@index')->name('admin.pages');
    Route::get('/create', 'PageController@create')->name('admin.pages.create');
    Route::get('/edit/{page}', 'PageController@edit')->name('admin.pages.edit');
    Route::post('/{page}', 'PageController@update')->name('admin.pages.update');
    Route::post('/', 'PageController@store')->name('admin.pages.store');
    Route::post('/delete/{page}', 'PageController@destroy')->name('admin.pages.destroy');
  });

  Route::group(['namespace' => 'Admin\Posts', 'prefix' => 'admin/posts'], function () {

    Route::get('/', 'PostController@index')->name('admin.posts');
    Route::get('/create', 'PostController@create')->name('admin.posts.create');
    Route::get('/edit/{post}', 'PostController@edit')->name('admin.posts.edit');
    Route::post('/{post}', 'PostController@update')->name('admin.posts.update');
    Route::post('/', 'PostController@store')->name('admin.posts.store');
    Route::post('/delete/{post}', 'PostController@destroy')->name('admin.posts.destroy');
  });

  Route::group(['namespace' => 'Admin\Roles', 'prefix' => 'admin/roles'], function () {
    Route::get('/', 'RoleController@index')->name('admin.roles');
    Route::get('/create', 'RoleController@create')->name('admin.roles.create');
    Route::get('/{role}', 'RoleController@edit')->name('admin.roles.edit');
    Route::post('/{role}', 'RoleController@update')->name('admin.roles.update');
    Route::post('/roles/store', 'RoleController@store')->name('admin.roles.store');
    Route::get('/delete/{role}', 'RoleController@destroy')->name('admin.roles.delete');
  });

  Route::group(['namespace' => 'Admin\Settings', 'prefix' => 'admin/settings'], function () {

    Route::get('/', 'SettingsController@index')->name('admin.settings');
    Route::post('/', 'SettingsController@update')->name('admin.settings.update');
  });

  Route::group(['namespace' => 'Admin\Language', 'prefix' => 'admin/languages'], function () {

    Route::get('/', 'LanguageController@index')->name('admin.languages');
    Route::get('/create', 'LanguageController@create')->name('admin.languages.create');
    Route::get('/edit/{language}', 'LanguageController@edit')->name('admin.languages.edit');
    Route::post('/{language}', 'LanguageController@update')->name('admin.languages.update');
    Route::post('/', 'LanguageController@store')->name('admin.languages.store');
    Route::post('/delete/{language}', 'LanguageController@destroy')->name('admin.languages.destroy');
  });

  Route::group(['namespace' => 'Admin\Text', 'prefix' => 'admin/texts'], function () {

    Route::get('/', 'TextController@index')->name('admin.texts');
    Route::get('/create', 'TextController@create')->name('admin.texts.create');
    Route::get('/edit/{text}', 'TextController@edit')->name('admin.texts.edit');
    Route::post('/{text}', 'TextController@update')->name('admin.texts.update');
    Route::post('/', 'TextController@store')->name('admin.texts.store');
    Route::post('/delete/{text}', 'TextController@destroy')->name('admin.texts.destroy');
  });
});