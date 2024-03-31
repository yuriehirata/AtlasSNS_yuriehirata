<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use APP\Post;
use App\Follow;

class ProfileController extends Controller
{
 public function edit(Request $request)
{
    // profile.editビューを表示し、$user変数を渡す
    return view('users.profile');
}

public function update(Request $request)
{
    // バリデーションルールを定義
    $request->validate([
        'username' => 'required|min:2|max:12',
        'mail' => 'required|email|unique:users,mail,'.Auth::id(),
        'password' => 'nullable|string|min:8|max:20',
        'password_confirmation' => 'nullable|same:password',
        'bio' => 'string|max:150',
        'icon' => 'nullable|image|mimes:jpeg,png,bmp,gif,svg|max:2048', // 最大2MBまでの画像
    ], [
        // カスタムエラーメッセージを定義
        'username.required' => 'ユーザー名は必須です。',
        'username.min' => 'ユーザー名は2文字以上で入力してください。',
        'username.max' => 'ユーザー名は12文字以内で入力してください。',
        'mail.required' => 'メールアドレスは必須です。',
        'mail.email' => '有効なメールアドレスを入力してください。',
        'mail.unique' => 'このメールアドレスは既に使用されています。',
        'password.min' => 'パスワードは8文字以上で入力してください。',
        'password.max' => 'パスワードは20文字以内で入力してください。',
        'password_confirmation.same' => 'パスワードが一致しません。',
        'bio.max' => '自己紹介は150文字以内で入力してください。',
        'icon.image' => '画像ファイルを選択してください。',
        'icon.mimes' => '画像フォーマットはJPEG、PNG、BMP、GIF、SVGのいずれかを選択してください。',
        'icon.max' => '画像ファイルのサイズは2MB以下にしてください。',
    ]);


    // ユーザー情報の取得
    $user = Auth::user();

    // フォームからの入力をユーザーモデルに反映
    $user->fill([
        'username' => $request->username,
        'mail' => $request->mail,
        'password' => $request->password ? bcrypt($request->password) : $user->password,
        'bio' => $request->bio,
    ]);

    // アイコン画像のアップロード処理
    if ($request->hasFile('icon')) {
        $image = $request->file('icon');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $user->images = $imageName;
    }

    // ユーザー情報の保存
    $user->save();

    // プロフィールページへリダイレクト
    return redirect('/profile')->with('success', 'プロフィールを更新しました。');
}

    // ユーザープロフィールを表示
    public function profile(User $user)
    {
        return view('users.profile', ['user' => $user]);
    }
    // ユーザーのポスト情報を取得（最新のものから）
    public function showUser($id)
    {
        $user = User::find($id);
        $posts = $user->posts()->latest()->get();
        //dd($posts);
        return view('users.profile_show', compact('user', 'posts'));
    }

}
