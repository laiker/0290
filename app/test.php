<?
namespace App;

use App\Models\Post;
use App\Models\Tag;

class test
{
    public function all()
    {
        return Post::all();
    }

    public function getPublished()
    {
        return Post::where('published', true)->get();
    }
}