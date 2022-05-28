<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;

class TagsToPostSeeder extends Seeder
{
    public array $tagColors = ['red', 'yellow', 'green', 'purple', 'black', 'white'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all();
        Post::all()->each(function ($post) use ($tags) {
            for ($i = 0; $i < rand(4, 6); $i++) {
                $post->tags()->attach(
                    $tags->random(),
                    ['tag_color' => collect($this->tagColors)->random()]
                );
            }

        });
    }
}
