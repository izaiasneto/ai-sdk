<?php

namespace App\Http\Controllers\Api\Chapter2;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};

use App\Ai\Agents\CourseAssistantAgent;

class ConversationalAgentController extends Controller
{
    public function startConversation(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $user = $request->user();
        $message = $request->input('message');

        $response = (new CourseAssistantAgent)
        ->forUser($user)
        ->prompt($message);

        return response()->json([
            'demo' => 'Start new conversation (RemembersConversations)',
            'conversation_id' => $response->conversationId,
            'user_message' => $message,
            'assistant_response' => (string) $response,
            'hint' => 'Save the conversation_id!'
        ]);
    }

    public function continueConversation(Request $request): JsonResponse
    {
        $request->validate([
            'conversation_id' => 'required|string',
            'message' => 'required|string|max:1000',
        ]);

        $user = $request->user();
        $message = $request->input('message');
        $conversationId = $request->input('conversation_id');

        $response = (new CourseAssistantAgent)
        ->continue($conversationId, as: $user)
        ->prompt($message);

        return response()->json([
            'demo' => 'Continue Conversation (RemembersConversations)',
            'conversation_id' => $response->conversationId,
            'user_message' => $message,
            'assistant_response' => (string) $response,
        ]);
    }
}
