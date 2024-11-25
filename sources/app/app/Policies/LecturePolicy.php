<?php

namespace App\Policies;

use App\Models\Lecture;
use App\Models\User;

class LecturePolicy
{
    public function update(User $user, Lecture $lecture): bool
    {
        return $user->role->name === 'Admin' || $lecture->created_by === $user->id;
    }

    public function delete(User $user, Lecture $lecture): bool
    {
        return $user->role->name === 'Admin' || $lecture->created_by === $user->id;
    }
}
