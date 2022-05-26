<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostController extends Controller
{
    public function __construct(private PostRepositoryInterface $postRepository){}

    public function getAllPosts()
    {
        $posts = $this->postRepository->all();
        return response()->json($posts);
    }

    public function detail($id)
    {
        $user = User::find($id);
        $blogs = $this->blogRepository->getByUser($user);
        return view('blog')->withBlogs($blogs);
    }
}
