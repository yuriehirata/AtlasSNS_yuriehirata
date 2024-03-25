<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class ProfileController extends Controller
{
 public function edit()
{
    // ログインユーザーの情報を取得
    $username = auth()->username();

    // profile.editビューを表示し、$user変数を渡す
    return view('users.profile', ['user' => $username]);
}

public function update(Request $request)
{
    $user = Auth::user();
    $user->username = $request->username;
    $user->mail = $request->mail;
    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    // アイコン画像のアップロード処理
    if ($request->hasFile('images')) {
        // 画像がアップロードされた場合の処理
        $image = $request->file('images');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $user->images = $imageName; // ユーザー情報に画像ファイル名を保存
    }

    $user->save();
    return redirect('/profile')->with('success', 'プロフィールを更新しました。');
}

public function show(User $user)
    {
        return view('profile', compact('user'));
    }

}
