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
                $tokens = $this->tokenizeCommand($content);
                $commandName = array_shift($tokens);

                // suppress warnings about non-existent keys
                // TODO: return a message instead
                @$this->commands[$commandName]
                    ?->action($message, $discord, $tokens);
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

    /**
     * Explodes a command into tokens
     * and strips off the command prefix.
     */
    private function tokenizeCommand(string $command): array
    {
        $tokens = explode(' ', $command);
        $tokens[0] = str_replace($this->prefix, '', $tokens[0]);

        return $tokens;
    }
}