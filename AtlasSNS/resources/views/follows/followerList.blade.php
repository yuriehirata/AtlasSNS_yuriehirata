@extends('layouts.login')

@section('content')
    {{-- followerList.blade.php --}}

    <!-- フォローされている人のアイコン一覧 -->
<div class="">
    <h1>[ フォロワーリスト ]</h1>
    <div class="follow_icon">
        @foreach ($users as $follower)
        <a href="{{ route('profile.show', ['user' => $follower->id]) }}">
            <img src="{{ asset('/images/' . $follower->images) }}" alt="フォローアイコン">
        </a>
        @endforeach
    </div>
</div>




@endsection
