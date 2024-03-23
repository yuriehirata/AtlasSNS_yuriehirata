@extends('layouts.login')

@section('content')
    <div class="container">
        {!! Form::open(['url' => '/posts']) !!}
        {{Form::token()}}
        <div class="form-group" style="display: flex;">
            <img src="" alt="{{ auth()->user()->username }}" class="icon">
            {!! Form::input('text', 'content', null, ['required', 'class' => 'form-control', 'style' => 'padding: 0; margin: 0; flex: 3;', 'placeholder' => '投稿内容を入力してください。']) !!}
            <button type="submit" class="btn btn-success"><img src="images/post.png" class="btn btn-post" alt="投稿"></button>
        </div>
        {!! Form::close() !!}

        <!-- 新しい投稿の表示 -->
        @if(session('newPost'))
            <?php $newPost = session('newPost'); ?>
            @if($newPost)
            　@foreach($newPost->sortByDesc('created_at') as $post)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $newPost->username }}</h5>
                        <p class="card-text">{{ $newPost->content }}</p>
                        <p class="card-text">{{ $newPost->created_at }}</p>
                    </div>
                </div>
            　@endforeach
            @endif
        @endif

        <table class="table table-hover">

                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->username }}</td>
                    <td>{{ $post->post }}</td>
                    <td>{{ $post->created_at }}</td>

                    <!-- 自分の投稿のみ編集ボタンを表示 -->
                    @if($post->user_id == auth()->id())
                    <td>
                        <!-- モーダルを開くボタン -->
                        <div class="content">
                            <button class="js-modal-open" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="images/edit.png" alt="編集" class="btn"></button>
                        </div>

                    </td>
                    <td>
                        <!-- つぶやき削除ボタン -->
                        <a href="/post/{{$post->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか?')">
                            <img src="images/trash.png" alt="削除" class="btn" id="deleteButton{{$post->id}}" onmouseover="changeImageAndStyle('deleteButton{{$post->id}}', 'images/trash-h.png' )" onmouseout="changeImageAndStyle('deleteButton{{$post->id}}', 'images/trash.png')">
                        </a>
                    </td>

                    @endif
                </tr>
                @endforeach
        </table>
            <!-- モーダル -->
            <div class="modal js-modal">
                <div class="modal__bg js-modal-close"></div>
                <div class="modal__content">
                    <form action="/posts/update" method="POST">
                            <textarea name="message" class="modal_post"></textarea>
                            <input type="hidden" name="post_id" class="modal_id">
                            {{ csrf_field() }}
                    </form>
                    <button class="js-modal-close" onclick="updatePost({{ $post->id }})"><img src="images/edit.png" alt="更新" class="btn">
                </div>
            </div>
    </div>
@endsection
