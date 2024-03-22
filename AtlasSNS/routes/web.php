<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Post;
use App\Follow;
use App\User;

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
Route::group(['middleware' => 'auth'], function () {

    // ユーザ関連
    Route::resource('users', 'UsersController');

    Route::post('/posts', 'PostsController@store')->name('post.index');
});


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top', 'PostsController@index')->name('top');

Route::get('/profile', 'UsersController@profile');

Route::get('/search', 'UsersController@index');

Route::get('/followList', 'FollowsController@show');
Route::get('/followerList', 'FollowsController@followerList');
Route::get('/search', 'UsersController@search');

Route::get('/', function () {
    return view('layouts/app');
});

Route::post('/posts', 'PostsController@store');

Route::put('/posts/{id}', 'PostsController@update')->name('posts.update');

Route::get('/profile/edit', 'ProfileController@edit');
Route::post('/profile/update', 'ProfileController@update');

// Route::get('/followlist', 'FollowsController@followList');
// Route::get('/followerlist', 'FollowsController@followerList');


//ログアウト
Route::get('/logout', function () {
    // セッションを破棄
    session()->flush();
    // ログイン画面にリダイレクト
    return redirect('/login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/show', 'FollowsController@show');
});
