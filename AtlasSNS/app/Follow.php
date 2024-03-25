<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'following_id', 'followed_id'
    ];


    public function getFollowCount($user_id)
    {
        return $this->where('following_id', '<>', $user_id)->count();
    }

    public function getFollowerCount($user_id)
    {
        return $this->where('followed_id', '<>', $user_id)->count();
    }

    public function getFollowList($user_id)
    {
        return $this->where('following_id', $user_id)->get();
    }

    public function getFollowerList($user_id)
    {
        return $this->where('followed_id', $user_id)->get();
    }

    public function countFollowers($user_id)
    {
        return $this->where('followed_id', $user_id)->count();
    }

    public function countFollowing($user_id)
    {
        return $this->where('following_id', $user_id)->count();
    }

    // フォローをしているユーザーを取得
    public function following()
    {
        return $this->belongsTo(User::class, 'following_id');
    }

    // フォローされているユーザーを取得
    public function follower()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }
}
