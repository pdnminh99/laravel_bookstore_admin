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
            'user' => $this->authManager->user()
        ]);
    }

    public function show(User $user)
    {
        return view('pages.users-detail',
            [
                'customer' => $user,
                'user' => $this->authManager->user(),
                'action' => "/users/$user->id"
            ]);
    }

    public function update(Request $request, User $user)
    {
        $validated_user_info = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'string|max:255',
            'role' => '',
            'phone' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'about_me' => ''
        ]);

        $has_changes = false;

        // Compare & Apply name
        if ($user->name != $validated_user_info['name']) {
            $user->name = $validated_user_info['name'];
            $has_changes = true;
        }

        // Compare & Apply address
        if ($user->address != $validated_user_info['address']) {
            $user->address = $validated_user_info['address'];
            $has_changes = true;
        }

        // Compare & Apply phone
        if ($user->phone != $validated_user_info['phone']) {
            $user->phone = $validated_user_info['phone'];
            $has_changes = true;
        }

        // Compare & Apply city
        if ($user->city != $validated_user_info['city']) {
            $user->city = $validated_user_info['city'];
            $has_changes = true;
        }

        // Compare & Apply country
        if ($user->country != $validated_user_info['country']) {
            $user->country = $validated_user_info['country'];
            $has_changes = true;
        }

        // Compare & Apply about_me
        if ($user->about_me != $validated_user_info['about_me']) {
            $user->about_me = $validated_user_info['about_me'] ?? '';
            $has_changes = true;
        }

        $current_role = $user->getRoleNames()[0];
        $new_role = $request->input('role', $current_role);

        if ($new_role != $current_role) {
            $user->removeRole($current_role);
            $user->assignRole($new_role);
            $has_changes = true;
        }

        if (!$has_changes) return back()->with('warning', 'Cannot apply updates because no changes found!');

        $user->save();
        return redirect()
            ->route('users.show', ['user' => $user->id])
            ->with('success', 'User info updated successfully');
    }
}
