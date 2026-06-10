<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Chapter1\SetupController;
use App\Http\Controllers\Api\Chapter2\{
    AgentConfigController,
    AgentPromptingController,
    ConversationalAgentController,
    StructuredOutputController
};
use App\Http\Controllers\Api\Chapter3\SearchController;
use App\Http\Controllers\Api\Chapter3\ToolUsageController;
use App\Http\Controllers\Api\Chapter4\AudiogenerationController;
use App\Http\Controllers\Api\Chapter4\FilePromptController;
use App\Http\Controllers\Api\Chapter4\ImageGenerationController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('chapter1')->group(function (){

    Route::get('/health-check', [SetupController::class, 'healthCheck']);

    Route::get('/verify-ai-sdk', [SetupController::class, 'verifyAiSdk']);

    Route::post('/generate-token', [SetupController::class, 'generateToken']);

});

Route::prefix('chapter1')->middleware('auth:sanctum')->group(function (){

    Route::get('/me', [SetupController::class, 'me']);
});

Route::prefix('chapter2')->middleware('auth:sanctum')->group(function (){

    Route::get('/hello-world', [AgentPromptingController::class, 'helloWorld']);

    Route::post('/prompt', [AgentPromptingController::class, 'promptWithInput']);

    Route::post('/conversations/start', [ConversationalAgentController::class, 'startConversation']);

    Route::post('/conversations/continue', [ConversationalAgentController::class, 'continueConversation']);

    Route::post('/structured/sentiment', [StructuredOutputController::class, 'analyzeSentiment']);

    Route::get('/anonymous/simple', [StructuredOutputController::class, 'simpleAnonymousAgent']);

    Route::post('/anonymous/structured', [StructuredOutputController::class, 'anonymousStructuredAgent']);

    Route::post('/config/creative', [AgentConfigController::class, 'creativeWrite']);

    Route::post('/config/extract', [AgentConfigController::class, 'extractContact']);
});

Route::prefix('chapter3')->group(function () {
    Route::post('/tools/time-assistant', [ToolUsageController::class, 'getRequestedTime']);

    Route::post('/web/research', [SearchController::class, 'research']);

    Route::post('/fetch/analyze', [SearchController::class, 'analyzerPage']);
});

Route::prefix('chapter4')->group(function () {
    Route::post('files/analyze-document', [FilePromptController::class, 'analyzeDocument']);

    Route::post('files/analyze-image', [FilePromptController::class, 'analyzeImage']);

    Route::post('images/generate', [ImageGenerationController::class, 'generateImage']);

    Route::post('audio/generate', [AudiogenerationController::class, 'generateAudio']);

    Route::post('audio/transcribe', [AudiogenerationController::class, 'transcribeAudio']);
});


