<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\ParamsRequest;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostController extends Controller
{
    public function __construct(private PostRepositoryInterface $postRepository){}

    public function getPosts(ParamsRequest $request): object
    {
        $posts = $this->postRepository->getPosts(
            q: $request->header('q', ''),
            sort: $request->header('sort', 'id'),
            order: $request->header('order', 'asc')
        );

        return response()->json($posts, 200);
    }

    public function getPostTags(int $id, ParamsRequest $request): object
    {
        $postTags = $this->postRepository->getPostTags(
            id: $id,
            q: $request->header('q', ''),
            sort: $request->header('sort', 'id'),
            order: $request->header('order', 'asc')
        );

        return response()->json(['data' => $postTags], 200);
    }

    public function getPost(int $id): object
    {
        $post = $this->postRepository->getPost(
            id: $id
        );

        return response()->json(['data' => $post], 200);
    }
}
