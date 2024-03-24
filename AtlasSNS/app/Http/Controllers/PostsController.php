<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{

    public function index()
{
    // 投稿一覧を作成日時で降順にソートして取得
    $posts = Post::orderBy('created_at', 'desc')->get();


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
    public function update(Request $request)
    {
        //バリデーションルールを定義
        $rules = [
            'message' => 'required|max:150', // 最大文字数150を指定
            'content' => 'required', // 投稿内容が必須
        ];

        // バリデーションを実行
        $validator = Validator::make($request->all(), $rules);

        // // バリデーションに失敗した場合
        // if ($validator->fails()) {
            //     return redirect()->back()
            //     ->withErrors($validator)
            //     ->withInput();
            // }

            // 対象の投稿を取得
            //     $post_id = Post::findOrFail($id);

            //     // 投稿内容を更新
            //     $post_id->content = $request->content;
            //     dd($validator);
            // $post_id->save();

            $id = $request->input('post_id');
            $content = $request->input('content');

    Post::where('id',$id)->update([
        'post' => $content
    ]);
    // 更新した投稿のページにリダイレクト
    return redirect()->route('top');

    }

    //投稿を削除
    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('/top');
    }



}
