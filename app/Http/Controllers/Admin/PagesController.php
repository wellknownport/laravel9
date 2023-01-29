<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class PagesController extends AdminController
{
    public function home()
    {
        /**
         * @var \App\Services\PostService $service
         */
        $service = app()->make('PostService');
        $posts = $service->getPosts();
        return view('admin/home', [
           'posts' => $posts
        ]);
    }
}
