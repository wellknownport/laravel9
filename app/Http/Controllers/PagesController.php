<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        /**
         * @var \App\Services\PostService $service
         */
        $service = app()->make('PostService');
        $posts = $service->getPosts();

        return view('home', [
            'posts' => $posts
        ]);
    }
}
