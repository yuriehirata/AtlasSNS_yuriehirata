@extends('layouts.login')

@section('content')
    {{-- followerList.blade.php --}}
    {!! Form::open(['url' => '/followerList']) !!}

    <!-- フォローされている人のアイコン一覧 -->
<table>
    <h1>[ フォロワーリスト ]</h1>
    <tr>
    <td class="follow_icon">
        @foreach ($users as $follower)
        <a href="{{ route('usersProfile', ['id' => $follower->id]) }}">
            <img src="{{ asset('/images/' . $follower->images) }}" alt="フォローアイコン" class="post-contents icon">
        </a>
        @endforeach
    </td>
</tr>
</table>

<hr class=line>


    <tr>
@foreach($posts as $post)
    @if($post->user)
    <a href="{{ route('usersProfile', ['id' => $post->user->id]) }}">
        <img src="{{ asset('/images/'.$post->user->images) }}" alt="{{ $post->user->username }}" class="icon"></a>
    @endif
    <td>名前:{{ $post->user->username }}</td>
    <td>投稿内容:{{ $post->post }}</td>
    <br>
    <hr>
@endforeach
    </tr>

@endsection
