<?php

namespace CWBot\Command;

use Discord\Discord;
use Discord\Parts\Channel\Message;

abstract class BaseCommand
{
    abstract public function action(Message $message, Discord $discord);
}