<?php

namespace App\Http\Controllers\Api\Chapter3;

use App\Ai\Agents\PageAnalyzerAgent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Ai\Agents\WebResearcherAgent;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    public function research(Request $request): JsonResponse
    {
        $request->validate([
            'question' => 'required|string|max:500',
        ]);

        $question = $request->input('question');

        $response = (new WebResearcherAgent)->prompt($question);

        return response()->json([
            'demo' => 'Web researcher (General Search)',
            'question' => $question,
            'answer' => (string) $response,
        ]);
    }

    public function analyzerPage(Request $request): JsonResponse
    {
        $request->validate([
            'prompt' => 'required|string|max:1000',
        ]);

        $prompt = $request->input('prompt');

        $response = (new PageAnalyzerAgent)->prompt($prompt);

        return response()->json([
            'demo' => 'Page Analyzer (WebFetch)',
            'prompt' => $prompt,
            'answer' => (string) $response
        ]);
    }
}
