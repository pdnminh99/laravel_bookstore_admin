<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes ?? [];
    }

    public function render()
    {
        return view('containers.breadcrumb');
    }
}
