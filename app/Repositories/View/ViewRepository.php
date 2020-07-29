<?php

namespace App\Repositories\View;

use App\View;
use App\Repositories\BaseRepository;

class ViewRepository extends BaseRepository
{
    protected $viewModel;

    public function __construct(View $viewModel)
    {
        parent::__construct($viewModel);
    }
}
