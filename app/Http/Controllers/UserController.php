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

    public function show(string $id)
    {
        $user = User::find($id);
        return view('pages.users-detail',
            [
                'user' => $user,
                'username' => $this->authManager->user()->name,
                'action' => "/users/$id",
                'method' => "PATCH"
            ]);
    }

    public function update(Request $request, $id)
    {
        $validated_user_info = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'string|max:255',
            'description' => '',
            'phone' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'about_me' => ''
        ]);

        User::where('id', $id)->update($validated_user_info);
        return back()->with('success', 'User info updated successfully');
    }
}
