@extends('layouts.login')

@section('content')
{!! Form::open(['url' => url('users/' . $user->id . '/profile')]) !!}
    <p>ユーザープロフィール</p>
</form>
@endsection
