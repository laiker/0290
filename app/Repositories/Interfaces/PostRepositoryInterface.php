<?
namespace App\Repositories\Interfaces;

use App\Models\Post;

interface PostRepositoryInterface
{
    public function all();
    public function getByUser();
}