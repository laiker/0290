<?php
namespace App\Repositories\Interfaces;

use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Tag\TagCollection;

interface PostRepositoryInterface
{
    public function getPosts(string $q, string $sort, string $order): PostCollection;
    public function getPost(int $id): PostResource;
    public function getPostTags(int $id, string $q, string $sort, string $order): TagCollection;
}
