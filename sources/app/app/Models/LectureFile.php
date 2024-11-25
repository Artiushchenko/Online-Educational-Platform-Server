<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LectureFile extends Model
{
    use HasFactory;

    protected $fillable = ['lecture_id', 'file_path', 'file_name'];

    public $timestamps = false;

    public function lecture(): BelongsTo
    {
        return $this->belongsTo(Lecture::class);
    }
}
