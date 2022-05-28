<?php
namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
    public function getPosts(string $q, string $sort, string $order): object;
    public function getPost(int $id): object;
    public function getPostTags(int $id, string $q, string $sort, string $order): object;
}
