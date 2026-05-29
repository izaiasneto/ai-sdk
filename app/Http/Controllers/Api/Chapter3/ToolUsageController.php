<?php

namespace App\Http\Controllers\Api\Chapter3;

use App\Ai\Agents\TimeAwareAssistantAgent;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function Laravel\Ai\{agent};

class ToolUsageController extends Controller
{
    public function getRequestedTime(Request $request): JsonResponse
    {
        $request->validate([
            'question' => 'required|string|max:500',
        ]);

        $question = $request->input('question');

        $withoutTools = agent(
            instructions: 'You are a helpful assistant. Answer the question directly'
        )->prompt($question);

        $response = (new TimeAwareAssistantAgent)->prompt($question);

        return response()->json([
            'demo' => 'Time-Aware Assistant',
            'question' => $question,
            'answer' => (string) $response,
            'without_tools' => (string) $withoutTools
        ]);
    }
}
