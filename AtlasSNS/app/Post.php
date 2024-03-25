<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    //
    protected $fillable = ['user_id','post',];

    // PostモデルとUserモデルの関連付けを定義する
    public function user()
    {
        // Userモデルとの関連付けを示す
        return $this->belongsTo(User::class);
    }

}
