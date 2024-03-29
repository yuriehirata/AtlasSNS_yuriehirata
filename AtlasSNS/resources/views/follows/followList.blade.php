@extends('layouts.login')

@section('content')
{{-- followList.blade.php --}}
{!! Form::open(['url' => '/followList']) !!}
<table>
    <h1>[ フォローリスト ]</h1>
    <tr>
    <td class="follow_icon">
        @foreach ($users as $followed)
        <a href="{{ route('usersProfile', ['id' => $followed->id]) }}">
            <img src="{{ asset('/images/' .$followed->images) }}" alt="フォローアイコン" class="post-contents icon">
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


    <td>{{ $post->user->username }}</td>
    <td>{{ $post->post }}</td>
    <br>

    <hr>
@endforeach
    </tr>

@endsection
