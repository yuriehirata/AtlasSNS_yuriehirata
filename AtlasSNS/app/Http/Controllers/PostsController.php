<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Post;
use App\User;
use App\Follow;

class PostsController extends Controller
{

    public function index()
{
    // 投稿一覧を作成日時で降順にソートして取得
    $posts = Post::orderBy('created_at', 'desc')->get();

    // 各投稿に関連付けられたユーザーオブジェクトを取得
    $users = [];
    foreach ($posts as $post) {
        $user = User::find($post->user_id);
        $users[$post->id] = $user ? $user->username : '';
    }

    // ログインしているユーザーがフォローしているユーザーのIDを取得
    $followingIds = auth()->user()->follows()->pluck('followed_id')->toArray();

    // ログインしているユーザーのIDとフォローしているユーザーのIDを含む投稿のみを取得
    $posts = Post::whereIn('user_id', $followingIds)
                ->orWhere('user_id', auth()->id())
                ->latest()
                ->get();

    // index.blade.php ページにデータを渡して表示
    return view('posts.index', compact('posts', 'users'));
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
        public function messages()
    {
        return [
            'content.required' => '投稿内容を入力してください。',
            'content.min' => '投稿内容は少なくとも1文字以上必要です。',
        ];
    }


    public function update(Request $request)
    {
        // バリデーションルールを定義
        $rules = [
            'content' => 'required|min:1', // 投稿内容が必須で、1文字以上
        ];

        // カスタムエラーメッセージの定義
        $messages = [
            'content.required' => '投稿内容は必須です。',
            'content.min' => '投稿内容は少なくとも1文字以上必要です。',
        ];

        // バリデーションを実行
        $validator = Validator::make($request->all(), $rules, $messages);

        // バリデーションに失敗した場合
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 以下の処理はバリデーションが成功した場合のみ実行される

        // 投稿の更新処理
        $id = $request->input('post_id');
        $content = $request->input('content');

        Post::where('id', $id)->update([
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

        public function show()
    {
        // フォローしているユーザーのidを取得
        $following_id = Auth::user()->follows()->pluck('following_id');
        // フォローしているユーザーのidを元に投稿内容を取得
        $posts = Post::with('user')->whereIn('user_id', $following_id)->get();

        return view('followList', compact(‘posts’));
    }


}
