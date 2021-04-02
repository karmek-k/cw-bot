<?php

namespace CWBot;

use Discord\Discord;

/**
 * The most important class of CWBot.
 * It allows interacting with the bot instance.
 */
class Bot
{
    private $discord;
    private $prefix;

    /**
     * Creates a new Discord client instance.
     */
    public function __construct(string $token, string $prefix = '<?')
    {
        $this->discord = new Discord([
            'token' => $token,
        ]);

        $this->prefix = $prefix;
    }

    /**
     * Calls `run()` on the Discord client.
     * The `$callback` function accepts a `Discord\Discord`
     * argument.
     */
    public function run(callable $onReady)
    {
        $this->discord->on('ready', $onReady);
        $this->discord->run();
    }
}