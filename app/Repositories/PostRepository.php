<?php
namespace App\Repositories;

use App\Models\Post;

class PostRepository implements Interfaces\PostRepositoryInterface
{
    private array $searchPostsFields = ['title', 'code', 'detail_text'];
    private array $searchTagsFields = ['name', 'code', 'tag_color'];
    private int $perPage = 5;

    public function getPosts(string|null $q = '', string $sort = 'id', string $order = 'asc'): object
    {
        $postsQuery = Post::query();

        if ($q) {
            $searchColumns = $this->searchPostsFields;
            $postsQuery->where(function($query) use($searchColumns, $q) {
                foreach ($searchColumns as $field) {
                    $query->orWhere($field, 'like', "%{$q}%")->get();
                }
            });
        }

        $postsQuery->orderBy($sort, $order)->cursorPaginate($this->perPage);

        return $postsQuery->get();
    }

    public function getPost(int $id): object
    {
        $postQuery = Post::query()->where('id', $id);
        return $postQuery->get();;
    }

    public function getPostTags(int $id, string|null $q = '', string $sort = 'id', string $order = 'asc'): object
    {
        $tagsQuery = Post::find($id)->tags();

        if ($q) {
            $searchColumns = $this->searchTagsFields;
            $tagsQuery->where(function($query) use($searchColumns, $q) {
                foreach ($searchColumns as $field) {
                    $query->orWhere($field, 'like', "%{$q}%");
                }
            });
        }

        $tagsQuery->orderBy($sort, $order)->simplePaginate($this->perPage);

        return $tagsQuery->get();
    }
}
