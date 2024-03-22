@extends('layouts.login')

@section('content')
{{-- followList.blade.php --}}

フォローリストページ
{{-- フォローリストの表示 --}}
    <div>
        <h2>フォローしているユーザー</h2>
        @if(!is_null($following) && count($following) > 0)
            <ul>
                @foreach($following as $username)
                    <li>{{ $username>name }}</li>
                @endforeach
            </ul>
        @else
            <p>フォローしているユーザーはいません。</p>
        @endif
    </div>


@endsection
