@extends('layouts.login')

@section('content')
<div class="form_group">
    <div class="flex_profile_show">
        <div class="flex_profile_show">
          <div class="left_profile_show">
              <img src="{{ asset('/images/' . $user->images) }}" alt="アイコン" class="post-contents icon">
          </div>
          <div class="block">
            <div>
                <p>ユーザー名: {{ $user->username }}</p>
            </div>
            <div>
                <p>自己紹介: {{ $user->bio }}</p>
            </div>
          </div>
        </div>

        <div>
            @if(auth()->user()->isFollowing($user->id))
                {{-- フォロー解除ボタン --}}
              <form id="unfollowForm" action="{{ route('unfollow') }}" method="POST">
              @csrf
              <input type="hidden" name="followed_id" value="{{  $user->id }}">
              <button type="submit" class="unfollow_btn">フォロー解除</button>
              </form>
              @else
                {{-- フォローボタン --}}
              <form id="followForm" action="{{ route('follow') }}" method="POST">
              @csrf
              <input type="hidden" name="followed_id" value="{{  $user->id }}">
              <button type="submit"  class="follow_btn">フォローする</button>
              </form>
            @endif
        </div>
      </div>
</div>
    <div>
        @foreach($posts as $post)
        <div class="post_profile_show">
          <div class="flex_profile_show">
            <div class="left_profile_show">
              <img src="{{ asset('/images/' . $user->images) }}" alt="アイコン"  class="post-contents icon">
            </div>
            <div class="block">
                <div class="post-user">{{ $post->user->username }}</div>
                <div class="post-contents center">{{ $post->post }}</div>
            </div>
            </div>
            <div class="post-time right">{{ $post->created_at->format('Y-m-d H:i') }}</div>
        </div>
        @endforeach
    </div>

@endsection
