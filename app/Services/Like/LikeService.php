<?php

namespace App\Services\Like;

use App\Repositories\Like\LikeRepository;

class LikeService
{
    protected $likeRepository;

    public function __construct(LikeRepository $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function likeRecipe(array $like)
    {
        return $this->likeRepository->create($like);
    }
}
