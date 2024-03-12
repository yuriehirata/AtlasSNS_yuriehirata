<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request){
    if($request->isMethod('post')){
        // バリデーションルール
        $rules = [
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|email|unique:users,mail|max:40',
            'password' => 'required|string|regex:/^[a-zA-Z0-9]+$/|min:8|max:20|confirmed',
        ];

        // バリデーションの実行
        $validator = $request->validate($rules);
        //エラーの中身を確認するデバック関数
        //ddd($validator);

        //バリデーションが失敗した時
        if ($validator->fails()) {
            return redirect('auth.register')
                        ->withErrors($validator)
                        ->withInput();
        }

        //バリデーションが成功した時
        $username = $request->input('username');
        $mail = $request->input('mail');
        $password = $request->input('password');

        User::create([
            'username' => $username,
            'mail' => $mail,
            'password' => bcrypt($password),
        ]);

        //ユーザー名を保存
        // Session::put('registered_username', $username);
        // return redirect('added');



    }

    return view('auth.register');

}




public function added(){
        return view('auth.added');
    }
}
