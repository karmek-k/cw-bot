<?php

namespace CWBot;

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use CWBot\Bot;
use CWBot\Service\CommandHandler;
use CWBot\Service\CommandLoader;

define('PROJECT_ROOT', __DIR__);

// initialize env. vars
Dotenv::createImmutable(__DIR__)->safeLoad();

$token = $_ENV['BOT_TOKEN'];
if (!isset($token) || $token === '') {
    throw new \Exception('You have not specified a bot token!');
}

$bot = new Bot($token);
$bot->run(function ($discord) {
    $loader = new CommandLoader('config/commands.yml');
    $commands = $loader->getCommands();

    $commandHandler = new CommandHandler($commands, $_ENV['PREFIX']);
    $commandHandler->handleCommands($discord);
});
