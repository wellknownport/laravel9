<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssetsController extends Controller
{
    public function output(int $id)
    {
        /**
         * @var \App\Services\AssetService $service
         */
        $service = app()->make('AssetService');
        $asset = $service->findById($id);
        if ($asset === null) {
            abort(404);
        }

        $content_type = \App\Define\AssetType::findBy($asset->type, 'content_type');
        return response($asset->content)
            ->header('Content-Type', $content_type);
    }
}
