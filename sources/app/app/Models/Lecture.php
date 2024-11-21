<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'video_url', 'course_id'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
