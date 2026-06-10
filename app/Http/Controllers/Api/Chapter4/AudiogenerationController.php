<?php

namespace App\Http\Controllers\Api\Chapter4;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Ai\Audio;

class AudiogenerationController extends Controller
{
    public function generateAudio(Request $request): JsonResponse
    {
        $request->validate([
            'text' => 'required|string|max:5000'
        ]);

        $textInput = $request->input('text');

        $audio = Audio::of($textInput)->generate(provider: 'gemini');

        $path = $audio->store('audio', 'public');

        return response()->json([
            'demo' => 'Basic Text-to-Speech',
            'text' => $textInput,
            'path' => $path,
            'url' => asset('storage/' . $path)
        ]);
    }
}
