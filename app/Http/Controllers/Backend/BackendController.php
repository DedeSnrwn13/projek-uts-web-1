<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function index()
    {
        $posts = Post::count();
        $categories = Category::count();
        $sub_categories = SubCategory::count();
        $tags = Tag::count();

        return view('backend.index', compact('posts', 'categories', 'sub_categories', 'tags'));
    }
}
