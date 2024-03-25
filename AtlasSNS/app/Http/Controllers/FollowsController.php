<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Follow;
use App\User;
use App\Post;

class FollowsController extends Controller
{
    public function show(User $user, Follow $follow)
    {
        // ログインユーザー名の取得
        $login_user = auth()->user();
        if ($login_user) {
            $is_following = $login_user->isFollowing($user->id);
        } else {
            $is_following = false;
        }
        // フォローしている人数をカウント
        $follow_count = $follow->getFollowCount($user->id);
        // フォローされている人数をカウント
        $follower_count = $follow->getFollowerCount($user->id);

        //フォローリスト
        //現在ログインしているユーザーがフォローしているユーザーのIDのリストを取得（pluck→掴み取る）
        $followingUsers = Follow::where('following_id', auth()->id())->pluck('followed_id');
        // usersテーブルからidを、$followingusersのidを選択し取得（whereIn→複数の要素を取得）
        $users = User::whereIn('id',$followingUsers)->get();
        // 現在ログインしているユーザーをフォローしているユーザーのレコードを取得
        $followedUsers = Follow::where('followed_id', auth()->id())->pluck('following_id');
        // フォローしているユーザーの投稿を取得
        $posts = Post::whereIn('user_id',$followingUsers)->orderBy('created_at', 'desc')->get();

        // フォロワーリスト
        //現在ログインしているユーザーがフォローしているユーザーのIDのリストを取得（pluck→掴み取る）
        $followedUsers = Follow::where('followed_id', auth()->id())->pluck('following_id');
        // usersテーブルからidを、$followedusersのidを選択し取得（whereIn→複数の要素を取得）
        $users_followed = User::whereIn('id',$followedUsers)->get();
        // 現在ログインしているユーザーをフォローしているユーザーのレコードを取得
        $followingUsers = Follow::where('following_id', auth()->id())->pluck('followed_id');
        // フォローしているユーザーの投稿を取得
        $posts_followed = Post::whereIn('user_id',$followedUsers)->orderBy('created_at', 'desc')->get();


        // 特定のユーザーが指定したユーザーにフォローされているかどうかを確認するための処理
        $isFollowed = $user->isFollowedBy(auth()->id());
        // フォローリストを取得
        $following_list = $follow->getFollowList($user->id);

        return view('follows.followList', [
            'user'           => $user,
            'is_following'   => $is_following,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'following_list' => $following_list,
            'followingUsers' => $followingUsers,
            'followedUsers' => $followedUsers,
            'users' => $users,
            'posts' => $posts,
        ]);
    }

    public function show_followed(User $user, Follow $follow)
    {
        // ログインユーザー名の取得
        $login_user = auth()->user();
        if ($login_user) {
            $is_following = $follow->isFollowingBy($login_user->id);
        } else {
            $is_following = false;
        }
        // フォローしている人数をカウント
        $follow_count = $follow->getFollowCount($user->id);
        // フォローされている人数をカウント
        $follower_count = $follow->getFollowerCount($user->id);

        // フォロワーリスト
        // 現在ログインしているユーザーがフォローしているユーザーのIDのリストを取得
        $followedUsers = Follow::where('followed_id', auth()->id())->pluck('following_id');
        // usersテーブルからidを、$followedusersのidを選択し取得
        $users_followed = User::whereIn('id', $followedUsers)->get();

        // 特定のユーザーが指定したユーザーにフォローされているかどうかを確認するための処理
        $is_following = $follow->isFollowingBy(auth()->id());
        // フォロワーリストを取得
        $followed_list = $follow->getFollowerList($user->id);
        // フォローリストを取得
        $following_list = $follow->getFollowList($user->id);
        // 現在ログインしているユーザーをフォローしているユーザーのレコードを取得
        $followingUsers = Follow::where('following_id', auth()->id())->pluck('followed_id');



        return view('follows.followerList', [
            'user'           => $user,
            'is_following'   => $is_following,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'following_list' => $following_list,
            'followingUsers' => $followingUsers,
            'followedUsers' => $followedUsers,
            'users' => $users_followed,
        ]);
    }

    // ユーザーをフォローする
    public function follow(Request $request)
    {
        $user_id_to_follow = $request->input('followed_id');
        auth()->user()->follow($user_id_to_follow);

        return redirect()->back()->with('success', 'ユーザーをフォローしました');
    }

    // フォローを解除する
    public function unfollow(Request $request)
    {
        $user_id_to_unfollow = $request->input('followed_id');
        auth()->user()->unfollow($user_id_to_unfollow);

        return redirect()->back()->with('success', 'フォローを解除しました');
    }

    public function followList()
    {
        // フォローしているユーザーのidを取得
        $following_id = Auth::user()->follows()->pluck('followed_id');

        $followings = User::whereIn('user_id', $following_id)->get();
        return view('/follows/followList' , compact('followings'));
    }


    public function followerList()
    {
        // フォローされているユーザーのidを取得
        $followed_id = Auth::user()->follows()->pluck('following_id');
        $followeds = User::whereIn('id', $followed_id)->get();

        return view('follows.followerList', compact('followeds'));
    }


}
