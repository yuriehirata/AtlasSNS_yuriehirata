{{-- profile_show.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} のプロフィール</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- CSSファイルのリンク --}}
</head>
<body>
    <div class="container">
        <h1>{{ $user->name }} のプロフィール</h1>
        <p>Email: {{ $user->email }}</p>
        {{-- 他のユーザー情報を表示 --}}
    </div>

    <script src="{{ asset('js/app.js') }}"></script> {{-- JavaScriptファイルのリンク --}}
</body>
</html>
