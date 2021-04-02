<?php

namespace CWBot\Command;

use Discord\Discord;
use Discord\Parts\Channel\Message;

class Ping extends BaseCommand
{
    public function action(Message $message, Discord $discord)
    {
        $message->reply('Pong!');
    }
}