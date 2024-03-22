@extends('layouts.login')

@section('content')
    <div class="container">
        {!! Form::open(['url' => '/posts']) !!}
        {{Form::token()}}
        <div class="form-group" style="display: flex;">
            <img src="images/icon1.png" alt="{{ auth()->user()->username }}" class="icon">
            {!! Form::input('text', 'content', null, ['required', 'class' => 'form-control', 'style' => 'padding: 0; margin: 0; flex: 3;', 'placeholder' => '投稿内容を入力してください。']) !!}
            <button type="submit" class="btn btn-success"><img src="images/post.png" class="btn btn-post" alt="投稿"></button>
        </div>
        {!! Form::close() !!}

        <!-- 新しい投稿の表示 -->
        @if(session('newPost'))
            <?php $newPost = session('newPost'); ?>
            @if($newPost)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $newPost->username }}</h5>
                        <p class="card-text">{{ $newPost->content }}</p>
                        <p class="card-text">{{ $newPost->created_at }}</p>
                    </div>
                </div>
            @endif
        @endif

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
                    <td>{{ $post->created_at }}</td>
                    <td>
                        <!-- 自分の投稿のみ編集ボタンを表示 -->
                        @if($post->user_id == auth()->id())
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal{{ $post->id }}">
                                編集
                            </button>
                        @endif
                    </td>
                    <td><a href="/posts"><img src="images/edit.png" alt="更新" class="btn btn-primary"></a></td>
                    <td>
                        <a href="/post/{{$post->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか?')">
                            <img src="images/trash.png" alt="削除" class="btn" id="deleteButton{{$post->id}}" onmouseover="changeImageAndStyle('deleteButton{{$post->id}}', 'images/trash-h.png' )" onmouseout="changeImageAndStyle('deleteButton{{$post->id}}', 'images/trash.png')">
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

<script>
    function changeImageAndStyle(elementId, newImageSrc) {
        var element = document.getElementById(elementId);
        element.src = newImageSrc;
        element.classList.remove("btn");
        element.classList.add("btn");
    }
</script>
