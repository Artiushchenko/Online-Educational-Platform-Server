<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\NewChatMessage;
use App\Models\Chat\ChatMessage;
use App\Models\Chat\ChatRoom;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ChatService
{
    public function getAllRooms(): Collection
    {
        return ChatRoom::all();
    }

    public function getMessagesByRoomId(int $roomId): Collection
    {
        return ChatMessage::where('chat_room_id', $roomId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function createNewMessage(int $roomId, string $message): ChatMessage
    {
        $newMessage = ChatMessage::create([
            'user_id' => Auth::id(),
            'chat_room_id' => $roomId,
            'message' => $message,
        ]);

        broadcast(new NewChatMessage($newMessage))->toOthers();

        return $newMessage;
    }
}