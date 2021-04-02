<?php

namespace CWBot;

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use CWBot\Bot;

// initialize env. vars
Dotenv::createImmutable(__DIR__)->load();

$bot = new Bot($_ENV['BOT_TOKEN']);
$bot->run();
