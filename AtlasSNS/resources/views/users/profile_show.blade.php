@extends('layouts.login')

@section('content')

    <td>
        <img src="{{ asset('/images/' . $user->images) }}" alt="アイコン" class="post-contents icon">
    </td>
    <td>
        <p>ユーザー名: {{ $user->username }}</p>
    </td>
    <td>
        <p>自己紹介: {{ $user->bio }}</p>
    </td>
    <td>
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
    </td>
    <br>
    <hr>
    <br>
  <table>
    @foreach($posts as $post)
    <tr>
    <td posts><img src="{{ asset('/images/' . $user->images) }}" alt="アイコン"  class="post-contents icon"></td>
    <td class="post-contents">{{ $post->post }}</td>
    <td class="post-time">{{ $post->created_at->format('Y-m-d H:i') }}</td>
    </tr>
    @endforeach
  </table>

@endsection
