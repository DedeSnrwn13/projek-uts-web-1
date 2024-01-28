<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryListResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('order_by')->get();

        return view('backend.modules.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.modules.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:categories,slug',
            'order_by' => 'required|numeric',
            'status' => 'required'
        ]);

        $categoty_data = $request->all();
        $categoty_data['slug'] = Str::slug($request->input('slug'));

        Category::create($categoty_data);

        session()->flash('cls', 'success');
        session()->flash('msg', 'Category Created Successfully');

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('backend.modules.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.modules.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name'=> 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:categories,slug,' . $category->id,
            'order_by' => 'required|numeric',
            'status' => 'required'
        ]);

        $categoty_data = $request->all();
        $categoty_data['slug'] = Str::slug($request->input('slug'));

        $category->update($categoty_data);

        session()->flash('cls', 'success');
        session()->flash('msg', 'Category Updated Successfully');

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        session()->flash('cls', 'danger');
        session()->flash('msg', 'Category Deleted Successfully');

        return redirect()->route('category.index');
    }

    public function categoryList()
    {
        $categories = Category::latest()->get();

        return CategoryListResource::collection($categories);
    }

    public function categoryDetails(int $id)
    {
        $category = Category::findOrFail($id);

        return new CategoryListResource($category);
    }

    public function categoryStore(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:categories,slug',
            'order_by' => 'required|numeric',
            'status' => 'required'
        ]);

        Category::create($request->all());

        return response()->json(['msg' => 'Category Created Succesfully']);
    }

    public function categoryUpdate(int $id, Request $request)
    {
        $category = Category::findOrFail($id);

        $this->validate($request, [
            'name'=> 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:categories,slug,' . $category->id,
            'order_by' => 'required|numeric',
            'status' => 'required'
        ]);

        $category->update($request->all());

        return response()->json(['msg' => 'Category Updated Successfully']);
    }

    public function categoryDelete(int $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['msg' => 'Category Deleted Successfully']);
    }
}
