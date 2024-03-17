@extends('layouts.login')

@section('content')
{{-- followerList.blade.php --}}

<p>フォロワー数: {{ $followerCount }}</p>
@foreach ($followerList as $follower)
    <!-- フォロワーリストの表示 -->
@endforeach

@endsection
