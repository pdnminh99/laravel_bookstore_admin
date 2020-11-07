<?php

namespace App\Http\Middleware;

use App\Models\AccessRole;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

class VerifyProfileAccess
{
    private AuthManager $auth_manager;

    public function __construct(AuthManager $auth_manager)
    {
        $this->auth_manager = $auth_manager;
    }

    public function handle(Request $request, \Closure $next)
    {
        $requested_user = $request->route('user');
        $current_user = $this->auth_manager->user();

        if (is_null($requested_user)) return
            $current_user->getRoleNames()[0] == AccessRole::ADMIN ?
                redirect()
                    ->route('users.index', ['page' => 1])
                    ->withErrors('User not found!') :
                redirect()
                    ->route('users.show', ['user' => $current_user->id])
                    ->withErrors('User not found!');

        $role = $current_user->getRoleNames()[0];
        $current_user_id = $current_user->id;
        $requested_user_id = $requested_user->id;

        $should_block = $role != AccessRole::ADMIN &&
            $current_user_id != $requested_user_id;

        if ($should_block) return redirect()->route('users.show', ['user' => $current_user->id])
            ->with('warning', "Route access not allowed!");

        return $next($request);
    }
}
