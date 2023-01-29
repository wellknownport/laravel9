<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class PostsController extends AdminController
{
    public function form(int $id = 0)
    {
        $post = new \stdClass();

        return view('admin/posts/form', [
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {

    }

    public function delete(int $id)
    {

    }
}
