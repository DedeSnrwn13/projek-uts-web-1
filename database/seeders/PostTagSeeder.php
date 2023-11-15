<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 6; $i <= 108; $i++) {
            if ($i == 8) {
                continue;
            }
            $data['post_id'] = $i;
            $data['tag_id'] = random_int(1,10);
            DB::table('post_tag')->insert($data);
        }
    }
}
