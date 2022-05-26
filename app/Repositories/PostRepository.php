<?
namespace App\Repositories;

use App\Models\Post;
use App\Models\Tag;

class PostRepository implements Interfaces\PostRepositoryInterface
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