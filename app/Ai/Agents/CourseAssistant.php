<?php

namespace App\Ai\Agents;


use Stringable;

use Laravel\Ai\Concerns\RemembersConversations;
use Laravel\Ai\Contracts\{
    Agent,
    Conversational,
    HasTools,
    Tool,
};
use Laravel\Ai\Promptable;

class CourseAssistant implements Agent, Conversational
{
    use Promptable, RemembersConversations;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return 'You are a helpful teaching assistant for a Laravel AI 
        SDK course.'
        .'You remember everything discussed in the current conversation'
        .'When the user references soomething said earlier, acknowledge 
        it and build upon +1'
        .'Keep responses concise - 2 to 3 setences maximum';
    }
}
