<?php
/**
 * @var \App\Entities\PostEntity $post
 */

?>
@extends('layouts/admin')

@section('content')
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" enctype="multipart/form-data" action="{{ route('admin.posts.store') }}">
        @csrf
        <input type="hidden" name="id" value="{{ old('id', $post->id) }}">
        <div>
            <label for="company">写真</label>
            <input id="photo" type="file" name="photo" value="{{ old('photo') }}">
            @if($errors->has('photo'))
                <p>{{ $errors->first('company') }}</p>
            @endif
        </div>

        <div>
            <label for="company">日にち</label>
            <input id="release_at" type="datetime-local" name="release_at" value="{{ old('release_at', $post->release_at) }}">
            @if($errors->has('release_at'))
                <p>{{ $errors->first('release_at') }}</p>
            @endif
        </div>

        <div>
            <label for="content">内容</label>
            <textarea id="content" name="content">{{ old('content', $post->content) }}</textarea>
            @if($errors->has('content'))
                <p>{{ $errors->first('company') }}</p>
            @endif
        </div>

        <input type="submit" value="更新">
    </form>
@endsection
