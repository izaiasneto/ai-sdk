<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Promptable;
use Stringable;

use Laravel\Ai\Attributes\Provider;
use Laravel\Ai\Attributes\Model;

#[Provider('gemini')]
#[Model('gemini-2.5-flash-lite')]
class DocumentAnalyzerAgent implements Agent
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return 'You are a document analyst. When a user attaches a file '
        . 'and asks a question about it, read the document carefully '
        . 'and provide a thorough, accurate answer based on its contents. '
        . 'If summarizing, capture the key points without losing '
        . 'important details. If the user asks something not covered '
        . 'by the document, say so.';
    }
}
