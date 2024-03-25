<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Follow;
use App\User;

class FollowsController extends Controller
{
    public function show(User $user, Follow $follow)
    {
        $login_user = auth()->user();
        if ($login_user) {
            $is_following = $login_user->isFollowing($user->id);
        } else {
            $is_following = false;
        }
        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);
        $followingUsers = Follow::with('followingUser')->where('following_id', auth()->id())->get();
        $followedUsers = Follow::with('followedUser')->where('followed_id', auth()->id())->get();

        // フォローリストを取得
        $following_list = $follow->getFollowList($user->id);

        return view('follows.followList', [
            'user'           => $user,
            'is_following'   => $is_following,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'following_list' => $following_list,
            'followingUsers' => $followingUsers, // 追加
            'followedUsers' => $followedUsers, // 追加
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
}
