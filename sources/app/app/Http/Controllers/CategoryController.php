<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {}

    public function index(Request $request): View
    {
        $search = $request->input('search');
        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'asc');

        $categories = $this->categoryService->getCategoriesWithFilter($search, $sortBy, $sortOrder);

        return view('admin.show.categories', compact('categories', 'search', 'sortBy', 'sortOrder'));
    }

    public function create(): View
    {
        return view('admin.create.category');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $this->categoryService->createCategory($request->validated());

        return redirect()->route('admin.categories.index');
    }

    public function edit(int $id): View
    {
        $category = $this->categoryService->getCategoryById($id);

        return view('admin.edit.category', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, int $id): RedirectResponse
    {
        $category = $this->categoryService->getCategoryById($id);

        $this->categoryService->updateCategory($category, $request->validated());

        return redirect()->route('admin.categories.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        $category = $this->categoryService->getCategoryById($id);

        $this->categoryService->deleteCategory($category);

        return redirect()->route('admin.categories.index');
    }
}
