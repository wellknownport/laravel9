<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssetsController extends Controller
{
    public function output(int $id)
    {
        return response(file_get_contents('https://placehold.jp/150x150.png'))
            ->header('Content-Type', 'image/jpeg');
    }
}
