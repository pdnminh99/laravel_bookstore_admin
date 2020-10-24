<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserControl extends Component
{
    public ?string $username;

    public function __construct(?string $username)
    {
        $this->username = $username;
    }

    public function render()
    {
        return view('components.user-control');
    }
}
