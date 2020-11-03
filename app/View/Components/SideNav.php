<?php

namespace App\View\Components;

use Illuminate\Auth\AuthManager;
use Illuminate\View\Component;

class SideNav extends Component
{
    public array $navigators;

    public array $userNavigators;

    private AuthManager $auth_manager;

    public function __construct(AuthManager $auth_manager)
    {
        $this->auth_manager = $auth_manager;
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
                'text' => 'Categories',
                'icon' => 'ni-collection text-blue',
                'url' => 'categories'
            ],
            [
                'text' => 'Orders',
                'icon' => 'ni-credit-card text-primary',
                'url' => 'orders'
            ],
            [
                'text' => 'Users',
                'icon' => 'ni-single-02 text-yellow',
                'url' => 'users'
            ],
        ];

        $id = $this->auth_manager->user()->id;

        $this->userNavigators = [
            [
                'text' => 'Profile',
                'icon' => 'ni-single-02',
                'url' => "users/$id"
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
