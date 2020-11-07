<?php

namespace App\View\Components;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\View\Component;

class TopNav extends Component
{
    public ?Authenticatable $user;

    public string $keyword;

    public function __construct(?Authenticatable $user, string $keyword = '')
    {
        $this->user = $user;
        $this->keyword = $keyword;
    }

    public function render()
    {
        return view('components.top-nav');
    }
}
