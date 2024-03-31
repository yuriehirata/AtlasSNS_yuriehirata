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

     public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(5);
    }

    public function follows()
    {
    return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    public function followers()
    {
    return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }

    public function follow($user_id)
    {
        return $this->follows()->attach($user_id);
    }

    public function unfollow($user_id)
    {
        return $this->follows()->detach($user_id);
    }

    public function isFollowing($user_id)
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->exists();
    }

    public function isFollowed($user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->exists();
    }

    public function isFollowedBy($user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->exists();
    }

    public function followingCount()
    {
        return $this->follows()->count();
    }

    public function followerCount()
    {
        return $this->followers()->count();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
