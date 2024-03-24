@extends('layouts.login')

@section('content')

<!-- 検索フォーム -->
<form action="/search" method="GET">
    <input type="text" name="query" placeholder="ユーザー名">
    <button type="submit"><img src="images/search.png" class="btn btn-post" alt="検索"></button>
</form>

<!-- 検索ワードの表示 -->
@if(request()->input('query'))
    <p>検索ワード: {{ request()->input('query') }}</p>
@endif

<!-- 検索結果の表示 -->
<div>
    <h2>検索結果</h2>
@if(!is_null($users) && count($users) > 0)
        @foreach($users as $user)
                <img src="{{ asset('/images/'.auth()->user()->images) }}" alt="{{ auth()->user()->username }}" class="icon">
                <span>{{ $user->username }}</span>
                    @if(auth()->user()->isFollowing($user->id))
                        {{-- フォロー解除ボタン --}}
                        <form action="{{ route('unfollow') }}" method="POST">
                        @csrf
                        <input type="hidden" name="followed_id" value="{{ $user->id }}">
                        <button type="submit" class="unfollow_btn">フォロー解除</button>
                        </form>
                        @else
                        {{-- フォローボタン --}}
                        <form action="{{ route('follow') }}" method="POST">
                        @csrf
                        <input type="hidden" name="followed_id" value="{{ $user->id }}">
                        <button type="submit" class="follow_btn">フォローする</button>
                        </form>
                    @endif
        @endforeach
@else
    <p>該当するユーザーが見つかりませんでした。</p>
@endif
</div>

@endsection
