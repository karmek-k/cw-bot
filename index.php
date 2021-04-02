<?php

namespace CWBot;

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use CWBot\Bot;
use CWBot\Service\CommandHandler;
use CWBot\Service\CommandLoader;

// initialize env. vars
Dotenv::createImmutable(__DIR__)->load();

$loader = new CommandLoader('config/commands');
$commands = $loader->getCommands();

$commandHandler = new CommandHandler($commands, $_ENV['PREFIX']);

$bot = new Bot($_ENV['BOT_TOKEN']);
$bot->run($commandHandler->handleCommands);
