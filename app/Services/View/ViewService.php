<?php

namespace App\Services\View;

use App\Repositories\View\ViewRepository;

class ViewService
{
    protected $viewRepository;

    public function __construct(ViewRepository $viewRepository)
    {
        $this->viewRepository = $viewRepository;
    }

    public function createView(array $view)
    {
       return $this->viewRepository->create($view);
    }
}
