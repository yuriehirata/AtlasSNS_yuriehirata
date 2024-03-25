@extends('layouts.login')

@section('content')
{{-- followList.blade.php --}}

    <!-- フォローしている人のアイコン一覧 -->
    <div class="">
        <h1>[ フォローリスト ]</h1>
        <div class="follow_icon">
            @foreach ($users as $user)
            <a href="{{ route('profile', ['user' => $user->id]) }}"><img src="{{ asset('/images/' .$user->images) }}" alt="フォローアイコン"></a>

            @endforeach
        </div>
    </div>

    @foreach($posts as $post)
        @if($post->user)
            <a href="{{ route('profile', ['user' => $user->id]) }}"><img src="{{ asset('/images/'.$post->user->images) }}" alt="{{ auth()->user()->username }}" class="icon"></a>
        @endif
        <p>名前:{{ $post->user->username }}</p>
        <p>投稿内容:{{ $post->post }}</p>
    @endforeach
@endsection
