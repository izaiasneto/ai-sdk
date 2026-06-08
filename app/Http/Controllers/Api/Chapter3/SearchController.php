<?php

namespace App\Http\Controllers\Api\Chapter3;

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
}
