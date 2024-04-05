@extends('layouts.login')

@section('content')
    {{-- followerList.blade.php --}}
    {!! Form::open(['url' => '/followerList']) !!}

    <!-- フォローされている人のアイコン一覧 -->
<div class="form_group flex_follow">
    <div class="left_follow">
        <h1>[ フォロワーリスト ]</h1>
    </div>
    <div>
        <div class="center_follow">
            <div>
                @foreach ($users as $follower)
                <a href="{{ route('usersProfile', ['id' => $follower->id]) }}">
                    <img src="{{ asset('/images/' . $follower->images) }}" alt="フォローアイコン" class="post-contents icon">
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

    <div>
        <div>
            @foreach($posts as $post)
                <div class="post">
                    @if($post->user)
                    <div class="left">
                        <a href="{{ route('usersProfile', ['id' => $post->user->id]) }}">
                            <img src="{{ asset('/images/'.$post->user->images) }}" alt="{{ $post->user->username }}" class="icon"></a>
                    </div>
                    @endif
                    <div class="center">
                        <div class="post-user">{{ $post->user->username }}</div>
                        <div class="post-contents">{{ $post->post }}</div>
                    </div>
                    <div class="post-time right">{{ $post->created_at->format('Y-m-d H:i') }}</div>
                    <br>
                    </div>
            @endforeach
        </div>
    </div>

@endsection
