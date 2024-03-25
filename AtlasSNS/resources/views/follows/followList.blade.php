@extends('layouts.login')

@section('content')
{{-- followList.blade.php --}}

<div class="follow-list">
    <h2>フォローしているユーザー</h2>

    {{-- フォローしているユーザーのアイコンを横並べにする --}}
    <div class="following-icons">
        @foreach($followingUsers as $follow)
        <p>{{ $follow->followedUser->username }}</p>
        @endforeach
    </div>

    {{-- フォローしているユーザーの最新のつぶやきを表示する --}}
    <div class="latest-posts">
        <h3>フォローしているユーザーの最新のつぶやき</h3>
        <ul>
            @foreach($posts as $following)
                <li>{{ $following->lates_post->content }}</li>
                dd()
            @endforeach
        </ul>
    </div>
</div>

@endsection
