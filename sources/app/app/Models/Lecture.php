<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'video_id'];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_lecture');
    }
}
