<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'user' => $this->authManager->user()
        ]);
    }

    public function create()
    {
        return view('pages.categories-detail',
            [
                'categories' => new Category(),
                'user' => $this->authManager->user(),
                'action' => "/categories",
                'method' => "POST"
            ]);
    }

    public function store(Request $request)
    {
        $validated_category = $request->validate([
            'name' => 'required|string|max:255',
            'description' => ''
        ]);

        Category::insert($validated_category);
        return redirect()
            ->route('categories.index', ['page' => 1])
            ->with('success', "Category name ${validated_category['name']} created successfully.");
    }

    public function show(string $id, Request $request)
    {
        if ($request->query('page') < 1) return redirect()->to("/categories/$id?page=1");
        $category = Category::find($id);
        $paginator = $category->books()->paginate(10);
        if ($paginator->currentPage() > $paginator->lastPage()) return redirect()->to("/categories/$id?page=>$paginator->lastPage()");

        return view('pages.categories-detail',
            [
                'category' => $category,
                'books' => $paginator->items(),
                'page_number' => $paginator->currentPage(),
                'pages' => $paginator->lastPage(),

                'user' => $this->authManager->user(),
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
        $books = $category->books;

        // TODO images are not deleted yet!
        foreach ($books as $book)
            if (!is_null($book->image))
                Storage::disk('public')
                    ->delete("storage/books/" . $book->image);

        $category->delete();
        return back()->with('success', "Category with id $category->id is deleted successfully");
    }
}
