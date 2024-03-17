<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 Route::get('/', function () {
     return view('welcome');
 });

 Auth::routes();

 Route::get('/home', 'HomeController@index')->name('home');



// ログイン状態
Route::group(['middleware' => 'auth'], function() {

    // ユーザ関連
Route::resource('users', 'UsersController');


});



//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

   //ログイン中のページ
Route::get('/top','PostsController@index');

Route::get('/profile','UsersController@profile');

Route::get('/search','UsersController@index');

Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');

Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);



//ログアウト
Route::get('/logout', function () {
    // セッションを破棄
    session()->flush();
    // ログイン画面にリダイレクト
    return redirect('/login');
});

Route::group(['middleware' => 'auth'], function() {
Route::get('/show','FollowsController@show');
});
