<?php

namespace CWBot\Command;

use Discord\Discord;
use Discord\Parts\Channel\Message;

class Ping implements BaseCommand
{
    /**
     * Replies `Pong!` to the user.
     */
    public function action(Message $message, Discord $discord)
    {
        $message->reply('Pong!');
    }
}