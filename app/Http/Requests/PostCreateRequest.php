<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:posts,slug',
            'status' => 'required',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id|numeric',
            'description' => 'required|min:20',
            'photo' => 'required',
            'tag_ids' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'sub_category_id.numeric' => 'Please selet sub category'
        ];
    }
}
