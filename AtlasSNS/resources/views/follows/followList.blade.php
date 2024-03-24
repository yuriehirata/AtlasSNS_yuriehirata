@extends('layouts.login')

@section('content')
{{-- followList.blade.php --}}

<div class="follow-list">
    <h2>フォローしているユーザー</h2>

    {{-- フォローしているユーザーのアイコンを横並べにする --}}
    <div class="following-icons">
        @foreach($following_list as $following)
            <div class="following-icon">
                <img src="{{ asset('/images/'.auth()->user()->images) }}" alt="{{ auth()->user()->username }}" class="icon">
                <p>{{ $following->username }}</p>
            </div>
        @endforeach
    </div>

    {{-- フォローしているユーザーの最新のつぶやきを表示する --}}
    <div class="latest-posts">
        <h3>フォローしているユーザーの最新のつぶやき</h3>
        <ul>
            @foreach($following_list as $following)
                <li>{{ $following->latest_post->content }}</li>
            @endforeach
        </ul>
    </div>
</div>

@endsection
