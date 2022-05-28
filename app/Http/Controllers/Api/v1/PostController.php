<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct(private PostRepositoryInterface $postRepository){}

    public function getPosts(Request $request): object
    {
        $validation = Validator::make($request->all(), [
            'q' => 'sometimes|required|string|max:100',
            'sort' => 'sometimes|required|string',
            'order' => 'sometimes|required|string|in:asc,desc',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        $posts = $this->postRepository->getPosts(
            q: $request->header('q', ''),
            sort: $request->header('sort', 'id'),
            order: $request->header('order', 'asc')
        );

        return response()->json(['data' => $posts], 200);
    }

    public function getPostTags(int $id, Request $request): object
    {
        $validation = Validator::make($request->all(), [
            'q' => 'sometimes|required|string|max:100',
            'sort' => 'sometimes|required|string',
            'order' => 'sometimes|required|string|in:asc,desc',
        ]);

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 422);
        }

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
        $validation = Validator::make(['id' => $id], [
            'id' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 422);
        }

        $post = $this->postRepository->getPost(
            id: $id
        );

        return response()->json(['data' => $post], 200);
    }
}
