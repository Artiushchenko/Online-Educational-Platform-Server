<?php

namespace App\Models\Chat;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ChatMessage extends Model
{
    use HasFactory;

    public function room(): HasOne
    {
        return $this->hasOne(ChatRoom::class, 'id', 'chat_room_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
