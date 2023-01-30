<?php
/**
 * @var \App\Entities\PostEntity $post
 * @var \App\Entities\FormParamsEntity $form_params
 */
?>
@extends('layouts/admin')

@section('content')
    <div class="container">
        <div class="app-form">
            <div class="header">
                <h1>{{ $form_params->title }}</h1>
            </div>

            @if($errors->any())
                <div class="error-messages">
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

                <div class="row">
                    <label for="company">日にち</label>
                    <input id="release_at" class="ctrl inline" type="datetime-local" name="release_at" value="{{ old('release_at', $post->release_at) }}">
                </div>

                <div class="row">
                    <label for="company">写真</label>
                    <script>
                        const data = {
                            asset_id: {{ $post->getAssetId() }}
                        }
                    </script>
                    <div id="js-upload-file"></div>
                    <!--<input id="photo" type="file" name="photo" value="{{ old('photo') }}">-->
                </div>

                <div class="row">
                    <label for="content">内容</label>
                    <textarea id="content" class="ctrl" rows="16" name="content">{{ old('content', $post->content) }}</textarea>
                </div>

                <div class="actions">
                    <input type="submit" class="btn submit" value="{{ $form_params->btn_submit_title }}">
                </div>
            </form>
        </div>
    </div>
@endsection
