<?php

namespace App\Repositories\Like;

use App\Like;
use App\Repositories\BaseRepository;

class LikeRepository extends BaseRepository
{
    protected $likeModel;

    public function __construct(Like $likeModel)
    {
        parent::__construct($likeModel);
    }
}
