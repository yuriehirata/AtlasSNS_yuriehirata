@extends('layouts.login')

@section('content')
{{-- followerList.blade.php --}}

<div class="follower-list">
    <h2>フォロワーリスト</h2>

    {{-- フォロワーのアイコンを横並べにする --}}
    <div class="follower-icons">
        @foreach($follower_list as $follower)
            <div class="follower-icon">
                <img src="{{ asset('/images/'.auth()->user()->images) }}" alt="{{ auth()->user()->username }}" class="icon">
                <p>{{ $follower->username }}</p>
            </div>
        @endforeach
    </div>

    {{-- フォロワーの最新のつぶやきを表示する --}}
    <div class="latest-posts">
        <h3>フォロワーの最新のつぶやき</h3>
        <ul>
            @foreach($follower_list as $follower)
                <li>{{ $follower->latest_post->content }}</li>
            @endforeach
        </ul>
    </div>
</div>

@endsection
