<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
}

// public function added(){
//     // セッションから登録したユーザー名を取得
//     $registeredUsername = Session::get('registered_username');

//     // 登録完了ページに登録したユーザー名を渡して表示
//     return view('auth.added', ['registeredUsername' => $registeredUsername]);
// }
?>
