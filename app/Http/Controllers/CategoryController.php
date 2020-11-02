<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private AuthManager $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function index(Request $request)
    {
        if ($request->query('page') < 1) return redirect()->route('categories.index', ['page' => 1]);
        $paginator = Category::paginate(10);
        if ($paginator->currentPage() > $paginator->lastPage()) return redirect()->route('categories.index', ['page' => $paginator->lastPage()]);

        return view('pages.categories', [
            'categories' => $paginator->items(),
            'page_number' => $paginator->currentPage(),
            'pages' => $paginator->lastPage(),
            'username' => $this->authManager->user()->name
        ]);
    }

    public function create()
    {
        return view('pages.categories-detail',
            [
                'categories' => new Category(),
                'username' => $this->authManager->user()->name,
                'action' => "/categories",
                'method' => "POST"
            ]);
    }

    public function store(Request $request)
    {
        $validated_category = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string'
        ]);

        Category::insert($validated_category);
        return redirect()
            ->route('categories.index', ['page' => 1])
            ->with('success', "Category name ${validated_category['name']} created successfully.");
    }

    public function show(string $id)
    {
        $category = Category::find($id);
        return view('pages.categories-detail',
            [
                'category' => $category,
                'username' => $this->authManager->user()->name,
                'action' => "/categories/$id",
                'method' => "PATCH"
            ]);
    }

    public function update(Request $request, $id)
    {
        $validated_category = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable'
        ]);

        Category::where('id', $id)->update($validated_category);
        return back()->with('success', 'Category info updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', "Category with id $category->id is deleted successfully");
    }
}
