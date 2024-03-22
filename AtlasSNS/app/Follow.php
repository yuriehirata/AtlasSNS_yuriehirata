<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Follow;


class Follow extends Model
{
    protected $fillable = [
    'following_id', 'followed_id'
  ];

  public function followerList(User $user)
{
    // フォロワーリストを取得
    $follower_list = Follow::where('followed_id', $user->id)->get();

    // ビューにデータを渡して表示
    return view('follows.followerList', [
        'user'          => $user,
        'follower_list' => $follower_list
    ]);
}

  public function getFollowCount($user_id)
  {
      return $this->where('following_id','<>', $user_id)->count();
  }

  public function getFollowerCount($user_id)
  {
      return $this->where('followed_id','<>',  $user_id)->count();
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
