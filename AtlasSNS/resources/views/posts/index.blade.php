@extends('layouts.login')

@section('content')
    <div class="container">
        <div class=post>
            {!! Form::open(['url' => '/posts']) !!}
            <!-- {{Form::token()}}
            <div class="form-group" style="display: flex;">
                <img src="{{ asset('/images/'.auth()->user()->images) }}" alt="{{ auth()->user()->username }}" class="icon">
                    {!! Form::input('text', 'content', null, ['required', 'class' => 'form-control', 'style' => 'padding: 0; margin: 0; flex: 3;', 'placeholder' => '投稿内容を入力してください.', 'oninput' => 'if(this.value.length > 150) this.value = this.value.slice(0, 150)']) !!}
                <button type="submit" class="btn-success"><img src="images/post.png" class="btn-post" alt="投稿"></button>
            </div>
            {!! Form::close() !!} -->
                {{Form::token()}}
                <div class="form-group" style="display: flex;">
                    <img src="{{ asset('/images/'.auth()->user()->images) }}" alt="{{ auth()->user()->username }}" class="icon">
                    <div id="contentWrapper" contenteditable="true" style="padding: 10; margin: 30; flex: 5; border: 0px solid ; min-height: 80px;"  onkeydown="handleKeyDown(event)" oninput="checkLength()"></div>
                    <button type="submit" class="btn-success" onclick="submitForm()"><img src="images/post.png" class="btn-post" alt="投稿"></button>
                </div>
                {!! Form::close() !!}
            <br>
            <br>
        </div>
        <table class="table table-hover">
            <div class=post>
                <div>
                <tr class=flex>
                    @foreach ($posts as $post)
                    <td class=left>
                        @if($post->user)
                        <img src="{{ asset('/images/'.$post->user->images) }}" alt="{{ auth()->user()->username }}" class="icon">
                    </td>
                        @endif
                    <td class=center>
                        <p class="posts post-user"><?php
                        // 投稿に関連付けられたユーザーオブジェクトを取得
                        $user = \App\User::find($post->user_id);
                        echo $user ? $user->username : '';
                        ?></p>
                        <p class="posts post-contents">{{ $post->post }}</p>
                    </td>
                    <div class=right>
                    <td>
                        <p class="posts-btn post-time">
                        {{ $post->created_at->format('Y-m-d H:i') }}
                        </p>
                        <td class=right_btn>
                            <!-- 自分の投稿のみ編集ボタンを表示 -->
                            @if($post->user_id == auth()->id())
                            <!-- モーダルを開くボタン -->
                            <td class="content">
                            <button class="right_btn" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="images/edit.png" alt="編集" class="posts-btn btn-success"></button>
                        </td>
                        </div>
                        <div class=right_btn>
                        <td>
                            <!-- つぶやき削除ボタン -->
                            <a href="/post/{{$post->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか?')">
                            <img src="images/trash.png" alt="削除" class="btn trash-btn" id="deleteButton{{$post->id}}" onmouseover="changeImageAndStyle('deleteButton{{$post->id}}', 'images/trash-h.png')" onmouseout="changeImageAndStyle('deleteButton{{$post->id}}', 'images/trash.png')">
                            </a>
                        </td>
                        </div>
                        @endif
                        @endforeach
                    </td>
                </tr>
                </div>
            </div>
        </table>

                    <!-- モーダル -->
        <div class="modal js-modal">
            <div class="modal__bg js-modal-close"></div>
                <div class="modal__content">
                    <form action="/post/update" method="POST">
                        @csrf
                        <textarea name="content" class="modal_post" maxlength="150"></textarea>
                        <input type="hidden" class="modal_id" name="post_id" value="">
                        <button type="submit" class="modal_success"><img src="images/edit.png" alt="編集" class="modal_success"></button>
                    </form>
                </div>
            </div>
        </div>
@endsection
