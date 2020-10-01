<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Author();
        $post->first_name = "Luis Carlos";
        $post->last_name = "Manrique Boada";
        $post->save();

        $post = new Author();
        $post->first_name = "Jorge Ivan";
        $post->last_name = "Manrique Boada";
        $post->save();
    }
}
