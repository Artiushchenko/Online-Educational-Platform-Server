<?php

namespace app\Http\Controllers\API;

use app\Http\Controllers\Controller;
use App\Services\ChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct(
        protected ChatService $chatService
    ) {}

    public function showRooms(): JsonResponse
    {
        $rooms = $this->chatService->getAllRooms();

        return response()->json($rooms);
    }

    public function showMessages(int $roomId): JsonResponse
    {
        $messages = $this->chatService->getMessagesByRoomId($roomId);

        return response()->json($messages);
    }

    public function sendNewMessage(Request $request, int $roomId): JsonResponse
    {
        $newMessage = $this->chatService->createNewMessage(
            $roomId,
            $request->input('message')
        );

        return response()->json($newMessage, 201);
    }
}
