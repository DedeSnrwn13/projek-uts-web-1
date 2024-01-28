<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === User::USER) {
            $posts = Post::where('user_id', Auth::id())->count();
        } else {
            $posts = Post::count();
        }

        $categories = Category::count();
        $sub_categories = SubCategory::count();
        $tags = Tag::count();

        return view('backend.index', compact('posts', 'categories', 'sub_categories', 'tags'));
    }
}
