<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke() {
        $posts = Post::with('like', 'user')->get();
        return view('index', compact('posts'));
    }
}
