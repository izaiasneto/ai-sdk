<?php

namespace App\Http\Controllers\Api\Chapter4;

use App\Ai\Agents\DocumentAnalyzerAgent;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}
