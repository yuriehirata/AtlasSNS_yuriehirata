<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 初期ユーザーデータの配列を定義
        $users = [
            [
                'username' => 'user1',
                'email' => 'user1@example.com',
                'password' => Hash::make('password1') // パスワードをハッシュ化
            ],
            [
                'username' => 'user2',
                'email' => 'user2@example.com',
                'password' => Hash::make('password2') // パスワードをハッシュ化
            ],
            // 追加のユーザーを必要に応じてここに追加
        ];

        // ユーザーをデータベースに登録
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
