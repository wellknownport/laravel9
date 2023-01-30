@extends('layouts/admin')


@section('content')
    <div class="container">

        <div class="toolbar">
            <div class="actions">
                <a href="{{ route('admin.posts.create') }}" class="action">新規作成</a>
            </div>
        </div>

        <div class="posts">
            @foreach ($posts as $post)
                <div class="post">
                    <div class="image">
                        @if($post->asset_id)
                            <img src="/assets/{{ $post->asset_id }}" alt=""/>
                        @endif
                    </div>
                    <div class="text">
                        {{ $post->content }}
                        <div class="actions">
                            <a href="{{ route('admin.posts.update', $post->id) }}" class="btn update">編集</a>
                            <a href="{{ route('admin.posts.delete', $post->id) }}" class="btn danger">削除</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{ $posts->links() }}
@endsection
