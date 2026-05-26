<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Chapter1\SetupController;
use App\Http\Controllers\Api\Chapter2\{
    AgentPromptingController,
    ConversationalAgentController,
    StructuredOutputController
};

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
});


