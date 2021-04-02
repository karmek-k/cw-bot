<?php

namespace CWBot;

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use CWBot\Bot;
use CWBot\Service\CommandHandler;
use CWBot\Service\CommandLoader;

define('PROJECT_ROOT', __DIR__);

// initialize env. vars
Dotenv::createImmutable(__DIR__)->load();


$bot = new Bot($_ENV['BOT_TOKEN']);
$bot->run(function ($discord) {
    $loader = new CommandLoader('config/commands.yml');
    $commands = $loader->getCommands();

    $commandHandler = new CommandHandler($commands, $_ENV['PREFIX']);
    $commandHandler->handleCommands($discord);
});
