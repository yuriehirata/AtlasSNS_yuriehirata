<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use App\Models\User;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password', 'bio',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // 指定されたユーザーID以外のすべてのユーザーを取得
     public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(5);
    }
    // ユーザーがフォローしているユーザーの関連を定義
    // follows テーブルを結合して、フォローしているユーザーの情報を取得
    public function follows()
    {
    return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    // ユーザーがフォローしているユーザーの関連を定義
    // follows テーブルを結合して、フォローしているユーザーの情報を取得
    public function followers()
    {
    return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }

    // 指定されたユーザーIDをフォロー
    public function follow($user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // 指定されたユーザーIDのフォローを解除
    public function unfollow($user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // 指定されたユーザーIDをフォローしているかどうかを確認
    public function isFollowing($user_id)
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->exists();
    }

    // 指定されたユーザーIDにフォローされているかどうかを確認
    public function isFollowed($user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->exists();
    }

    // 指定されたユーザーIDにフォローされているかどうかを確認
    public function isFollowedBy($user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->exists();
    }

    // ユーザーがフォローしている人数を取得
    public function followingCount()
    {
        return $this->follows()->count();
    }

    // ユーザーをフォローしている人数を取得
    public function followerCount()
    {
        return $this->followers()->count();
    }

    // ユーザーが投稿したポストの関連を定義
    // posts テーブルとのリレーションを持ち、ユーザーの投稿を取得
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
