<?php

namespace CWBot;

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// initialize env. vars
Dotenv::createImmutable(__DIR__)->load();
