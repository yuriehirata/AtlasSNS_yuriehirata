<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // ユーザー名を取得
        $query = $request->input('query');

        // 検索クエリがある場合は、ユーザーを検索
        if ($query) {
            $users = User::where('name', 'like', '%' . $query . '%')
                         ->where('id', '!=', auth()->id())
                         ->get();
        } else {
            // 検索クエリがない場合は、自分以外の全ユーザーを取得
            $users = User::where('id', '!=', auth()->id())->get();
        }

        // 検索結果をビューに渡して表示
        return view('search.index', compact('users'));
    }
}
