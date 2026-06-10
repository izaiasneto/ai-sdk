<?php

namespace App\Http\Controllers\Api\Chapter4;

use App\Ai\Agents\DocumentAnalyzerAgent;
use App\Ai\Agents\ImageAnalyzerAgent;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Mail\Attachment;

class FilePromptController extends Controller
{
    public function analyzeDocument(Request $request): JsonResponse
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'document' => 'required|file|mimes:pdf,txt,md,csv,json,docx,xlsx'
        ]);

        $question = $request->input('question');
        $document = $request->file('document');

        $response = (new DocumentAnalyzerAgent)->prompt(
            $question,
            attachments:[
                $document
            ]
        );

        return response()->json([
            'demo' => 'Document Analyzer',
            'filename' => $document->getClientOriginalName(),
            'question' => $question,
            'answer' => (string) $response
        ]);
    }

    public function analyzeImage(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:1040',
            'question' => 'required|string|max:500'
        ]);

        $question = $request->input('question');
        $image = $request->file('image');

        $response = (new ImageAnalyzerAgent)->prompt(
            $question,
            attachments: [
                $image
            ]
        );

        return response()->json([
            'demo' => 'Image Analyzer',
            'filename' => $image->getClientOriginalName(),
            'question' => $question,
            'answer' => (string) $response
        ]);
    }
}
