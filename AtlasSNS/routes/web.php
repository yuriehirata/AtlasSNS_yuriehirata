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

Route::post('/posts', 'PostsController@store')->name('post.index');
});


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');


Route::group(['middleware' => ['auth']], function() {
//ログイン中のページ
// トップページへ遷移
Route::get('/top', 'PostsController@index')->name('top');

//フォローリスト、フォロワーリストページへ遷移
Route::get('/followList', 'FollowsController@show')->name('followList');
Route::get('/followerList', 'FollowsController@show_follower')->name('followerList');

// プロフィール編集
Route::get('/users/{user}/profile', 'UsersController@showProfile')->name('showProfile');
Route::get('/users/{id}/profile', 'UsersController@showProfile')->name('profile.show');
// Route::get('/profile', 'UsersController@profile');

// ユーザー検索
Route::get('/search', 'UsersController@index')->name('search');
Route::get('/search', 'UsersController@search')->name('search');

// ポスト表示
Route::post('/posts', 'PostsController@store');
Route::post('/posts/{id}', 'PostsController@updateForm')->name('posts.update');

// プロフィール編集
Route::get('/profile/edit', 'ProfileController@edit');
Route::post('/profile/update', 'ProfileController@update');
Route::get('/profile', 'ProfileController@edit')->name('profile');


// ポスト編集・削除
Route::post('/post/update', 'PostsController@update');
Route::get('/post/{id}/delete', 'PostsController@delete');

// フォロー・フォロワーのポスト表示
Route::post('/follow', 'FollowsController@follow')->name('follow');
Route::post('/unfollow', 'FollowsController@unfollow')->name('unfollow');

// 他ユーザーのプロフィール表示
Route::get('/users/{id}', 'ProfileController@showUser')->name('usersProfile');


Route::get('/', function () {
    return view('layouts/app');
});

});

//ログアウト
Route::get('/logout', function () {
    // セッションを破棄
    session()->flush();
    // ログイン画面にリダイレクト
    return redirect('/login');
});
