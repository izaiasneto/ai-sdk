<?php

namespace App\Http\Controllers\Api\Chapter2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ai\Agents\HelloWorldAgent;
use illuminate\Http\JsonResponse;

class AgentPromptingController extends Controller
{
    public function helloWorld(): JsonResponse
    {
        // $agent = new HelloWorldAgent;
        $agent = HelloWorldAgent::make();

        $response = $agent->prompt('Hello! What are you and what can you help me with?');

        return response()->json([
            'demo' => 'Basic Promp - Hello world',
            'response' => (string) $response
        ]);
    }

    public function promptWithInput(Request $request): JsonResponse
    {
        $request->validate([
            'prompt' => 'required|string|max:1000'
        ]);

        // $agent = new HelloWorldAgent;
        // $agent = HelloWorldAgent::make();

        $prompt = $request->input('prompt');

        $response = (new HelloWorldAgent)->prompt($prompt);
 
        return response()->json([
            'demo' => 'Prompt with user input',
            'user_message' => $prompt,
            'response' => (string) $response
        ]);
    }
}
