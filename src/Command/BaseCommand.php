<?php

namespace CWBot\Command;

use Discord\Discord;
use Discord\Parts\Channel\Message;

/**
 * The base class that all command classes
 * extend.
 */
abstract class BaseCommand
{
    public function __construct(
        private string $name,
        private ?string $help = null
    ) {}

    public function getHelp(): ?string
    {
        return $this->help;
    }

    public function getName(): string
    {
        return $this->name;
    }

    abstract public function action(Message $message, Discord $discord);
}