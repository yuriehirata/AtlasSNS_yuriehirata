<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Follow;
use App\User;

class FollowsController extends Controller
{
    // フォロー一覧を表示
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

        return view('follows.followList', [
            'user'           => $user,
            'is_following'   => $is_following,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

    // フォロワーリストを表示
    public function followerList(User $user, Follow $follow)
    {
        // フォロワーリストを取得
        $follower_list = $follow->getFollowerList($user->id);

        // ビューにデータを渡して表示
        return view('follows.followerList', [
            'user'          => $user,
            'follower_list' => $follower_list
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
