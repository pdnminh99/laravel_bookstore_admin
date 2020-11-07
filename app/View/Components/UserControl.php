<?php

namespace App\View\Components;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\View\Component;

class UserControl extends Component
{
    public ?Authenticatable $user;

    public function __construct(?Authenticatable $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('components.user-control');
    }
}
