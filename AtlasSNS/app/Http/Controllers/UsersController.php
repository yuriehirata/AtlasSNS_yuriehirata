<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;
use App\Post;
use App\Follow;



class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    public function search(Request $request)
{
    // ユーザー名を取得
    $query = $request->input('query');

    // 検索クエリがある場合は、ユーザーを検索
    if ($query) {
        $users = User::where('username', 'like', '%' . $query . '%')
                     ->where('id', '!=', auth()->id())
                     ->get();
    } else {
        // 検索クエリがない場合は、自分以外の全ユーザーを取得
        $users = User::where('id', '!=', auth()->id())->get();
    }

    // 検索結果をビューに渡して表示
    return view('users.search', compact('users'));
}

    public function userssearch(User $user)
    {
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('users.index', [
            'all_users'  => $all_users
        ]);
    }

}
