<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'tag', 'user')->where('is_approved', 1)
            ->where('status', 1)->latest()->take(5)->get();

        return view('frontend.modules.index', compact('posts'));
    }

    public function single()
    {
        return view('frontend.modules.single');
    }
}
