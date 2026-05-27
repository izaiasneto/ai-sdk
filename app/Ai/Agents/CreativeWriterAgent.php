<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Promptable;
use Laravel\Ai\Attributes\{
    MaxTokens,
    Provider,
    Temperature,
    Timeout,
    Model
};

use Stringable;

#[Temperature(0.9)]
#[MaxTokens(2048)]
#[Timeout(120)]
#[Model('gemini-2.5-flash')]
class CreativeWriterAgent implements Agent
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return 'You are a talented creative writer with a vivid imagination. '
        . 'Write engaging, original content with rich descriptions, '
        . 'compelling characters, and surprising twists. '
        . 'Vary your style based on the genre or topic requested.';
    }
}
