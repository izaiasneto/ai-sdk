<?php

namespace App\Http\Controllers\Api\Chapter2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Ai\Agents\CreativeWriterAgent;
use App\Ai\Agents\PreciseExtractorAgent;
use Illuminate\Http\JsonResponse;

class AgentConfigController extends Controller
{
    public function creativeWrite(Request $request): JsonResponse
    {
        $request->validate([
            'prompt' => 'required|string|max:500',
            'genre' => 'required|string|max:50'
        ]);

        $genre = $request->input('genre');
        $prompt = "Genre: {$genre}\n\n". $request->input('prompt');

        $response = (new CreativeWriterAgent)->prompt($prompt);

        return response()->json([
            'demo' => 'Creative Writer (High Temperature)',
            'genre' => $genre,
            'result' => (string) $response,
        ]);
    }

    public function extractContact(Request $request): JsonResponse
    {
        $request->validate([
            'text' => 'required|string|max:2000',
        ]);

        $text = $request->input('text');

        $response = (new PreciseExtractorAgent)->prompt(
            'Extract contact information from this text: '. $text
        );

        return response()->json([
            'demo' => 'Precise Extractor (Low Temperature)',
            'result' => $response
        ]);
    }
}
