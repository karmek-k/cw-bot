<?php

namespace CWBot;

use Discord\Discord;

/**
 * The most important class of CWBot.
 * It allows interacting with the bot instance.
 */
class Bot
{
    /** @var Discord */
    private $discord;

    /**
     * Creates a new Discord client instance.
     */
    public function __construct(string $token)
    {
        $this->discord = new Discord([
            'token' => $token,
        ]);
    }

    /**
     * Calls `run()` on the Discord client.
     */
    public function run()
    {
        $this->discord->run(function() {});
    }
}