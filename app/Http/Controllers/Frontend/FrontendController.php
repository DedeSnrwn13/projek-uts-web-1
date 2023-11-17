<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $query = Post::with('category', 'sub_category', 'tag', 'user', 'comment')->where('is_approved', 1)
            ->where('status', 1);
        $posts = $query->latest()->take(5)->get();
        $slider_posts = $query->inRandomOrder()->take(6)->get();

        return view('frontend.modules.index', compact('posts', 'slider_posts'));
    }

    public function single(string $slug)
    {
        $post = Post::with('category', 'sub_category', 'tag', 'user', 'comment', 'comment.user')->where('is_approved', 1)
            ->where('status', 1)->where('slug', $slug)->firstOrFail();

        return view('frontend.modules.single', compact('post'));
    }

    public function all_post()
    {
        $posts = Post::with('category', 'sub_category', 'tag', 'user')->where('is_approved', 1)
            ->where('status', 1)->latest()->paginate(10);
        $title = 'All Post';
        $sub_title = 'View post list';

        return view('frontend.modules.all_post', compact('posts', 'title', 'sub_title'));
    }

    public function search(Request $request)
    {
        $posts = Post::with('category', 'sub_category', 'tag', 'user')->where('is_approved', 1)
            ->where('status', 1)->where('title', 'like', '%'. $request->input('search') .'%')->latest()->paginate(10);
        $title = 'View Search Result';
        $sub_title = $request->input('search');

        return view('frontend.modules.all_post', compact('posts', 'title', 'sub_title'));
    }

    public function category(string $slug)
    {
        $category = Category::where('slug', $slug)->first();

        if ($category) {
            $posts = Post::with('category', 'sub_category', 'tag', 'user')->where('is_approved', 1)
                ->where('status', 1)->where('category_id', $category->id)->latest()->paginate(10);
        }

        $title = $category->name;
        $sub_title = 'Post By Category';

        return view('frontend.modules.all_post', compact('posts', 'title', 'sub_title'));
    }

    public function sub_category(string $slug, string $sub_clug)
    {
        $sub_category = SubCategory::where('slug', $sub_clug)->first();

        if ($sub_category) {
            $posts = Post::with('sub_category', 'sub_category', 'tag', 'user')->where('is_approved', 1)
                ->where('status', 1)->where('sub_category_id', $sub_category->id)->latest()->paginate(10);
        }

        $title = $sub_category->name;
        $sub_title = 'Post By Sub Category';

        return view('frontend.modules.all_post', compact('posts', 'title', 'sub_title'));
    }

    public function tag(string $slug)
    {
        $tag = Tag::where('slug', $slug)->first();

        $post_ids = DB::table('post_tag')->where('tag_id', $tag->id)->distinct('post_id')->pluck('post_id');

        if ($tag) {
            $posts = Post::with('category', 'sub_category', 'tag', 'user')
                ->where('is_approved', 1)->where('status', 1)->whereIn('id', $post_ids)
                ->latest()->paginate(10);
        }

        $title = $tag->name;
        $sub_title = 'Post By Tag';

        return view('frontend.modules.all_post', compact('posts', 'title', 'sub_title'));
    }
}
