<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class PagesController extends AdminController
{
    public function home()
    {
        $posts = [];
        return view('admin/home', [
           'posts' => $posts
        ]);
    }
}
