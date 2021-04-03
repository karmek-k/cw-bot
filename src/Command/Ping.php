<?php

namespace CWBot\Command;

use Discord\Discord;
use Discord\Parts\Channel\Message;

class Ping extends BaseCommand
{
    /**
     * Replies `Pong!` to the user.
     */
    public function action(
        Message $message,
        Discord $discord,
        ?array $arguments = null
    ) {
        if ($arguments !== null) {
            foreach ($arguments as $argument) {
                $message->reply($argument . '!');
            }
        } else {
            $message->reply('Pong!');
        }
    }
}