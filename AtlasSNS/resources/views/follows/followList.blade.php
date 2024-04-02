@extends('layouts.login')

@section('content')
{{-- followList.blade.php --}}
{!! Form::open(['url' => '/followList']) !!}
<div class="form_group flex_follow">
    <div class="left_follow">
        <h1>[ フォローリスト ]</h1>
    </div>
    <div>
        <div class="center_follow">
            <div>
                @foreach ($users as $followed)
                <a href="{{ route('usersProfile', ['id' => $followed->id]) }}">
                    <img src="{{ asset('/images/' .$followed->images) }}" alt="フォローアイコン" class="post-contents icon">
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
