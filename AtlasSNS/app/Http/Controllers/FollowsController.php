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
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        return view('follows.followList', [
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

    public function followerList(User $user, Follow $follow)
    {
        // ログインユーザーを取得
        $login_user = auth()->user();

        // フォロワーリストを取得
        $follower_list = $follow->getFollowerList($user->id);

        // ビューにデータを渡して表示
        return view('follows.followerList', [
            'user'          => $user,
            'follower_list' => $follower_list
        ]);
    }
}
