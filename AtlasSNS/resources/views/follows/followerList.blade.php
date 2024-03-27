@extends('layouts.login')

@section('content')
    {{-- followerList.blade.php --}}
    {!! Form::open(['url' => '/followerList']) !!}

    <!-- フォローされている人のアイコン一覧 -->
<div class="">
    <h1>[ フォロワーリスト ]</h1>
    <div class="follow_icon">
        @foreach ($users as $follower)
        <a href="{{ route('/users/' . $follower->id) }}">
            <img src="{{ asset('/images/' . $follower->images) }}" alt="フォローアイコン">
        </a>
        @endforeach
    </div>
</div>
@foreach($posts as $post)
    @if($post->user)
    <a href="{{ route('/users/' . $post->user->id) }}">
        <img src="{{ asset('/images/'.$post->user->images) }}" alt="{{ $post->user->username }}" class="icon"></a>
    @endif
    <p>名前:{{ $post->user->username }}</p>
    <p>投稿内容:{{ $post->post }}</p>
@endforeach
@endsection
