<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostStoreRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PostsController extends AdminController
{

    public function form(int $id = 0): Application|Factory|View
    {
        $post = new \App\Entities\PostEntity();
        if ($id !== 0) {
            /**
             * @var \App\Services\PostService $service
             */
            $service = app()->make('PostService');
            $post    = $service->findById((int)$id);
        }

        if ($post === null) {
            abort(404);
        }

        return view('admin/posts/form', [
            'post' => $post,
        ]);
    }

    public function store(PostStoreRequest $request)
    {
        /**
         * @var \App\Services\PostService $service
         */
        $service = app()->make('PostService');
        $result  = $service->save($request);
        var_dump($result);
    }

    public function delete(int $id)
    {
        /**
         * @var \App\Services\PostService $service
         */
        $service = app()->make('PostService');
        $result = $service->delete($id);

        $message = '日記を削除しました';
        if ($result === false) {
            $message = '日記を削除できませんでした';
        }

        session()->flash('flash', $message);

        return redirect()->route('admin.home');
    }
}
