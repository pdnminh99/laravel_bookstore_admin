<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Request;
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
                'url' => 'home'
            ],
            [
                'text' => 'Books',
                'icon' => 'ni-books text-orange',
                'url' => 'books'
            ],
            [
                'text' => 'Orders',
                'icon' => 'ni-credit-card text-primary',
                'url' => 'order'
            ],
            [
                'text' => 'Customers',
                'icon' => 'ni-single-02 text-yellow',
                'url' => 'customer'
            ],
        ];
        $this->userNavigators = [
            [
                'text' => 'Profile',
                'icon' => 'ni-single-02',
                'url' => 'profile'
            ],
            [
                'text' => 'Settings',
                'icon' => 'ni-ui-04',
                'url' => 'setting'
            ],
        ];
    }

    public function render()
    {
        return view('containers.side-nav');
    }
}
