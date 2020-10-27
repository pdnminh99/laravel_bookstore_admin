<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TopNav extends Component
{
    public ?string $username;

    public string $keyword;

    public function __construct(?string $username, string $keyword = '')
    {
        $this->username = $username;
        $this->keyword = $keyword;
    }

    public function render()
    {
        return view('components.top-nav');
    }
}
