<?php

namespace App\Http\Controllers;

use App\Models\PostCount;
use Illuminate\Http\Request;

class PostCountController extends Controller
{
    private int $post_id;

    public function __construct(int $post_id)
    {
        $this->post_id = $post_id;
    }

    public function postReadCount()
    {
        $post_count = PostCount::where('post_id', $this->post_id)->first();

        if ($post_count) {
            $read_count_data['count'] = $post_count->count + 1;
            $post_count->update($read_count_data);
        } else {
            $this->storePostCount();
        }
    }

    private function storePostCount()
    {
        $read_count_data['post_id'] = $this->post_id;
        $read_count_data['count'] = 1;

        PostCount::create($read_count_data);
    }
}
