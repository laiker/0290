<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;

class TagsToPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all the roles attaching up to 3 random roles to each user
        $tags = Tag::all();

        // Populate the pivot table
        Post::all()->each(function ($post) use ($tags) { 
            $post->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });
    }
}
