@extends('layouts.login')

@section('content')
    <div class="container">
        {!! Form::open(['url' => '/top']) !!}
    {{Form::token()}}
    <div class="form-group" style="display: flex;">
        {!! Form::input('text', 'userName', null, ['required', 'class' => 'form-control', 'style' => 'padding: 0; margin: 0; flex: 1;', 'placeholder' => '投稿内容を入力してください。']) !!}
        <button type="submit" class="btn btn-success"><img src="images/post.png" class="btn btn-post" alt= "投稿" ></button>
    </div>
{!! Form::close() !!}


        <table class="table table-hover">
            <tr>
                <th>ユーザーネーム</th>
                <th>投稿内容</th>
                <th>投稿時間</th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->username }}</td>
                <td>{{ $post->post }}</td>
                <td></td></td>
                <td><a href="/posts"><img src="images/edit.png" alt="更新" class="btn btn-primary"></a></td>

                <td><a href="/post/{{$post->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')"><img src="images/trash.png" alt="削除" class="btn btn-danger"></a></td>

            </tr>
            @endforeach

</table>
    </div>
@endsection
