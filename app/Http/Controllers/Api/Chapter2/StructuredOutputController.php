<?php

namespace App\Http\Controllers\Api\Chapter2;

use App\Http\Controllers\Controller;
use Illuminate\Http\{
    Request,
    JsonResponse
};

use App\Ai\Agents\SentimentAnalyzerAgent;
use Illuminate\Contracts\JsonSchema\JsonSchema;

class StructuredOutputController extends Controller
{
    public function analyzeSentiment(Request $request): JsonResponse
    {
        $request->validate([
            'text' => 'required|string|max:2000'
        ]);

        $response = (new SentimentAnalyzerAgent)
        ->prompt($request->input('text'));

        return response()->json([
            'demo' => 'Sentiment Analysis (Structured Output)',
            'input_text' => $request->input('text'),
            'analysis' => $response
        ]);
    }
}
