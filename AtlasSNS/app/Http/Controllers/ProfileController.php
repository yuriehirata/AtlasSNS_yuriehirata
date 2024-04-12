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
    $rules = [
        'username' => 'sometimes|required|min:2|max:12',
        'mail' => 'sometimes|required|email|unique:users,mail,' . Auth::id() . '|min:5|max:40',
        'bio' => 'nullable|string|max:150',
        'icon' => 'nullable|image|mimes:jpeg,png,bmp,gif,svg|max:2048', // 最大2MBまでの画像
    ];

    // パスワードが入力されている場合のみ、パスワード関連のバリデーションルールを追加
    if ($request->filled('password')) {
        $rules['password'] = 'required|string|min:8|max:20';
        $rules['password_confirmation'] = 'required|same:password';
    } else {
        // パスワードが入力されていない場合は、エラーメッセージを設定してバリデーションを失敗させる
        $rules['password'] = 'required|present'; // パスワードが存在することを検証
        $rules['password_confirmation'] = 'required|present'; // 確認用パスワードが存在することを検証
    }

    $request->validate($rules, [
        // カスタムエラーメッセージを定義
        'username.required' => 'ユーザー名は必須です。',
        'username.min' => 'ユーザー名は2文字以上で入力してください。',
        'username.max' => 'ユーザー名は12文字以内で入力してください。',
        'mail.required' => 'メールアドレスは必須です。',
        'mail.email' => '有効なメールアドレスを入力してください。',
        'mail.unique' => 'このメールアドレスは既に使用されています。',
        'mail.min' => 'メールアドレスは5文字以上で入力してください。',
        'mail.max' => 'メールアドレスは40文字以内で入力してください。',
        'mail.email' => '有効なメールアドレスを入力してください。',
        'mail.unique' => 'このメールアドレスは既に使用されています。',
        'password.min' => 'パスワードは8文字以上で入力してください。',
        'password.max' => 'パスワードは20文字以内で入力してください。',
        'password_confirmation.required' => 'パスワード確認用フィールドは必須です。',
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
        'username' => $request->has('username') ? $request->username : $user->username,
        'mail' => $request->has('mail') ? $request->mail : $user->mail,
        'password' => $request->has('password') ? bcrypt($request->password) : $user->password,
        'bio' => $request->has('bio') ? $request->bio : $user->bio,
    ]);

    // アイコン画像のアップロード処理
    if ($request->hasFile('icon')) {
        $image = $request->file('icon');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $user->images = $imageName;
    }

    // ユーザー情報の保存
    $user->save();

    // topページへリダイレクト
    return redirect('/top')->with('success', 'プロフィールを更新しました。');
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
