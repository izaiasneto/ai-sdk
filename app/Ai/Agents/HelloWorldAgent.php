<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\{
    Agent,
    Conversational,
    HasTools,
    Tool,
};
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

class HelloWorldAgent implements Agent, Conversational, HasTools
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return 'You are a helpful assistant.';
    }

    /**
     * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }
}
