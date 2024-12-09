<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseService
{
    public function getCourses(?string $search, string $sortBy = 'id', string $sortOrder = 'asc')
    {
        return Course::with('creator:id,name')
            ->when($search, function ($query) use ($search) {
                $query->where('slug', 'like', '%' . $search . '%');
            })
            ->select('id', 'title', 'slug', 'created_by')
            ->orderBy($sortBy, $sortOrder)
            ->simplePaginate(10);
    }

    public function storeCourse(array $data): Course
    {
        $course = Course::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'created_by' => Auth::id(),
        ]);

        $course->lectures()->sync($data['lectures']);
        $course->categories()->sync($data['categories']);

        return $course;
    }

    public function updateCourse(Course $course, array $data): void
    {
        $course->update([
            'title' => $data['title'],
            'slug' => $data['slug'],
        ]);

        $course->lectures()->sync($data['lectures']);
        $course->categories()->sync($data['categories']);
    }

    public function deleteCourse(Course $course): void
    {
        $course->lectures()->detach();
        $course->categories()->detach();
        $course->delete();
    }

    public function getCourseBySlug(string $slug): ?Course
    {
        return Course::with('lectures')->where('slug', $slug)->first();
    }

    public function searchCourses(string $search): array
    {
        return Course::where('title', 'like', '%' . $search . '%')
            ->select('id', 'title', 'slug')
            ->limit(5)
            ->get()
            ->toArray();
    }

    public function getCoursesByCategories(?array $categoryIds = null): array
    {
        $query = Course::with('categories');

        if (!empty($categoryIds)) {
            $query->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('id', $categoryIds);
            });
        }

        return $query->get()->toArray();
    }
}
