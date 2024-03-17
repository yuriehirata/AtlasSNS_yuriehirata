<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Follow;

class FollowsController extends Controller
{
    //
    public function followList(){
        $followModel = new Follow();
        $followList = $followModel->getFollowList(auth()->user()->id);
        return view('follows.followList', ['followList' => $followList]);
        // return view('follows.followList');
    }
    public function followerList(){
        $followModel = new Follow();
        $followerList = $followModel->getFollowerList(auth()->user()->id);
        $followerCount = $followModel->countFollowers(auth()->user()->id);
        return view('follows.followerList', ['followerList' => $followerList, 'followerCount' => $followerCount]);
        // return view('follows.followerList');
    }

    public function show(User $user, Follow $follow)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($login_user->id);
        $is_followed = $login_user->isFollowed($login_user->id);
        $follow_count = $follow->getFollowCount($login_user->id);
        $follower_count = $follow->getFollowerCount($login_user->id);

        return view('users.show', [
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }
}
