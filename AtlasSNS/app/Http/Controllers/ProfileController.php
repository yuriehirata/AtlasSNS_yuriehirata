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
    $username = Auth::user();
    $username->username = $request->username;
    $username->mail = $request->mail;
    if ($request->password) {
        $username->password = bcrypt($request->password);
    }
    $user->save();
    return redirect('/profile')->with('success', 'プロフィールを更新しました。');
}

}
