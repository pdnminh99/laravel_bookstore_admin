<?php

namespace App\Http\Controllers;

use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private AuthManager $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function index(Request $request)
    {
        $page_number = $request->query('page') ?? 1;

        return view('pages.customers', [
            'customers' => [],
            'page_number' => $page_number,
            'pages' => 20,
            'username' => $this->authManager->user()->name
        ]);
    }
}
