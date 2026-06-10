<?php

namespace App\Http\Controllers\Api\Chapter4;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Ai\Audio;
use Laravel\Ai\Transcription;

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

    public function transcribeAudio(Request $request): JsonResponse
    {
        $request->validate([
            'audio' => 'required|file|mimes:mp3,mp4,wav,m4a,webm|max:25600'
        ]);

        $audioToTranscribe = $request->file('audio');

        $transcript = Transcription::fromUpload($audioToTranscribe)->generate();

        return response()->json([
            'demo' => 'Basic Transcription',
            'filename' => $audioToTranscribe->getClientOriginalName(),
            'text' => (string) $transcript,
        ]);
    }
}
