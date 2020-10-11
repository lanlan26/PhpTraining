<?php
namespace App\Repositories\Post;

interface PostRepositoryInterface
{
    public function updatePost($id, array $attributes);
}
