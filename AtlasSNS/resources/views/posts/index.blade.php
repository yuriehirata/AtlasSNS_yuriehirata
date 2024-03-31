@extends('layouts.login')

@section('content')
    <div class="container">
        {!! Form::open(['url' => '/posts']) !!}
            {{Form::token()}}
            <div class="form-group" style="display: flex;">
                <img src="{{ asset('/images/'.auth()->user()->images) }}" alt="{{ auth()->user()->username }}" class="icon">
                {!! Form::input('text', 'content', null, ['required', 'class' => 'form-control', 'style' => 'padding: 0; margin: 0; flex: 3;', 'placeholder' => '投稿内容を入力してください。']) !!}
                <button type="submit" class="btn-success"><img src="images/post.png" class="btn-post" alt="投稿"></button>
            </div>
            {!! Form::close() !!}

            <table class="table table-hover">
                @foreach ($posts as $post)
                    <tr>
                        <td>
                            @if($post->user)
                                <img src="{{ asset('/images/'.$post->user->images) }}" alt="{{ auth()->user()->username }}" class="icon">
                            @endif
                        </td>
                        <td class="post-user">{{ isset($users[$post->id]) ? $users[$post->id] : '' }}</td>
                        <td class="post-contents">{{ $post->post }}</td>
                        <td class="posts-btn post-time">{{ $post->created_at->format('Y-m-d H:i') }}</td>

                        <!-- 自分の投稿のみ編集ボタンを表示 -->
                        @if($post->user_id == auth()->id())
                            <td>
                                <!-- モーダルを開くボタン -->
                                <div class="content">
                                    <button class="js-modal-open" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="images/edit.png" alt="編集" class="posts-btn btn-success"></button>
                                </div>
                            </td>
                            <td>
                                <!-- つぶやき削除ボタン -->
                                <a href="/post/{{$post->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか?')"><img src="images/trash.png" alt="削除" class="btn trash-btn" id="deleteButton{{$post->id}}" onmouseover="changeImageAndStyle('deleteButton{{$post->id}}', 'images/trash-h.png')" onmouseout="changeImageAndStyle('deleteButton{{$post->id}}', 'images/trash.png')">
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>

                <!-- モーダル -->
                <div class="modal js-modal">
                    <div class="modal__bg js-modal-close">
                    </div>
                        <div class="modal__content">
                            <form action="/post/update" method="POST">
                                @csrf
                                <textarea name="content" class="modal_post"></textarea>
                                <input type="hidden" class="modal_id" name="post_id" value="">
                                <button type="submit" class="btn"><img src="images/edit.png" alt="編集" class="posts-btn btn-success"></button>
                            </form>
                        </div>
                </div>

    </div>
@endsection
