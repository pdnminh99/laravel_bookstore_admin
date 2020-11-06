<?php

namespace App\Http\Middleware;

use App\Models\AccessRole;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

class VerifyAdmin
{
    private AuthManager $auth_manager;

    public function __construct(AuthManager $auth_manager)
    {
        $this->auth_manager = $auth_manager;
    }

    public function handle(Request $request, \Closure $next)
    {
        $current_user = $this->auth_manager->user();

        return $current_user->getRoleNames()[0] == AccessRole::ADMIN ?
            $next($request) :
            redirect()->route('users.show', ['user' => $current_user->id]);
    }
}
