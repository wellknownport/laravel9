@extends('layouts/public')

@section('content')
    <div class="container">
        <div class="posts">
            @foreach ($posts as $post)
                <div class="post">
                    <div class="image">
                        @if($post->asset_id)
                            <img src="/assets/{{ $post->asset_id }}" alt=""/>
                        @endif
                    </div>
                    <div class="text">
                        <dl>
                            <dt class="datetime">{{ $post->release_at }}</dt>
                            <dd class="main-text">{{ $post->content }}</dd>
                        </dl>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{ $posts->links() }}
@endsection
