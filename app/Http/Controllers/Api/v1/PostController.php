<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\ParamsRequest;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function __construct(private PostRepositoryInterface $postRepository){}

    /**
     * API V1 /posts - return all posts
     *
     * @param ParamsRequest $request
     * @return object
     */
    public function getPosts(ParamsRequest $request): object
    {
        $posts = $this->postRepository->getPosts(
            q: $request->header('q', ''),
            sort: $request->header('sort', 'id'),
            order: $request->header('order', 'asc')
        );

        return response()->json($posts);
    }

    /**
     * API V1 /posts/{id} - return post by id
     *
     * @param int $id
     * @param ParamsRequest $request
     * @return JsonResponse
     */
    public function getPostTags(int $id, ParamsRequest $request): JsonResponse
    {
        $postTags = $this->postRepository->getPostTags(
            id: $id,
            q: $request->header('q', ''),
            sort: $request->header('sort', 'id'),
            order: $request->header('order', 'asc')
        );

        return response()->json(['data' => $postTags]);
    }

    /**
     * API V1 /posts/{id}/tags - return post tags
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getPost(int $id): JsonResponse
    {
        $post = $this->postRepository->getPost(
            id: $id
        );

        return response()->json(['data' => $post]);
    }
}
