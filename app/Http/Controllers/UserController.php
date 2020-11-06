<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private AuthManager $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->middleware('profile_access')->only(['show', 'update']);
        $this->middleware('admin')->only(['index']);
        $this->authManager = $authManager;
    }

    public function index(Request $request)
    {
        if ($request->query('page') < 1) return redirect()->route('users.index', ['page' => 1]);
        $paginator = User::orderBy('updated_at', 'DESC')
            ->paginate(10);
        if ($paginator->currentPage() > $paginator->lastPage()) return redirect()->route('users.index', ['page' => $paginator->lastPage()]);

        // Ref: https://hdtuto.com/article/how-to-get-current-user-details-in-laravel-57
        return view('pages.users', [
            'users' => $paginator->items(),
            'page_number' => $paginator->currentPage(),
            'pages' => $paginator->lastPage(),
            'username' => $this->authManager->user()->name
        ]);
    }

    public function show(User $user)
    {
        return view('pages.users-detail',
            [
                'user' => $user,
                'username' => $this->authManager->user()->name,
                'action' => "/users/$user->id"
            ]);
    }

    public function update(Request $request, User $user)
    {
        $validated_user_info = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'string|max:255',
            'role' => 'required|string',
            'phone' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'about_me' => ''
        ]);
        $user->name = $validated_user_info['name'];
        $user->address = $validated_user_info['address'];
        $user->phone = $validated_user_info['phone'];
        $user->city = $validated_user_info['city'];
        $user->country = $validated_user_info['country'];
        $user->about_me = $validated_user_info['about_me'] ?? '';
        $user->save();

        $current_role = $user->getRoleNames()[0];
        $new_role = $validated_user_info['role'];

        if ($new_role != $current_role) {
            $user->removeRole($current_role);
            $user->assignRole($new_role);
        }

        return redirect()
            ->route('users.show', ['user' => $user->id])
            ->with('success', 'User info updated successfully');
    }
}
