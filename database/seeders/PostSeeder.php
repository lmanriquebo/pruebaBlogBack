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
        $post->image = "https://www.shutterstock.com/image-photo/bloggingblog-concepts-ideas-white-worktable-1029506242";
        $post->authors_id = 1;
        $post->save();

        $post = new Post();
        $post->title = "Luis Carlos";
        $post->content = "asdasdasdasdasdasdasd sadlkajsdkla jlashdlkashdjkasd lhlaslkasjd";
        $post->image = "https://www.shutterstock.com/image-photo/bloggingblog-concepts-ideas-computer-laptop-on-1255851382";
        $post->authors_id = 2;
        $post->save();
    }
}
