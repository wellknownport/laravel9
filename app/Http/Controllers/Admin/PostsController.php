<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostStoreRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostsController extends AdminController
{

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function form(int $id = 0): Application|Factory|View
    {
        $form_params = new \App\Entities\FormParamsEntity([
            'title'            => '日記 新規作成',
            'btn_submit_title' => '新規作成',
        ]);
        $post        = new \App\Entities\PostEntity();
        if ($id !== 0) {
            /**
             * @var \App\Services\PostService $service
             */
            $service                       = app()->make('PostService');
            $post                          = $service->findById((int)$id);
            $form_params->title            = '日誌更新';
            $form_params->btn_submit_title = '更新';
        }

        if ($post === null) {
            abort(404);
        }

        return view('admin/posts/form', [
            'post'        => $post,
            'form_params' => $form_params,
        ]);
    }

    /**
     * @param \App\Http\Requests\PostStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function store(PostStoreRequest $request): RedirectResponse
    {
        /**
         * @var \App\Services\PostService $service
         */
        $service = app()->make('PostService');
        $result  = $service->save($request);

        $message = '日記を作成しました';
        if ($result === false) {
            $message = '日記を作成できませんでした';
        }
        session()->flash('flash', $message);
        return redirect()->route('admin.home');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function delete(int $id): RedirectResponse
    {
        /**
         * @var \App\Services\PostService $service
         */
        $service = app()->make('PostService');
        $result  = $service->delete($id);

        $message = '日記を削除しました';
        if ($result === false) {
            $message = '日記を削除できませんでした';
        }

        session()->flash('flash', $message);

        return redirect()->route('admin.home');
    }
}
