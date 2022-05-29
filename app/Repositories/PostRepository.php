<?php
namespace App\Repositories;

use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Tag\TagCollection;
use App\Models\Post;

class PostRepository implements Interfaces\PostRepositoryInterface
{
    private array $searchPostsFields = ['title', 'code', 'detail_text'];
    private array $searchTagsFields = ['name', 'code', 'tag_color'];


    /**
     * Get all posts with paginate
     *
     * @param string|null $q
     * @param string $sort
     * @param string $order
     * @return PostCollection
     */
    public function getPosts(string|null $q = '', string $sort = 'id', string $order = 'asc'): PostCollection
    {
        $postsQuery = Post::with('tags');

        if ($q) {
            $searchColumns = $this->searchPostsFields;
            $postsQuery->where(function($query) use($searchColumns, $q) {
                foreach ($searchColumns as $field) {
                    $query->orWhere($field, 'like', "%{$q}%")->get();
                }
            });
        }

        $postsQuery->orderBy($sort, $order);

        return new PostCollection($postsQuery->paginate());
    }

    /**
     * Get post by ID
     *
     * @param int $id
     * @return PostResource
     */
    public function getPost(int $id): PostResource
    {
        $postQuery = Post::findOrFail($id);
        return new PostResource($postQuery);
    }

    /**
     * Get post tags bt post Id
     *
     * @param int $id
     * @param string|null $q
     * @param string $sort
     * @param string $order
     * @return TagCollection
     */
    public function getPostTags(int $id, ?string $q = '', string $sort = 'id', string $order = 'asc'): TagCollection
    {
        $tagsQuery = Post::findOrFail($id)->tags();

        if ($q) {
            $searchColumns = $this->searchTagsFields;
            $tagsQuery->where(function($query) use($searchColumns, $q) {
                foreach ($searchColumns as $field) {
                    $query->orWhere($field, 'like', "%{$q}%");
                }
            });
        }

        $tagsQuery->orderBy($sort, $order);

        return new TagCollection($tagsQuery->get());
    }
}
