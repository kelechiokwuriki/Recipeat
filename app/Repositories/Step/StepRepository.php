<?php

namespace App\Repositories\Step;

use App\Repositories\BaseRepository;
use App\Step;

class StepRepository extends BaseRepository
{
    protected $stepModel;

    public function __construct(Step $stepModel)
    {
        parent::__construct($stepModel);
    }
}
