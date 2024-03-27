@extends('layouts.login')

@section('content')
    {!! Form::open(['url' => url('users' . $user->id ')]) !!}
    <div>
        <img src="{{ asset('/images/' . $user->images) }}" alt="アイコン">
    </div>
    <div>
        <p>ユーザー名: {{ $user->username }}</p>
    </div>
    <div>
        <p>自己紹介: {{ $user->bio }}</p>
    </div>
    <div>
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
    </div>
    <ul>
        @foreach($posts as $post)
            <li>{{ $post->content }}</li>
        @endforeach
    </ul>
    {!! Form::close() !!}
@endsection
