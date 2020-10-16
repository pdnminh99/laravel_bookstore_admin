<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SideNav extends Component
{
    public array $navigators;

    public array $userNavigators;

    public function __construct()
    {
        $this->navigators = [
            [
                'text' => 'Dashboard',
                'icon' => 'ni-tv-2 text-primary',
                'url' => '#',
                'active' => true
            ],
            [
                'text' => 'Icons',
                'icon' => 'ni-planet text-orange',
                'url' => '#',
                'active' => false
            ],
            [
                'text' => 'Google',
                'icon' => 'ni-pin-3 text-primary',
                'url' => '#',
                'active' => false
            ],
            [
                'text' => 'Profile',
                'icon' => 'ni-single-02 text-yellow',
                'url' => '#',
                'active' => false
            ],
        ];
        $this->userNavigators = [
            [
                'text' => 'Profile',
                'icon' => 'ni-spaceship',
                'url' => '#',
                'active' => false
            ],
            [
                'text' => 'Settings',
                'icon' => 'ni-spaceship',
                'url' => '#',
                'active' => false
            ],
        ];
    }

    public function render()
    {
        return view('components.side-nav');
    }
}
