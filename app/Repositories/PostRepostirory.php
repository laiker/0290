<?
namespace App\Repositories;

use App\Models\Post;
use App\Models\Tag;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
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