@extends('layouts.login')

@section('content')
    <div class="container row">
        {!! Form::open(['url' => '/posts']) !!}
            {{Form::token()}}
            <div class="form_group" style="display: flex;">
                <img src="{{ asset('/images/'.auth()->user()->images) }}" alt="{{ auth()->user()->username }}" class="icon">
                {!! Form::input('text', 'content', null, ['required', 'class' => 'form-control', 'style' => 'padding: 0; margin: 0; flex: 3;', 'placeholder' => '投稿内容を入力してください。']) !!}
                <button type="submit" class="btn-success"><img src="images/post.png" class="btn-post" alt="投稿"></button>
            </div>
            {!! Form::close() !!}

            <div>
                @foreach ($posts as $post)
                    <div class="post">
                        <div class="left">
                            @if($post->user)
                            <img src="{{ asset('/images/'.$post->user->images) }}" alt="{{ auth()->user()->username }}" class="icon">
                            @endif
                        </div>
                        <div class="center">
                            <div class="post-user">{{ isset($users[$post->id]) ? $users[$post->id] : '' }}</div>
                            <div class="post-contents">{{ $post->post }}
                            </div>
                        </div>
                        <div class="post-time right">{{ $post->created_at->format('Y-m-d H:i') }}
                            <!-- 自分の投稿のみ編集ボタンを表示 -->
                            @if($post->user_id == auth()->id())
                            <div class="right_btn">
                                <div class="right_btn">
                                    <!-- モーダルを開くボタン -->
                                    <div class="right-btn">
                                        <button class="js-modal-open" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="images/edit.png" alt="編集" class="btn-success"></button>
                                    </div>
                                </div>
                                <div class="right_btn">
                                    <!-- つぶやき削除ボタン -->
                                    <a href="/post/{{$post->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか?')"><img src="images/trash.png" alt="削除" class="btn trash-btn" id="deleteButton{{$post->id}}" onmouseover="changeImageAndStyle('deleteButton{{$post->id}}', 'images/trash-h.png')" onmouseout="changeImageAndStyle('deleteButton{{$post->id}}', 'images/trash.png')">
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

                <!-- モーダル -->
                <div class="modal js-modal">
                    <div class="modal__bg js-modal-close">
                    </div>
                        <div class="modal__content">
                            <form action="/post/update" method="POST">
                                @csrf
                                <textarea name="content" class="modal_post"></textarea>
                                <input type="hidden" class="modal_id" name="post_id" value="">
                                <button type="submit" class="btn"><img src="images/edit.png" alt="編集" class="btn-success"></button>
                            </form>
                        </div>
                </div>

    </div>
@endsection
