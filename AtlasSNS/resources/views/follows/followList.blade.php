@extends('layouts.login')

@section('content')
{{-- followList.blade.php --}}

@foreach ($followList as $follow)
    <!-- フォローリストの表示 -->
@endforeach

@endsection
