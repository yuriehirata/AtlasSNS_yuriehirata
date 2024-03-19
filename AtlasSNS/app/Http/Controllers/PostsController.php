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
            'userName' => 'required|max:150', // 最大文字数150を指定
        ];

        // バリデーションを実行
        $validator = Validator::make($request->all(), $rules);

        // バリデーションに失敗した場合
        if ($validator->fails()) {
            return redirect('/top')
                        ->withErrors($validator)
                        ->withInput();
        }

        // バリデーションに成功した場合、投稿を保存する処理を続ける

        // データベースに投稿内容を保存
        Post::create([
            'content' => $request->content,
        ]);

        // 投稿内容を保存した後、ページにリダイレクト
        return redirect()->route('top');
    }
}
