<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function update(User $user, Course $course): bool
    {
        return $user->role->name === 'Admin' || $user->id === $course->created_by;
    }

    public function delete(User $user): bool
    {
        return $user->role->name === 'Admin';
    }
}
