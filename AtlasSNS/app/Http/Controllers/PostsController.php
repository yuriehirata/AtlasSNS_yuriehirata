<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{

    public function index()
    {
        // 投稿一覧を取得
        $posts = Post::all();

        // index.blade.php ページにデータを渡して表示
        return view('posts.index', compact('posts'));
    }

public function store(Request $request)
{
    // バリデーションルールを定義
    $rules = [
        'content' => 'required', // 投稿内容が必須
    ];


    // バリデーションを実行
    $validator = Validator::make($request->all(), $rules);

    // バリデーションに失敗した場合
    if ($validator->fails()) {
        return redirect('/top')
                    ->withErrors($validator)
                    ->withInput();
    }

    // ログインしているユーザーのIDを取得
    $user_id = auth()->id();

    // データベースに投稿内容を保存
    $newPost = Post::create([
        'post' => $request -> content,
        'user_id' => $user_id, // ログインしているユーザーのIDをセット
    ]);

    // 投稿内容を保存した後、ページにリダイレクト
    return redirect()->route('top')->with('newPost', $newPost);
}


    public function updateForm($id)
    {
        $post = Post::where('id', $id)->first();
        return view('posts.index', ['post' => $post]);
    }

    public function update(Request $request, $id)
{
    // バリデーションルールを定義
    $rules = [
        'userName' => 'required|max:150', // 最大文字数150を指定
        'content' => 'required', // 投稿内容が必須
    ];

    // バリデーションを実行
    $validator = Validator::make($request->all(), $rules);

    // バリデーションに失敗した場合
    if ($validator->fails()) {
        return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
    }

    // 対象の投稿を取得
    $post = Post::findOrFail($id);

    // 投稿内容を更新
    $post->content = $request->content;
    $post->save();

    // 更新した投稿のページにリダイレクト
    return redirect()->route('top');
}
}
