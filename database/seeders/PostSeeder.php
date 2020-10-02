<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post();
        $post->title = "Prueba 1";
        $post->content = "asdasdasdasdasdasdasd sadlkajsdkla jlashdlkashdjkasd lhlaslkasjd";
        $post->image = "";
        $post->author_id = 1;
        $post->save();

        $post = new Post();
        $post->title = "Luis Carlos";
        $post->content = "asdasdasdasdasdasdasd sadlkajsdkla jlashdlkashdjkasd lhlaslkasjd";
        $post->image = "";
        $post->author_id = 2;
        $post->save();
    }
}
