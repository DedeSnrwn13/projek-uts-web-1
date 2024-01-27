<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\PhotoUploadController;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query =  Post::with('category', 'sub_category', 'user', 'tag')->latest();

        if (Auth::user()->role === User::USER) {
            $posts = $query->where('user_id', Auth::id())->paginate(20);
        }

        $posts = $query->paginate(20);

        return view('backend.modules.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->pluck('name', 'id');
        $tags = Tag::where('status', 1)->select('name','id')->get();
        $selected_tags = [];

        return view('backend.modules.post.create', compact('categories', 'tags', 'selected_tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        $post_data = $request->except(['tag_ids', 'photo', 'slug']);
        $post_data['slug'] = Str::slug($request->input('slug'));
        $post_data['user_id'] = Auth::user()->id;
        $post_data['is_approved'] = 1;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $height = 400;
            $width = 1000;
            $thumb_height = 150;
            $thumb_width = 300;
            $path = 'images/post/original/';
            $thumb_path = 'images/post/thumbnail/';

            $image_name = (new PhotoUploadController())->imageUpload($name, $height, $width, $path, $file);
            $post_data['photo'] = url('images/post/original/' . $image_name);
            (new PhotoUploadController())->imageUpload($name, $thumb_height, $thumb_width, $thumb_path, $file);
        }

        $post = Post::create($post_data);
        $post->tag()->attach($request->input('tag_ids'));

        session()->flash('cls', 'success');
        session()->flash('msg', 'Post Created Successfully');
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if (Auth::user()->role == User::USER && $post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->load(['category', 'sub_category', 'user', 'tag']);

        return view('backend.modules.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::where('status', 1)->pluck('name', 'id');
        $tags = Tag::where('status', 1)->select('name','id')->get();
        $selected_tags = DB::table('post_tag')->where('post_id', $post->id)->pluck('tag_id')->toArray();

        return view('backend.modules.post.edit', compact('post', 'categories', 'tags', 'selected_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $post_data = $request->except(['tag_ids', 'photo', 'slug']);
        $post_data['slug'] = Str::slug($request->input('slug'));
        $post_data['user_id'] = Auth::user()->id;
        $post_data['is_approved'] = 1;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $height = 400;
            $width = 1000;
            $thumb_height = 150;
            $thumb_width = 300;
            $path = 'images/post/original/';
            $thumb_path = 'images/post/thumbnail/';

            (new PhotoUploadController())->imageUnlink($path, $post->photo);
            (new PhotoUploadController())->imageUnlink($thumb_path, $post->photo);
            $post_data['photo'] = (new PhotoUploadController())->imageUpload($name, $height, $width, $path, $file);
            (new PhotoUploadController())->imageUpload($name, $thumb_height, $thumb_width, $thumb_path, $file);
        }

        $post->update($post_data);
        $post->tag()->sync($request->input('tag_ids'));

        session()->flash('cls', 'success');
        session()->flash('msg', 'Post Updated Successfully');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $path = 'images/post/original/';
        $thumb_path = 'images/post/thumbnail/';
        (new PhotoUploadController())->imageUnlink($path, $post->photo);
        (new PhotoUploadController())->imageUnlink($thumb_path, $post->photo);

        $post->delete();

        session()->flash('cls', 'warning');
        session()->flash('msg', 'Post Deleted Successfully');
        return redirect()->route('post.index');
    }
}
