<?php

namespace CWBot\Service;

use CWBot\Command\BaseCommand;
use Discord\Discord;
use Discord\Parts\Channel\Message;

/**
 * Service that receives and parses commands.
 */
class CommandHandler
{
    /**
     * @param BaseCommand[] $commands
     */
    public function __construct(
        private array $commands,
        private string $prefix = '<?'
    ) {}

    /**
     * Intercepts messages and executes commands.
     * Pass this to `Bot->run()`
     */
    public function handleCommands(Discord $discord)
    {
        $discord->on('message', function (Message $message, Discord $discord) {
            $content = $message->content;
            
            if ($this->prefixed($content)) {
                $commandName = preg_replace($this->prefix, '', $content);
                $this->commands[$commandName]->action($message, $discord);
            }
        });
    }

    /**
     * Checks if a given string contains
     * `$this->prefix`
     */
    private function prefixed(string $text): bool
    {
        return str_starts_with($text, $this->prefix);
    }
}