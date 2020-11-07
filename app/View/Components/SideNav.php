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
        ];

        if ($this->auth_manager->user()->hasPermissionTo('view profiles'))
            array_push($this->navigators, [
                'text' => 'Users',
                'icon' => 'ni-single-02 text-yellow',
                'url' => 'users'
            ]);

        $id = $this->auth_manager->user()->id;

        $this->userNavigators = [
            [
                'text' => 'Profile',
                'icon' => 'ni-single-02',
                'url' => "users/$id"
            ]
        ];
    }

    public function render()
    {
        return view('containers.side-nav');
    }
}
