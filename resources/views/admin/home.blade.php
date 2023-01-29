@extends('layouts/admin')


@section('content')
    <div class="container">
        <a href="{{ route('admin.posts.create') }}">新規作成</a>
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
                    </div>
                    <div class="actions">
                        <a href="{{ route('admin.posts.update', $post->id) }}">編集</a>
                        <a href="{{ route('admin.posts.delete', $post->id) }}">削除</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{ $posts->links() }}
@endsection
