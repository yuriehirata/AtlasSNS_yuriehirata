<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'following_id', 'followed_id'
    ];

    // 指定されたユーザーIDが、フォローされているかどうかを確認。
    // $user_id によって指定されたユーザーがフォローされている場合は true を返し、そうでない場合は false を返す。
    public function isFollowingBy($user_id)
    {
        return $this->where('followed_id', $user_id)->exists();
    }

    // 指定されたユーザーがフォローしている人数を取得。
    public function getFollowCount($user_id)
    {
        return $this->where('following_id', '<>', $user_id)->count();
    }

    // 指定されたユーザーがフォローしている人数を取得。
    public function getFollowerCount($user_id)
    {
        return $this->where('followed_id', '<>', $user_id)->count();
    }

    // 指定されたユーザーがフォローしている人数を取得。
    public function getFollowList($user_id)
    {
        return $this->where('following_id', $user_id)->get();
    }

    // 指定されたユーザーをフォローしているユーザーのリストを取得。
    public function getFollowerList($user_id)
    {
        return $this->where('followed_id', $user_id)->get();
    }

    // フォローされている人数をカウント
    public function countFollowers($user_id)
    {
        return $this->where('followed_id', $user_id)->count();
    }

    // フォローしている人数をカウント
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
