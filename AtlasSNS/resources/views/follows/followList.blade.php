@extends('layouts.login')

@section('content')
{{-- followList.blade.php --}}
{!! Form::open(['url' => '/followList']) !!}

<div class="">
    <h1>[ フォローリスト ]</h1>
    <div class="follow_icon">
        @foreach ($users as $followed)
        <a href="{{  route('/users/' . $followed->id)  }}">
            <img src="{{ asset('/images/' .$followed->images) }}" alt="フォローアイコン">
        </a>
        @endforeach
    </div>
</div>

@foreach($posts as $post)
    @if($post->user)
    <a href="{{ route('/users/' . $post->user->id) }}"><img src="{{ asset('/images/'.$post->user->images) }}" alt="{{ $post->user->username }}" class="icon"></a>
    @endif
    <p>名前:{{ $post->user->username }}</p>
    <p>投稿内容:{{ $post->post }}</p>
@endforeach
@endsection
