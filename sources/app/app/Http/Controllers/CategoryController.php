<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::all();

        return response()->json($categories, 200);
    }

    public function getCategories(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'asc');

        $categories = Category::when($search, function ($query, $search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })
            ->select('id', 'name')
            ->orderBy($sortBy, $sortOrder)
            ->simplePaginate(10);

        return view('admin.show.categories', [
            'categories' => $categories,
            'search' => $search,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder
        ]);
    }

    public function createCategory()
    {
        return view('admin.create.category');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create(['name' => $validated['name']]);

        return redirect()->route('admin.getCategories');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.edit.category', ['category' => $category]);
    }

    public function updateCategory(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);

        $category->update(['name' => $validated['name']]);

        return redirect()->route('admin.getCategories');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('admin.getCategories');
    }
}
