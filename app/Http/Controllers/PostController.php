<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessRegisterRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function postCreateForm()
    {
        return view('posts.create');
    }

    public function register(BusinessRegisterRequest $request) {
        dd($request);
    }
}
