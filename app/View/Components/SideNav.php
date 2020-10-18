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
                'url' => '',
                'active' => Request::is('/')
            ],
            [
                'text' => 'Books',
                'icon' => 'ni-books text-orange',
                'url' => 'book',
                'active' => Request::is('book')
            ],
            [
                'text' => 'Order',
                'icon' => 'ni-credit-card text-primary',
                'url' => 'order',
                'active' => Request::is('order')
            ],
            [
                'text' => 'Customers',
                'icon' => 'ni-single-02 text-yellow',
                'url' => 'customer',
                'active' => Request::is('customer')
            ],
        ];
        $this->userNavigators = [
            [
                'text' => 'Profile',
                'icon' => 'ni-single-02',
                'url' => 'profile',
                'active' => Request::is('profile')
            ],
            [
                'text' => 'Settings',
                'icon' => 'ni-ui-04',
                'url' => 'setting',
                'active' => Request::is('setting')
            ],
        ];
    }

    public function render()
    {
        return view('containers.side-nav');
    }
}
