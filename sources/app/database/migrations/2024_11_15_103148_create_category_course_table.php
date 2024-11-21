<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('category_course')) {
            Schema::create('category_course', function (Blueprint $table) {
                $table->foreignId('category_id')->constrained()->cascadeOnDelete();
                $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('category_course');
    }
};
