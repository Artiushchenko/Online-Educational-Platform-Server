<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Category;
use Illuminate\Contracts\Pagination\Paginator;

class CategoryService
{
    public function getAllCategories(): array
    {
        return Category::all()->toArray();
    }

    public function getCategoriesWithFilter(
        ?string $search,
        string $sortBy = 'id',
        string $sortOrder = 'asc'
    ): Paginator {
        return Category::when($search, function ($query, $search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })
            ->select('id', 'name')
            ->orderBy($sortBy, $sortOrder)
            ->simplePaginate(10);
    }

    public function createCategory(array $data): Category
    {
        return Category::create(['name' => $data['name']]);
    }

    public function getCategoryById(int $id): Category
    {
        return Category::findOrFail($id);
    }

    public function updateCategory(Category $category, array $data): void
    {
        $category->update(['name' => $data['name']]);
    }

    public function deleteCategory(Category $category): void
    {
        $category->delete();
    }
}
