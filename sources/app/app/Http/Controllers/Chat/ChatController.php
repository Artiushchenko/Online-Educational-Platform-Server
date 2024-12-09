<?php

namespace App\Http\Controllers\Chat;

use App\Services\ChatService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct(
        protected ChatService $chatService
    ) {}

    public function rooms(): JsonResponse
    {
        $rooms = $this->chatService->getAllRooms();

        return response()->json($rooms);
    }

    public function messages(int $roomId): JsonResponse
    {
        $messages = $this->chatService->getMessagesByRoomId($roomId);

        return response()->json($messages);
    }

    public function newMessage(Request $request, int $roomId): JsonResponse
    {
        $newMessage = $this->chatService->createNewMessage(
            $roomId,
            $request->input('message')
        );

        return response()->json($newMessage);
    }
}
