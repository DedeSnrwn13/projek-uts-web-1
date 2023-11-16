<?php

namespace App\Http\Controllers\Api;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function getSubCategoryByCategoryId(int $id)
    {
        $sub_categories = SubCategory::select('id', 'name')->where('status', 1)->where('category_id', $id)->get();

        return response()->json($sub_categories);
    }
}
